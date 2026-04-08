@extends('layouts.app')
@section('title','Checkout - UKK E-Commerce')
@section('content')
<div class="app-viewport">
  <div class="app-canvas !block">
  <header class="h-16 bg-[#fcfcfd] border-b border-[#e3e6eb] px-7 py-4">
    <a href="{{ route('cart') }}" class="flex items-center gap-2 text-[#4b5563] hover:text-gray-900 text-sm font-semibold">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Kembali ke Keranjang
    </a>
  </header>
  <main class="max-w-6xl mx-auto px-8 py-8">
    @include('partials.alert')
    <h1 class="text-[52px] font-extrabold tracking-tight text-[#111827] mb-2">Checkout</h1>
    <form method="POST" action="{{ route('checkout.store') }}">
      @csrf
      <div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-8 items-start">
        <div class="flex-1 space-y-6">
          {{-- Shipping --}}
          <div class="ui-card p-6">
            <h2 class="font-bold text-gray-900 mb-4 flex items-center gap-2"><span class="w-6 h-6 bg-gray-900 text-white rounded-full text-xs flex items-center justify-center">1</span> Informasi Pengiriman</h2>
            <div class="grid grid-cols-2 gap-4">
              <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                <input type="text" name="shipping_name" value="{{ old('shipping_name', auth()->user()->name) }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
              </div>
              <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                <input type="text" name="shipping_phone" value="{{ old('shipping_phone', auth()->user()->phone) }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
              </div>
              <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <input type="text" name="shipping_address" value="{{ old('shipping_address', auth()->user()->address) }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                <input type="text" name="shipping_postal" value="{{ old('shipping_postal') }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
              </div>
            </div>
          </div>
          {{-- Shipping Method --}}
          <div class="ui-card p-6">
            <h2 class="font-bold text-gray-900 mb-4 flex items-center gap-2"><span class="w-6 h-6 bg-gray-900 text-white rounded-full text-xs flex items-center justify-center">2</span> Metode Pengiriman</h2>
            <div class="space-y-3">
              <label class="flex items-center justify-between p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-gray-900 has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                <div class="flex items-center gap-3"><input type="radio" name="shipping_method" value="regular" checked class="accent-gray-900"><div><p class="font-medium text-sm">Reguler (2-3 Hari)</p></div></div>
                <span class="font-semibold text-sm">Rp 12.000</span>
              </label>
              <label class="flex items-center justify-between p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-gray-900 has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                <div class="flex items-center gap-3"><input type="radio" name="shipping_method" value="express" class="accent-gray-900"><div><p class="font-medium text-sm">Ekspres (Besok)</p></div></div>
                <span class="font-semibold text-sm">Rp 25.000</span>
              </label>
              <label class="flex items-center justify-between p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-gray-900 has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                <div class="flex items-center gap-3"><input type="radio" name="shipping_method" value="pickup" class="accent-gray-900"><div><p class="font-medium text-sm">Ambil di Toko</p></div></div>
                <span class="font-semibold text-sm text-emerald-600">Gratis</span>
              </label>
            </div>
          </div>
          {{-- Payment --}}
          <div class="ui-card p-6">
            <h2 class="font-bold text-gray-900 mb-4 flex items-center gap-2"><span class="w-6 h-6 bg-gray-900 text-white rounded-full text-xs flex items-center justify-center">3</span> Metode Pembayaran</h2>
            <div class="space-y-3">
              <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-gray-900 has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                <input type="radio" name="payment_method" value="bank_transfer" checked class="accent-gray-900">
                <div><p class="font-medium text-sm">Transfer Bank</p><p class="text-xs text-gray-400">Mandiri / BCA</p></div>
              </label>
              {{-- <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-gray-900 has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                <input type="radio" name="payment_method" value="ewallet" class="accent-gray-900">
                <div><p class="font-medium text-sm">E-Wallet / QRIS</p><p class="text-xs text-gray-400">Dana, OVO, GoPay, LinkAja</p></div>
              </label>
              <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-gray-900 has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                <input type="radio" name="payment_method" value="cod" class="accent-gray-900">
                <div><p class="font-medium text-sm">Bayar di Tempat (COD)</p><p class="text-xs text-gray-400">Cash on Delivery</p></div>
              </label> --}}
            </div>
          </div>
        </div>
        {{-- Order Summary --}}
        <div class="w-full flex-shrink-0">
          <div class="ui-card p-6 sticky top-4">
            <h2 class="text-[33px] font-extrabold tracking-tight text-[#111827] mb-4">Ringkasan Pesanan</h2>
            @foreach($cartItems as $item)
            <div class="flex items-center gap-3 py-2 border-b border-gray-100 last:border-0">
              <div class="w-10 h-10 bg-gray-100 rounded-lg flex-shrink-0"></div>
              <div class="flex-1 min-w-0"><p class="text-xs font-medium text-gray-900 truncate">{{ $item->product->name }}</p><p class="text-xs text-gray-400">x{{ $item->qty }}</p></div>
              <p class="text-xs font-semibold">{{ \App\Helpers\CurrencyHelper::rupiah($item->qty * $item->product->price) }}</p>
            </div>
            @endforeach
            <div class="space-y-2 text-sm mt-4">
              <div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span>{{ \App\Helpers\CurrencyHelper::rupiah($subtotal) }}</span></div>
              <div class="flex justify-between"><span class="text-gray-500">Pajak (11%)</span><span>{{ \App\Helpers\CurrencyHelper::rupiah($tax) }}</span></div>
            </div>
            <button type="submit" class="mt-4 w-full h-12 rounded-xl bg-black text-white font-bold hover:bg-[#111827] transition-colors">Lanjut ke Pembayaran</button>
            <p class="text-xs text-gray-400 text-center mt-3">Dengan melanjutkan, Anda menyetujui Syarat &amp; Ketentuan kami.</p>
          </div>
        </div>
      </div>
    </form>
  </main>
  <footer class="h-14 border-t border-[#e3e6eb] text-xs text-[#9aa1ad] flex items-center justify-center">SECURE CHECKOUT</footer>
  </div>
</div>
@endsection
