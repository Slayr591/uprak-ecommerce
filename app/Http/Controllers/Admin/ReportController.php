<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        try {
            $selectedMonth = $request->filled('month')
                ? Carbon::createFromFormat('Y-m', $request->string('month'))->startOfMonth()
                : now()->startOfMonth();
        } catch (\Throwable $th) {
            $selectedMonth = now()->startOfMonth();
        }

        $startDate = $selectedMonth->copy()->startOfMonth();
        $endDate = $selectedMonth->copy()->endOfMonth();
        $previousStart = $selectedMonth->copy()->subMonth()->startOfMonth();
        $previousEnd = $selectedMonth->copy()->subMonth()->endOfMonth();

        $revenueMonth = Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total');

        $previousRevenueMonth = Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [$previousStart, $previousEnd])
            ->sum('total');

        $ordersMonth = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        $paidOrdersMonth = Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $newUsersMonth = User::where('role', 'user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $previousNewUsersMonth = User::where('role', 'user')
            ->whereBetween('created_at', [$previousStart, $previousEnd])
            ->count();

        $stats = [
            'revenue_total'   => Order::where('payment_status','paid')->sum('total'),
            'revenue_month'   => $revenueMonth,
            'orders_total'    => Order::count(),
            'orders_month'    => $ordersMonth,
            'low_stock'       => Product::where('stock','<=',10)->where('stock','>',0)->count(),
            'new_users_month' => $newUsersMonth,
            'paid_orders_month' => $paidOrdersMonth,
            'conversion_rate' => $ordersMonth > 0 ? round(($paidOrdersMonth / $ordersMonth) * 100, 2) : 0,
            'revenue_growth' => $this->calculateGrowth($previousRevenueMonth, $revenueMonth),
            'new_users_growth' => $this->calculateGrowth($previousNewUsersMonth, $newUsersMonth),
        ];

        $search = trim((string) $request->input('search', ''));

        $orders = Order::with(['user', 'items.product'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->input('status')))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($inner) use ($search) {
                    $inner->where('order_number', 'like', '%' . $search . '%')
                        ->orWhere('payment_method', 'like', '%' . $search . '%')
                        ->orWhereHas('user', fn($user) => $user->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%'))
                        ->orWhereHas('items', fn($items) => $items->where('product_name', 'like', '%' . $search . '%'));
                });
            })
            ->latest()->paginate(15);

        $dateRangeLabel = $startDate->translatedFormat('d M Y') . ' - ' . $endDate->translatedFormat('d M Y');

        return view('admin.reports', compact('stats','orders', 'selectedMonth', 'dateRangeLabel', 'search'));
    }

    private function calculateGrowth(float|int $previous, float|int $current): float
    {
        if ($previous <= 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }
}
