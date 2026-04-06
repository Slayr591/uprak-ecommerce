<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $stats = [
            'revenue_total'   => Order::where('payment_status','paid')->sum('total'),
            'revenue_month'   => Order::where('payment_status','paid')->whereMonth('created_at', now()->month)->sum('total'),
            'orders_total'    => Order::count(),
            'orders_month'    => Order::whereMonth('created_at', now()->month)->count(),
            'low_stock'       => Product::where('stock','<=',10)->where('stock','>',0)->count(),
            'new_users_month' => User::where('role','user')->whereMonth('created_at', now()->month)->count(),
        ];

        $orders = Order::with('user')
            ->when(request('status'), fn($q) => $q->where('status', request('status')))
            ->latest()->paginate(15);

        return view('admin.reports', compact('stats','orders'));
    }
}
