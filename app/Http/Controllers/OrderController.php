<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $userId = session('user_id');
        $status = request('status', 'Semua');

        $query = Order::with([
            'items.variant.product',
            'items.variant.images',
        ])->where('id_user', $userId)->latest('order_date');

        if ($status !== 'Semua') {
            $query->where('status', $status);
        }

        $orders = $query->get();

        return view('page.orders', compact('orders'));
    }
}