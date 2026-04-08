<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('items')->latest()->paginate(10);
        return view('user.history', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);
        $order->load('items.product');
        return view('user.history-detail', compact('order'));
    }

    public function complete(Order $order): RedirectResponse
    {
        abort_if($order->user_id !== Auth::id(), 403);

        if ($order->status === 'completed') {
            return back()->with('success', 'Pesanan sudah berstatus selesai.');
        }

        if ($order->status !== 'shipped') {
            return back()->with('error', 'Pesanan belum dalam status dikirim.');
        }

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Paket telah ditandai sampai. Pesanan selesai.');
    }
}
