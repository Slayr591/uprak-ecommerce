@extends('layouts.app')
@section('title','Riwayat Pesanan - UKK')
@section('content')
<div class="min-h-screen bg-gray-50">
  <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
    <a href="{{ route('user.products') }}" class="flex items-center gap-2">
      <div class="w-7 h-7 bg-gray-900 rounded-lg flex items-center justify-center"><svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg></div>
      <span class="font-bold text-gray-900">UKK Store</span>
    </a>
    <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button class="text-sm text-gray-500 hover:text-red-600">Keluar</button></form>
  </header>
  <main class="max-w-4xl mx-auto px-6 py-8">
    @include('partials.alert')
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Riwayat Pesanan</h1>
    @forelse($orders as $order)
    <div class="bg-white rounded-xl border border-gray-200 p-5 mb-4">
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
@endsection
