<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();
        $previousMonthStart = now()->subMonthNoOverflow()->startOfMonth();
        $previousMonthEnd = now()->subMonthNoOverflow()->endOfMonth();

        $newUsersCurrent = User::where('role', 'user')->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();
        $newUsersPrevious = User::where('role', 'user')->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();
        $newStaffCurrent = User::where('role', 'staff')->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();
        $newStaffPrevious = User::where('role', 'staff')->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();
        $revenuePrevious = Order::where('payment_status', 'paid')->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->sum('total');
        $revenueCurrent = Order::where('payment_status', 'paid')->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->sum('total');

        $stats = [
            'total_users'    => User::where('role','user')->count(),
            'total_staff'    => User::where('role','staff')->count(),
            'total_products' => Product::count(),
            'total_orders'   => Order::count(),
            'pending_orders' => Order::where('payment_status','pending_verification')->count(),
            'revenue_month'  => $revenueCurrent,
            'low_stock'      => Product::where('stock','<=',10)->where('stock','>',0)->count(),
            'out_of_stock'   => Product::where('stock',0)->count(),
            'active_staff'   => User::where('role', 'staff')->where('is_active', true)->count(),
            'user_growth'    => $this->calculateGrowth($newUsersPrevious, $newUsersCurrent),
            'staff_growth'   => $this->calculateGrowth($newStaffPrevious, $newStaffCurrent),
            'revenue_growth' => $this->calculateGrowth($revenuePrevious, $revenueCurrent),
        ];

        // Chart Data 7 bulan terakhir (nominal asli rupiah)
        $chartData = [];
        $chartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $chartData[] = Order::where('payment_status','paid')
                                ->whereMonth('created_at', $date->month)
                                ->whereYear('created_at', $date->year)
                                ->sum('total');
            $chartLabels[] = strtoupper($date->format('M'));
        }

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // Recent Activity
        $recentActivity = collect();

        // Add order activity
        foreach (Order::latest()->take(3)->get() as $order) {
            $recentActivity->push([
                'user' => $order->user,
                'action' => 'Order ' . $order->order_number . ' ' . $order->status_label,
                'type' => $order->user->role,
                'time' => $order->created_at->diffForHumans()
            ]);
        }

        return view('admin.dashboard', compact('stats','recentOrders','chartData','chartLabels','recentActivity'));
    }

    private function calculateGrowth(float|int $previous, float|int $current): float
    {
        if ($previous <= 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }
}
