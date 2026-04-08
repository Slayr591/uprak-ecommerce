@extends('layouts.app')
@section('title','Riwayat Pesanan - UKK')
@section('content')
<div class="app-viewport">
  <div class="app-canvas !block">
  <header class="h-16 bg-[#fcfcfd] border-b border-[#e3e6eb] px-6 py-4 flex items-center justify-between">
    <a href="{{ route('user.products') }}" class="flex items-center gap-2">
      <div class="w-7 h-7 bg-gray-900 rounded-lg flex items-center justify-center"><svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg></div>
      <span class="font-bold text-gray-900">UKK Store</span>
    </a>
    <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button class="text-sm text-gray-500 hover:text-red-600">Keluar</button></form>
  </header>
  <main class="max-w-5xl mx-auto px-6 py-8">
    @include('partials.alert')
    <h1 class="text-[48px] font-extrabold tracking-tight text-[#111827] mb-6">Transaction History</h1>
    @forelse($orders as $order)
    @php
      $trackingText = match($order->status) {
        'pending' => 'Menunggu pembayaran dari Anda.',
        'paid' => 'Pembayaran diterima, menunggu verifikasi.',
        'confirmed' => 'Pesanan sedang disiapkan oleh tim kami.',
        'shipped' => 'Paket sedang dalam perjalanan ke alamat Anda.',
        'completed' => 'Paket sudah diterima. Pesanan selesai.',
        'cancelled' => 'Pesanan dibatalkan.',
        default => 'Status pesanan sedang diperbarui.',
      };
    @endphp
    <div class="ui-card p-5 mb-4">
      <div class="flex items-center justify-between mb-3">
        <div>
          <p class="font-semibold text-gray-900">{{ $order->order_number }}</p>
          <p class="text-xs text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div class="text-right">
          <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
            @if($order->status=='completed') bg-emerald-50 text-emerald-700
            @elseif($order->status=='shipped') bg-blue-50 text-blue-700
            @elseif($order->status=='cancelled') bg-red-50 text-red-700
            @else bg-amber-50 text-amber-700 @endif">
            {{ $order->status_label }}
          </span>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">{{ $order->items->count() }} item &bull; {{ $order->payment_status_label }}</p>
        <p class="font-bold text-gray-900">{{ $order->total_formatted }}</p>
      </div>

      <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between gap-3">
        <p class="text-xs text-gray-500">Tracking: {{ $trackingText }}</p>
        <div class="flex items-center gap-2">
          <a href="{{ route('user.history.show', $order) }}" class="text-xs px-3 py-1.5 border border-gray-200 rounded-lg hover:bg-gray-50">Lihat Detail</a>

          @if($order->status === 'shipped')
          <form method="POST" action="{{ route('user.history.complete', $order) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="text-xs px-3 py-1.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
              Paket Sudah Sampai
            </button>
          </form>
          @endif
        </div>
      </div>
    </div>
    @empty
    <div class="text-center py-16 bg-white rounded-2xl border border-gray-200">
      <p class="text-gray-400">Belum ada pesanan.</p>
      <a href="{{ route('user.products') }}" class="mt-4 inline-block bg-gray-900 text-white px-6 py-2.5 rounded-lg text-sm font-semibold">Mulai Belanja</a>
    </div>
    @endforelse
    <div class="mt-4">{{ $orders->links() }}</div>
  </main>
  </div>
</div>
@endsection
