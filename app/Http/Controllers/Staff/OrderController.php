<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
            ->when(request('status'), fn($q) => $q->where('status', request('status')))
            ->latest()->paginate(15);
        return view('staff.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product','user');
        return view('staff.orders.show', compact('order'));
    }

    public function ship(Order $order)
    {
        abort_if($order->status !== 'confirmed', 422, 'Pesanan belum dikonfirmasi.');
        $order->update(['status' => 'shipped']);
        return back()->with('success','Pesanan '.$order->order_number.' ditandai Dikirim.');
    }
}
