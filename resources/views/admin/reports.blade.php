@extends('layouts.app')
@section('title','Laporan - Admin')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.admin-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4"><h2 class="text-lg font-semibold">Laporan Penjualan</h2></header>
    <main class="flex-1 overflow-y-auto p-8">
      <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Total Pendapatan</p><p class="text-2xl font-bold text-gray-900">{{ \App\Helpers\CurrencyHelper::rupiah($stats['revenue_total']) }}</p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Pendapatan Bulan Ini</p><p class="text-2xl font-bold text-emerald-600">{{ \App\Helpers\CurrencyHelper::rupiah($stats['revenue_month']) }}</p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Total Pesanan</p><p class="text-2xl font-bold text-gray-900">{{ number_format($stats['orders_total']) }}</p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Pesanan Bulan Ini</p><p class="text-2xl font-bold text-gray-900">{{ $stats['orders_month'] }}</p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Stok Rendah</p><p class="text-2xl font-bold text-amber-600">{{ $stats['low_stock'] }}</p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">User Baru Bulan Ini</p><p class="text-2xl font-bold text-gray-900">{{ $stats['new_users_month'] }}</p></div>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b flex items-center justify-between">
          <h3 class="font-semibold">Daftar Transaksi</h3>
          <form method="GET"><select name="status" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm focus:outline-none">
            <option value="">Semua Status</option>
            @foreach(['pending'=>'Menunggu','paid'=>'Dibayar','confirmed'=>'Dikonfirmasi','shipped'=>'Dikirim','completed'=>'Selesai'] as $v=>$l)
            <option value="{{ $v }}" {{ request('status')==$v?'selected':'' }}>{{ $l }}</option>
            @endforeach
          </select></form>
        </div>
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Order ID</th><th class="text-left px-6 py-3">Pelanggan</th>
            <th class="text-left px-6 py-3">Total</th><th class="text-left px-6 py-3">Metode Bayar</th>
            <th class="text-left px-6 py-3">Status</th><th class="text-left px-6 py-3">Tanggal</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $order->order_number }}</td>
              <td class="px-6 py-3 text-sm text-gray-600">{{ $order->user->name }}</td>
              <td class="px-6 py-3 text-sm font-semibold">{{ $order->total_formatted }}</td>
              <td class="px-6 py-3 text-sm text-gray-600">{{ $order->payment_method }}</td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full {{ $order->payment_status=='paid'?'bg-emerald-50 text-emerald-700':'bg-amber-50 text-amber-700' }}">{{ $order->payment_status_label }}</span></td>
              <td class="px-6 py-3 text-xs text-gray-400">{{ $order->created_at->format('d M Y') }}</td>
            </tr>
            @empty<tr><td colspan="6" class="text-center py-10 text-gray-400">Tidak ada data.</td></tr>
            @endforelse
          </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $orders->withQueryString()->links() }}</div>
      </div>
    </main>
  </div>
</div>
@endsection
