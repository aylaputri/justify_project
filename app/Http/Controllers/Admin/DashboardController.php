<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = 0;
        $totalProducts = 0;
        $totalOrders = 0;
        $totalCustomers = 0;
        $totalStaff = 0;

        $salesChart = [0, 0, 0, 0, 0, 0];

        $topProducts = [];

        $recentOrders = [];

        return view(
            'page.admin.dashboard',
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
