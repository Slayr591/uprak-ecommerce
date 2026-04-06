<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
        return view('user.payment', compact('order'));
    }
    public function upload(Request $request, Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
        $request->validate(['payment_proof'=>'required|image|mimes:jpg,jpeg,png|max:5120']);
        $path = $request->file('payment_proof')->store('payment-proofs','public');
        $order->update(['payment_proof'=>$path,'payment_status'=>'pending_verification','status'=>'paid']);
        return redirect()->route('payment.success', $order)->with('success','Bukti pembayaran berhasil diunggah!');
    }
    public function success(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
        return view('user.payment-success', compact('order'));
    }
}
