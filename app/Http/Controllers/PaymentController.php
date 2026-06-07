<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Cart;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $userId    = session('user_id');
        $addressId = $request->id_address;
        $cartIds   = $request->cart_ids ?? [];

        if (!$userId) {
            return response()->json(['error' => 'Silahkan login terlebih dahulu'], 401);
        }

        // Ambil alamat dari DB
        $address = Address::where('id_address', $addressId)
                          ->where('id_user', $userId)
                          ->first();
        if (!$address) {
            return response()->json(['error' => 'Alamat tidak ditemukan'], 400);
        }

        // Ambil cart items dari DB
        $cartItems = Cart::with(['variant.product'])
                         ->whereIn('id_cart', $cartIds)
                         ->where('id_user', $userId)
                         ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Tidak ada item untuk di-checkout'], 400);
        }

        // Hitung total
        $subtotal = $cartItems->sum(fn($c) => $c->variant->price * $c->quantity);
        $shippingCost = 15000;
        $grandTotal   = $subtotal + $shippingCost;

        // Simpan order
        $order = Order::create([
            'id_user'             => $userId,
            'id_address'          => $address->id_address,
            'shipping_address'    => "{$address->complete_address}, {$address->city}, {$address->province} {$address->postal_code}",
            'total_product_price' => $subtotal,
            'shipping_cost'       => $shippingCost,
            'grand_total'         => $grandTotal,
            'shipping_method'     => 'Plus Delivery',
            'payment_method'      => 'Midtrans',
            'status'              => 'Pending',
            'order_date'          => now(),
        ]);

        // Simpan order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'id_order'          => $order->id_order,
                'id_variant'        => $item->variant->id_variant,
                'price_at_purchase' => $item->variant->price,
                'quantity'          => $item->quantity,
            ]);
        }

        // Hapus cart items yang sudah di-checkout
        Cart::whereIn('id_cart', $cartIds)->where('id_user', $userId)->delete();

        // Build Midtrans params
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $itemDetails = [];
        foreach ($cartItems as $item) {
            $productName = $item->variant->product->product_name ?? 'Produk';
            $itemDetails[] = [
                'id'       => $item->variant->id_variant,
                'price'    => (int) $item->variant->price,
                'quantity' => (int) $item->quantity,
                'name'     => substr($productName . ' (' . $item->variant->size . '/' . $item->variant->color . ')', 0, 50),
            ];
        }
        $itemDetails[] = [
            'id'       => 'SHIPPING',
            'price'    => $shippingCost,
            'quantity' => 1,
            'name'     => 'Ongkos Kirim',
        ];

        $user = \App\Models\User::find($userId);
        $params = [
            'transaction_details' => [
                'order_id'     => 'SW-' . $order->id_order,
                'gross_amount' => (int) $grandTotal,
            ],
            'item_details'     => $itemDetails,
            'customer_details' => [
                'first_name' => $user?->full_name ?? 'Customer',
                'email'      => $user?->email ?? session('user_email', ''),
                'phone'      => $user?->phone_number ?? '',
                'shipping_address' => [
                    'first_name'   => $user?->full_name ?? 'Customer',
                    'email'        => $user?->email ?? session('user_email', ''),
                    'phone'        => $user?->phone_number ?? '',
                    'address'      => $address->complete_address,
                    'city'         => $address->city,
                    'postal_code'  => $address->postal_code,
                    'country_code' => 'IDN',
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken,
            'order_id'   => $order->id_order,
        ]);
    }

    public function notification(Request $request)
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $notif       = new \Midtrans\Notification();
        $txStatus    = $notif->transaction_status;
        $fraudStatus = $notif->fraud_status;
        $idOrder     = str_replace('SW-', '', $notif->order_id);
        $order       = Order::find($idOrder);

        if (!$order) return response()->json(['message' => 'Order not found'], 404);

        if ($txStatus == 'capture') {
            $order->status = ($fraudStatus == 'challenge') ? 'Pending' : 'Diproses';
        } elseif ($txStatus == 'settlement') {
            $order->status = 'Diproses';
        } elseif (in_array($txStatus, ['cancel', 'deny', 'expire'])) {
            $order->status = 'Dibatalkan';
        } elseif ($txStatus == 'pending') {
            $order->status = 'Pending';
        }

        $order->save();
        return response()->json(['message' => 'OK']);
    }

    public function invoice($id)
    {
        $order = Order::with(['user', 'items.variant.product', 'items.variant.images', 'address'])
            ->where('id_order', $id)->firstOrFail();
        return view('page.invoice', compact('order'));
    }
}