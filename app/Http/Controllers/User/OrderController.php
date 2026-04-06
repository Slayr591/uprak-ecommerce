<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->with('items')->latest()->paginate(10);
        return view('user.history', compact('orders'));
    }
    public function show(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
        $order->load('items.product');
        return view('user.order-detail', compact('order'));
    }
}
