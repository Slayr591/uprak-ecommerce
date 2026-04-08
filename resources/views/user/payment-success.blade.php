@extends('layouts.app')
@section('title','Pembayaran Berhasil - UKK')
@section('content')
<div class="app-viewport">
  <div class="app-canvas !block">
  <header class="h-16 bg-[#fcfcfd] border-b border-[#e3e6eb] px-7 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <svg class="w-5 h-5 text-[#16d47d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2m0 0h13.6l-1.2 6H7.2M5.4 5L7.2 13m0 0a2 2 0 102 2m-2-2h8m0 0a2 2 0 102 2"/></svg>
      <span class="text-[30px] font-extrabold tracking-tight">E-Store</span>
    </div>
    <nav class="flex items-center gap-8 text-sm font-semibold text-[#111827]"><a href="{{ route('user.products') }}">Katalog</a><a href="{{ route('user.history') }}">Promo</a><a href="{{ route('user.products') }}">Bantuan</a></nav>
  </header>
  <main class="min-h-[calc(100vh-116px)] flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl border border-gray-200 p-10 max-w-md w-full text-center shadow-xl">
    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
      <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    </div>
    <h1 class="text-2xl font-bold text-gray-900 mb-2">Pembayaran Berhasil!</h1>
    <p class="text-gray-500 text-sm mb-6">Terima kasih! Pesanan Anda sedang diproses oleh tim kami.</p>
    <div class="bg-gray-50 rounded-xl p-4 mb-6 text-sm">
      <div class="flex justify-between mb-2"><span class="text-gray-500">Order ID</span><span class="font-semibold">{{ $order->order_number }}</span></div>
      <div class="flex justify-between"><span class="text-gray-500">Total Pembayaran</span><span class="font-semibold">{{ $order->total_formatted }}</span></div>
    </div>
    <a href="{{ route('user.history') }}" class="block w-full bg-gray-900 text-white py-3 rounded-xl font-semibold hover:bg-gray-800 mb-3">Lihat Riwayat Transaksi</a>
    <a href="{{ route('user.products') }}" class="block w-full border border-gray-200 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-50">Kembali ke Beranda</a>
    @php($waLink = config('app.customer_service_whatsapp'))
    <p class="text-xs text-gray-400 mt-4">Butuh bantuan? <a href="{{ $waLink ?: route('user.products') }}" {{ $waLink ? 'target=_blank rel=noopener noreferrer' : '' }} class="text-gray-900 font-medium">Hubungi Support</a></p>
  </div></main>
  </div>
</div>
@endsection
