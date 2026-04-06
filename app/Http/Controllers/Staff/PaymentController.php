<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;

class PaymentController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
            ->where('payment_status','pending_verification')
            ->latest()->paginate(15);
        return view('staff.payments.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product','user');
        return view('staff.payments.show', compact('order'));
    }

    public function confirm(Order $order)
    {
        $order->update([
            'payment_status' => 'paid',
            'status'         => 'confirmed',
            'confirmed_by'   => auth()->id(),
            'confirmed_at'   => now(),
        ]);
        return redirect()->route('staff.payments.index')->with('success','Pembayaran #'.$order->order_number.' dikonfirmasi.');
    }

    public function reject(Order $order)
    {
        $order->update([
            'payment_status' => 'rejected',
            'status'         => 'pending',
        ]);
        return redirect()->route('staff.payments.index')->with('error','Pembayaran ditolak.');
    }
}
