<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::when(request('search'), fn($q) =>
                $q->where('name','like','%'.request('search').'%')
                  ->orWhere('sku','like','%'.request('search').'%'))
            ->when(request('category'), fn($q) => $q->where('category', request('category')))
            ->latest()->paginate(15);
        $categories = Product::distinct()->pluck('category');
        return view('admin.products.index', compact('products','categories'));
    }

    public function create()
    {
        $categories = Product::distinct()->pluck('category');
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'required|string|max:100',
            'sku'         => 'required|string|max:100|unique:products',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products','public');
        }
        $data['slug'] = Str::slug($data['name']);
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success','Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Product::distinct()->pluck('category');
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'required|string|max:100',
            'sku'         => 'required|string|max:100|unique:products,sku,'.$product->id,
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'   => 'boolean',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products','public');
        }
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active', true);
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success','Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Produk dihapus.');
    }
}
