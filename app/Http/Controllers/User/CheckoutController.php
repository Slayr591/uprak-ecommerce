<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\{Cart, Order, OrderItem};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($cartItems->isEmpty()) return redirect()->route('cart')->with('error','Keranjang kosong.');
        $subtotal = $cartItems->sum(fn($i) => $i->qty * $i->product->price);
        $tax      = (int)($subtotal * 0.11);
        return view('user.checkout', compact('cartItems','subtotal','tax'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shipping_name'    => 'required|string|max:255',
            'shipping_phone'   => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_city'    => 'required|string|max:100',
            'shipping_postal'  => 'required|string|max:10',
            'shipping_method'  => 'required|in:regular,express,pickup',
            'payment_method'   => 'required|in:bank_transfer,ewallet,cod',
        ]);
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($cartItems->isEmpty()) return redirect()->route('cart');
        $subtotal = $cartItems->sum(fn($i) => $i->qty * $i->product->price);
        $shipping = match($data['shipping_method']) { 'express'=>25000, 'regular'=>12000, default=>0 };
        $tax      = (int)($subtotal * 0.11);
        $total    = $subtotal + $shipping + $tax;
        $orderId  = null;
        DB::transaction(function() use ($data,$cartItems,$subtotal,$shipping,$tax,$total,&$orderId) {
            $order = Order::create(array_merge($data,[
                'user_id'      => auth()->id(),
                'subtotal'     => $subtotal,
                'shipping_cost'=> $shipping,
                'tax'          => $tax,
                'total'        => $total,
            ]));
            foreach ($cartItems as $item) {
                OrderItem::create(['order_id'=>$order->id,'product_id'=>$item->product_id,'product_name'=>$item->product->name,'price'=>$item->product->price,'qty'=>$item->qty,'subtotal'=>$item->qty*$item->product->price]);
                $item->product->decrement('stock', $item->qty);
            }
            Cart::where('user_id', auth()->id())->delete();
            $orderId = $order->id;
        });
        return redirect()->route('payment', $orderId);
    }
}
