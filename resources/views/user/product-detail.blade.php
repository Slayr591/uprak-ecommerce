@extends('layouts.app')
@section('title', $product->name . ' - UKK')
@section('content')
@php($redirectTarget = request()->fullUrl())
<div class="min-h-screen bg-white">
  <header class="border-b border-gray-100 bg-white px-6 py-4 flex items-center gap-4">
    <a href="{{ route('user.products') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 text-sm">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Kembali
    </a>
    <div class="ml-auto flex items-center gap-3">
      @auth
        <a href="{{ route('cart') }}" class="relative p-2 text-gray-600 hover:text-gray-900">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 7H4l1-7z"/></svg>
          @if(($cartCount ?? 0) > 0)<span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">{{ $cartCount }}</span>@endif
        </a>
        <a href="{{ route('user.profile') }}" class="text-sm text-gray-600 hover:text-gray-900">Account</a>
        <a href="{{ route('user.profile') }}" class="block">
          @if(auth()->user()->profile_photo_url)
            <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover border border-gray-200">
          @else
            <div class="w-8 h-8 rounded-full bg-amber-200 flex items-center justify-center text-xs font-bold text-gray-800">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
          @endif
        </a>
        <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button class="text-sm text-gray-500 hover:text-red-600">Keluar</button></form>
      @else
        <a href="{{ route('login', ['redirect' => $redirectTarget]) }}" class="text-sm text-gray-600 hover:text-gray-900">Masuk</a>
        <a href="{{ route('register', ['redirect' => $redirectTarget]) }}" class="px-3 py-1.5 text-sm font-medium rounded-lg bg-gray-900 text-white hover:bg-gray-800">Daftar</a>
      @endauth
    </div>
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
          @auth
            <form method="POST" action="{{ route('cart.add') }}" class="flex gap-3">
              @csrf<input type="hidden" name="product_id" value="{{ $product->id }}">
              <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}" class="w-20 border border-gray-200 rounded-lg px-3 py-2.5 text-center text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
              <button type="submit" class="flex-1 bg-gray-900 text-white py-2.5 rounded-xl font-semibold hover:bg-gray-800 transition-colors">Tambah ke Keranjang</button>
            </form>
          @else
            <div class="space-y-3">
              <p class="text-sm text-gray-600">Untuk membeli produk ini, silakan login atau daftar terlebih dahulu.</p>
              <div class="flex gap-3">
                <a href="{{ route('login', ['redirect' => $redirectTarget]) }}" class="flex-1 text-center bg-gray-900 text-white py-2.5 rounded-xl font-semibold hover:bg-gray-800 transition-colors">Login</a>
                <a href="{{ route('register', ['redirect' => $redirectTarget]) }}" class="flex-1 text-center border border-gray-300 text-gray-700 py-2.5 rounded-xl font-semibold hover:bg-gray-50 transition-colors">Register</a>
              </div>
            </div>
          @endauth
        @endif
      </div>
    </div>
  </main>

  @php($waLink = config('app.customer_service_whatsapp'))
  @if($waLink)
    <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-3 rounded-full shadow-lg transition-colors z-20">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 2C6.486 2 2 6.486 2 12.017a9.96 9.96 0 001.353 5.01L2 22l5.122-1.337a9.974 9.974 0 004.895 1.272h.004C17.552 21.935 22 17.448 22 11.917 22 6.386 17.548 2 12.017 2zm5.903 14.266c-.245.693-1.451 1.327-1.997 1.36-.511.03-1.157.044-1.868-.184-.431-.138-.984-.321-1.701-.63-2.995-1.293-4.947-4.314-5.098-4.515-.15-.2-1.217-1.62-1.217-3.09 0-1.471.773-2.195 1.046-2.494.274-.299.599-.374.799-.374h.573c.18 0 .423-.068.66.501.246.594.835 2.053.909 2.202.074.149.123.323.025.522-.099.199-.149.323-.298.497-.149.174-.314.389-.447.522-.149.149-.304.31-.131.609.173.299.771 1.27 1.654 2.056 1.136 1.013 2.094 1.327 2.393 1.476.299.149.473.124.646-.075.173-.199.744-.869.943-1.168.198-.299.397-.249.671-.149.274.099 1.736.819 2.034.968.299.149.497.223.571.347.074.124.074.719-.171 1.412z"/></svg>
      <span>Customer Service</span>
    </a>
  @endif
</div>
@endsection
