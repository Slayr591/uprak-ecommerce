@extends('layouts.app')
@section('title', $product->name . ' - UKK')
@section('content')
<div class="min-h-screen bg-white">
  <header class="border-b border-gray-100 bg-white px-6 py-4 flex items-center gap-4">
    <a href="{{ route('user.products') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 text-sm">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Kembali
    </a>
    <a href="{{ route('cart') }}" class="ml-auto relative p-2 text-gray-600">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 7H4l1-7z"/></svg>
      @if(($cartCount ?? 0) > 0)<span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">{{ $cartCount }}</span>@endif
    </a>
  </header>
  <main class="max-w-5xl mx-auto px-6 py-10">
    @include('partials.alert')
    <div class="flex gap-12">
      <div class="w-96 flex-shrink-0">
        <div class="aspect-square bg-gray-100 rounded-2xl overflow-hidden">
          @if($product->image)<img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover">
          @else<div class="w-full h-full flex items-center justify-center"><svg class="w-20 h-20 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>@endif
        </div>
      </div>
      <div class="flex-1">
        <p class="text-sm text-gray-400 mb-2">{{ $product->category }}</p>
        <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $product->name }}</h1>
        <p class="text-3xl font-bold text-gray-900 mb-4">{{ $product->price_formatted }}</p>
        @if($product->isOutOfStock())
          <div class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-full text-sm font-medium mb-4">Stok Habis</div>
        @elseif($product->isLowStock())
          <div class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-700 rounded-full text-sm font-medium mb-4">Stok Tersisa: {{ $product->stock }}</div>
        @else
          <div class="inline-flex items-center px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-full text-sm font-medium mb-4">Stok: {{ $product->stock }}</div>
        @endif
        <p class="text-gray-600 text-sm leading-relaxed mb-6">{{ $product->description }}</p>
        <div class="text-xs text-gray-400 mb-6">SKU: {{ $product->sku }}</div>
        @if(!$product->isOutOfStock())
        <form method="POST" action="{{ route('cart.add') }}" class="flex gap-3">
          @csrf<input type="hidden" name="product_id" value="{{ $product->id }}">
          <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}" class="w-20 border border-gray-200 rounded-lg px-3 py-2.5 text-center text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
          <button type="submit" class="flex-1 bg-gray-900 text-white py-2.5 rounded-xl font-semibold hover:bg-gray-800 transition-colors">Tambah ke Keranjang</button>
        </form>
        @endif
      </div>
    </div>
  </main>
</div>
@endsection
