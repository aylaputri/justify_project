<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user   = User::find(session('user_id'));
        $orders = Order::where('id_user', session('user_id'))
                       ->latest('order_date')
                       ->get();

        $statusCount = [
            'Diproses'   => $orders->where('status', 'Diproses')->count(),
            'Dikirim'    => $orders->where('status', 'Dikirim')->count(),
            'Dibatalkan' => $orders->where('status', 'Dibatalkan')->count(),
            'Selesai'    => $orders->where('status', 'Selesai')->count(),
        ];

        return view('page.profile', compact('user', 'orders', 'statusCount'));
    }
}