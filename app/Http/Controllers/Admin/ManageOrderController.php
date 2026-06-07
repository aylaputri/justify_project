<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ManageOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest('order_date')->get();
        return view('admin.orders', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = $request->status;

        if ($request->tracking_number) {
            $order->tracking_number = $request->tracking_number;
        }

        $order->save();

        return response()->json(['success' => true]);
    }
}