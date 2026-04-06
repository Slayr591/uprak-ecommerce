<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'    => User::where('role','user')->count(),
            'total_staff'    => User::where('role','staff')->count(),
            'total_products' => Product::count(),
            'total_orders'   => Order::count(),
            'pending_orders' => Order::where('payment_status','pending_verification')->count(),
            'revenue_month'  => Order::where('payment_status','paid')
                                    ->whereMonth('created_at', now()->month)
                                    ->sum('total'),
            'low_stock'      => Product::where('stock','<=',10)->where('stock','>',0)->count(),
            'out_of_stock'   => Product::where('stock',0)->count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats','recentOrders'));
    }
}
