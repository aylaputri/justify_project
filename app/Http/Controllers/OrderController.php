<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();

        return view('admin.orders', compact('orders'));
    }
    
    public function store(Request $request)
    {
        // Sementara hardcode id_user = 1
        $userId  = 1;
        $cart    = $request->cart;
        $address = $request->address;

        $savedAddress = Address::create([
            'id_user'          => $userId,
            'address_title'    => $address['title']   ?? 'Rumah',
            'complete_address' => $address['address'],
            'city'             => $address['city'],
            'province'         => $address['province'],
            'postal_code'      => $address['postal'],
        ]);

        $subtotal     = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
        $shippingCost = 15000; // flat
        $grandTotal   = $subtotal + $shippingCost;

        $order = Order::create([
            'id_user'             => $userId,
            'id_address'          => $savedAddress->id_address,
            'shipping_address'    => "{$address['address']}, {$address['city']}, {$address['province']} {$address['postal']}",
            'total_product_price' => $subtotal,
            'shipping_cost'       => $shippingCost,
            'grand_total'         => $grandTotal,
            'shipping_method'     => 'JNE REG',
            'payment_method'      => 'QRIS',
            'status'              => 'Pending',
        ]);

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

        return response()->json([
            'order_id' => $order->id_order,
            'success'  => true,
        ]);
    }
}