@extends('layouts.app')
@section('title','Dashboard - Admin')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.admin-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4">
      <h2 class="text-lg font-semibold text-gray-900">Dashboard Admin</h2>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <p class="text-sm text-gray-500 mb-1">Total Pengguna</p>
          <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <p class="text-sm text-gray-500 mb-1">Total Produk</p>
          <p class="text-3xl font-bold text-gray-900">{{ $stats['total_products'] }}</p>
          @if($stats['low_stock'] > 0)<p class="text-xs text-amber-600 mt-1">{{ $stats['low_stock'] }} stok rendah</p>@endif
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <p class="text-sm text-gray-500 mb-1">Menunggu Konfirmasi</p>
          <p class="text-3xl font-bold text-amber-600">{{ $stats['pending_orders'] }}</p>
          @if($stats['pending_orders'] > 0)<a href="{{ route('admin.orders.index') }}" class="text-xs text-gray-500 hover:underline">Lihat semua</a>@endif
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <p class="text-sm text-gray-500 mb-1">Pendapatan Bulan Ini</p>
          <p class="text-2xl font-bold text-gray-900">{{ \App\Helpers\CurrencyHelper::rupiah($stats['revenue_month']) }}</p>
        </div>
      </div>
      <div class="bg-white rounded-xl border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
          <h3 class="font-semibold text-gray-900">Pesanan Terbaru</h3>
          <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-gray-900">Lihat semua</a>
        </div>
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Order</th>
            <th class="text-left px-6 py-3">Pelanggan</th>
            <th class="text-left px-6 py-3">Total</th>
            <th class="text-left px-6 py-3">Status</th>
            <th class="text-left px-6 py-3">Tanggal</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            @foreach($recentOrders as $order)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $order->order_number }}</td>
              <td class="px-6 py-3 text-sm text-gray-600">{{ $order->user->name }}</td>
              <td class="px-6 py-3 text-sm font-semibold">{{ $order->total_formatted }}</td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full bg-amber-50 text-amber-700">{{ $order->status_label }}</span></td>
              <td class="px-6 py-3 text-sm text-gray-400">{{ $order->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
@endsection
