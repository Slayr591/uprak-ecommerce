<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products   = Product::active()
            ->when(request('category'), fn($q) => $q->category(request('category')))
            ->when(request('search'), fn($q) => $q->where('name','like','%'.request('search').'%'))
            ->paginate(8);
        $categories = Product::active()->distinct()->pluck('category');
        return view('user.product-list', compact('products','categories'));
    }

    public function show(Product $product)
    {
        abort_if(!$product->is_active, 404);
        return view('user.product-detail', compact('product'));
    }
}
