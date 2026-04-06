<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $subtotal  = $cartItems->sum(fn($i) => $i->qty * $i->product->price);
        $shipping  = 0;
        $tax       = (int)($subtotal * 0.11);
        $total     = $subtotal + $shipping + $tax;
        return view('user.cart', compact('cartItems','subtotal','shipping','tax','total'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id'=>'required|exists:products,id','qty'=>'integer|min:1']);
        $product = Product::findOrFail($request->product_id);
        if ($product->stock < 1) return back()->with('error','Stok produk habis.');

        $cart = Cart::firstOrNew(['user_id'=>auth()->id(),'product_id'=>$request->product_id]);
        $newQty = ($cart->exists ? $cart->qty : 0) + (int)($request->qty ?? 1);
        if ($newQty > $product->stock) return back()->with('error','Stok tidak mencukupi.');
        $cart->qty = $newQty;
        $cart->save();
        return back()->with('success','Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, Cart $cart)
    {
        abort_if($cart->user_id !== auth()->id(), 403);
        $request->validate(['qty'=>'required|integer|min:1']);
        if ($request->qty > $cart->product->stock) return back()->with('error','Stok tidak mencukupi.');
        $cart->update(['qty'=>$request->qty]);
        return back()->with('success','Keranjang diperbarui.');
    }

    public function destroy(Cart $cart)
    {
        abort_if($cart->user_id !== auth()->id(), 403);
        $cart->delete();
        return back()->with('success','Item dihapus.');
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();
        return back()->with('success','Keranjang dikosongkan.');
    }
}
