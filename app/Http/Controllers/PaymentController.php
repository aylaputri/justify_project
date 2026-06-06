<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\ProductVariant;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $cart   = $request->cart;
        $addr   = $request->address;
        $userId = session('user_id');

        if (!$userId) {
            return response()->json(['error' => 'Silahkan login terlebih dahulu'], 401);
        }

        // Gunakan address yang sudah ada jika id_address dikirim,
        // supaya tidak terus-menerus membuat address duplikat di DB
        if (!empty($addr['id_address'])) {
            $savedAddress = Address::where('id_address', $addr['id_address'])
                                   ->where('id_user', $userId)
                                   ->first();
        }

        // Kalau tidak ada id_address atau address-nya tidak ditemukan, baru buat baru
        if (empty($savedAddress)) {
            $savedAddress = Address::create([
                'id_user'          => $userId,
                'address_title'    => $addr['title']   ?? 'Rumah',
                'complete_address' => $addr['address'],
                'city'             => $addr['city'],
                'province'         => $addr['province'],
                'postal_code'      => $addr['postal'],
            ]);
        }

        // Hitung total
        $subtotal     = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
        $shippingCost = 15000;
        $grandTotal   = $subtotal + $shippingCost;

        // Simpan order ke DB
        $order = Order::create([
            'id_user'             => $userId,
            'id_address'          => $savedAddress->id_address,
            'shipping_address'    => "{$addr['address']}, {$addr['city']}, {$addr['province']} {$addr['postal']}",
            'total_product_price' => $subtotal,
            'shipping_cost'       => $shippingCost,
            'grand_total'         => $grandTotal,
            'shipping_method'     => 'Plus Delivery',
            'payment_method'      => 'Midtrans',
            'status'              => 'Pending',
            'order_date'          => now(),
        ]);

        // Simpan order items
        foreach ($cart as $item) {
            $variant = ProductVariant::whereHas('product', function ($q) use ($item) {
                $q->where('product_name', $item['name']);
            })
            ->where('size', $item['size'])
            ->where('color', $item['color'])
            ->first();

            if ($variant) {
                OrderItem::create([
                    'id_order'          => $order->id_order,
                    'id_variant'        => $variant->id_variant,
                    'price_at_purchase' => $item['price'],
                    'quantity'          => $item['qty'],
                ]);
            }
        }

        // Config Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        //  Build item details
        $itemDetails = [];
        foreach ($cart as $item) {
            $itemDetails[] = [
                'id'       => $item['name'] . '-' . $item['size'] . '-' . $item['color'],
                'price'    => (int) $item['price'],
                'quantity' => (int) $item['qty'],
                'name'     => substr($item['name'] . ' (' . $item['size'] . '/' . $item['color'] . ')', 0, 50),
            ];
        }
        $itemDetails[] = [
            'id'       => 'SHIPPING',
            'price'    => $shippingCost,
            'quantity' => 1,
            'name'     => 'Ongkos Kirim',
        ];

        // Generate Snap Token — pakai "SW-{id_order}", tanpa kolom baru
        $params = [
            'transaction_details' => [
                'order_id'     => 'SW-' . $order->id_order,
                'gross_amount' => (int) $grandTotal,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $addr['name']  ?? 'Customer',
                'phone'      => $addr['phone'] ?? '',
                'shipping_address' => [
                    'first_name'   => $addr['name']    ?? 'Customer',
                    'phone'        => $addr['phone']   ?? '',
                    'address'      => $addr['address'] ?? '',
                    'city'         => $addr['city']    ?? '',
                    'postal_code'  => $addr['postal']  ?? '',
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

    /**
     * Callback notifikasi dari Midtrans
     * Route: POST /checkout/notification (skip CSRF)
     */
    public function notification(Request $request)
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $notif       = new \Midtrans\Notification();
        $txStatus    = $notif->transaction_status;
        $fraudStatus = $notif->fraud_status;

        // Ambil id_order dari "SW-{id_order}"
        $idOrder = str_replace('SW-', '', $notif->order_id);
        $order   = Order::find($idOrder);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

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

    /**
     * Halaman invoice
     * Route: GET /invoice/{id}
     */
    public function invoice($id)
    {
        $order = Order::with(['user', 'items.variant.product', 'items.variant.images', 'address'])
            ->where('id_order', $id)
            ->firstOrFail();

        return view('page.invoice', compact('order'));
    }
}