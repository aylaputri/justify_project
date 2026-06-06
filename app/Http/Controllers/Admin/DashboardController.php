<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = 0;

        $totalProducts = Product::count();

        $totalOrders = 0;

        $totalCustomers = User::count();

        $totalStaff = Admin::count();

        $salesChart = [0, 0, 0, 0, 0, 0];

        $topProducts = [];

        $recentOrders = [];

        return view(
            'admin.dashboard',
            compact(
                'totalRevenue',
                'totalProducts',
                'totalOrders',
                'totalCustomers',
                'totalStaff',
                'salesChart',
                'topProducts',
                'recentOrders'
            )
        );
    }
}
