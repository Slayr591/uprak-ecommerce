@extends('layouts.app')
@section('title','Pembayaran - UKK E-Commerce')
@section('content')
<div class="min-h-screen bg-gray-50">
  <header class="bg-white border-b border-gray-200 px-6 py-4">
    <span class="font-bold text-gray-900">Selesaikan Pembayaran</span>
  </header>
  <main class="max-w-4xl mx-auto px-6 py-8">
    @include('partials.alert')
    <div class="flex gap-8 items-start">
      <div class="flex-1">
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
          <h2 class="font-bold text-gray-900 mb-4">Informasi Rekening Tujuan</h2>
          <div class="grid grid-cols-3 gap-4 text-sm">
            <div><p class="text-gray-400 mb-1">Nama Bank</p><p class="font-semibold">Bank Mandiri (IDR)</p></div>
            <div><p class="text-gray-400 mb-1">Nomor Rekening</p><p class="font-semibold text-lg">124 000 789 5562</p></div>
            <div><p class="text-gray-400 mb-1">Atas Nama</p><p class="font-semibold">PT. UKK E-COMMERCE</p></div>
          </div>
          <div class="mt-4 p-3 bg-amber-50 border border-amber-200 rounded-lg text-xs text-amber-700">
            Transfer tepat sesuai nominal termasuk 3 digit unik untuk verifikasi otomatis.
          </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <h2 class="font-bold text-gray-900 mb-4">Unggah Bukti Pembayaran</h2>
          <form method="POST" action="{{ route('payment.upload', $order->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center mb-4">
              <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
              <p class="text-sm text-gray-500 mb-2">Klik untuk unggah atau seret file ke sini</p>
              <p class="text-xs text-gray-400">Format: JPG, PNG (Maks. 5MB)</p>
              <input type="file" name="payment_proof" accept="image/*" required class="mt-3 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-900 file:text-white hover:file:bg-gray-700 cursor-pointer">
            </div>
            <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-xl font-semibold hover:bg-gray-800">Kirim Bukti Pembayaran</button>
          </form>
        </div>
      </div>
      <div class="w-72 flex-shrink-0">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <h2 class="font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>
          <div class="space-y-2 text-sm">
            <div class="flex justify-between"><span class="text-gray-500">Order ID</span><span class="font-medium">{{ $order->order_number }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span>{{ \App\Helpers\CurrencyHelper::rupiah($order->subtotal) }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Ongkir</span><span>{{ \App\Helpers\CurrencyHelper::rupiah($order->shipping_cost) }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Pajak</span><span>{{ \App\Helpers\CurrencyHelper::rupiah($order->tax) }}</span></div>
            <div class="border-t pt-2 flex justify-between font-bold"><span>Total Bayar</span><span class="text-lg">{{ $order->total_formatted }}</span></div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection
