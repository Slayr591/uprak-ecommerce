<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending_payments' => Order::where('payment_status','pending_verification')->count(),
            'processed_today'  => Order::where('payment_status','paid')->whereDate('confirmed_at', today())->sum('total'),
            'total_products'   => Product::count(),
            'low_stock'        => Product::where('stock','<=',10)->where('stock','>',0)->count(),
        ];
        $recentOrders = Order::with('user')->where('payment_status','pending_verification')->latest()->take(5)->get();
        return view('staff.dashboard', compact('stats','recentOrders'));
    }
}
