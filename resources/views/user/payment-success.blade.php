@extends('layouts.app')
@section('title','Pembayaran Berhasil - UKK')
@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl border border-gray-200 p-10 max-w-md w-full text-center">
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
  </div>
</div>
@endsection
