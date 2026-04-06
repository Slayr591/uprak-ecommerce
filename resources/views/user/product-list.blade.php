@extends('layouts.app')
@section('title','Produk - UKK E-Commerce')
@section('content')
<div class="min-h-screen bg-white">
<header class="border-b border-gray-100 sticky top-0 bg-white z-10">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center gap-4">
    <a href="{{ route('user.products') }}" class="flex items-center gap-2">
      <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg></div>
      <span class="text-xl font-bold text-gray-900">UKK Store</span>
    </a>
    <form method="GET" action="{{ route('user.products') }}" class="flex-1 max-w-md relative">
      <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
    </form>
    <div class="ml-auto flex items-center gap-4">
      <a href="{{ route('cart') }}" class="relative p-2 text-gray-600 hover:text-gray-900">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 7H4l1-7z"/></svg>
        @if(($cartCount ?? 0) > 0)<span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">{{ $cartCount }}</span>@endif
      </a>
      <a href="{{ route('user.history') }}" class="text-sm text-gray-600 hover:text-gray-900">Pesanan Saya</a>
      <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button class="text-sm text-gray-500 hover:text-red-600">Keluar</button></form>
    </div>
  </div>
</header>
<main class="max-w-7xl mx-auto px-6 py-8">
  @include('partials.alert')
  <div class="mb-6"><h1 class="text-3xl font-bold text-gray-900">Produk Kami</h1></div>
  <div class="flex flex-wrap gap-2 mb-8">
    <a href="{{ route('user.products') }}" class="px-4 py-1.5 rounded-full text-sm font-medium {{ !request('category') ? 'bg-gray-900 text-white' : 'border border-gray-200 text-gray-600 hover:border-gray-900' }}">Semua</a>
    @foreach($categories as $cat)
    <a href="{{ route('user.products',['category'=>$cat]) }}" class="px-4 py-1.5 rounded-full text-sm font-medium {{ request('category')==$cat ? 'bg-gray-900 text-white' : 'border border-gray-200 text-gray-600 hover:border-gray-900' }}">{{ $cat }}</a>
    @endforeach
  </div>
  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($products as $product)
    <div class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg transition-all">
      <div class="relative bg-gray-50 aspect-square">
        @if($product->image)
          <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
        @else
          <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          </div>
        @endif
        @if($product->isOutOfStock())
          <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center"><span class="bg-white text-gray-800 text-xs font-bold px-3 py-1 rounded-full">Habis</span></div>
        @elseif($product->isLowStock())
          <span class="absolute top-2 left-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full">Stok Terbatas</span>
        @endif
        @if(!$product->isOutOfStock())
        <form method="POST" action="{{ route('cart.add') }}" class="absolute bottom-2 left-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
          @csrf<input type="hidden" name="product_id" value="{{ $product->id }}">
          <button class="w-full bg-gray-900 text-white text-xs font-semibold py-2 rounded-xl shadow">+ Keranjang</button>
        </form>
        @endif
      </div>
      <div class="p-4">
        <h3 class="font-semibold text-gray-900 text-sm mb-0.5"><a href="{{ route('user.products.show',$product) }}" class="hover:underline">{{ $product->name }}</a></h3>
        <p class="text-xs text-gray-400 mb-2">{{ $product->category }}</p>
        <p class="font-bold text-gray-900">{{ $product->price_formatted }}</p>
      </div>
    </div>
    @empty
    <div class="col-span-4 text-center py-16 text-gray-400">Produk tidak ditemukan.</div>
    @endforelse
  </div>
  <div class="mt-6">{{ $products->withQueryString()->links() }}</div>
</main>
</div>
@endsection
