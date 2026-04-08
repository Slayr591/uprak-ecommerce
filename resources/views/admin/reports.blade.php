@extends('layouts.app')
@section('title','Laporan - Admin')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.admin-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
      <nav class="flex items-center gap-6 text-sm">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-900">Dashboard</a>
        <a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-gray-900">Orders</a>
        <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-900">Products</a>
        <a href="{{ route('admin.reports') }}" class="text-black font-medium border-b-2 border-black pb-1">Reports</a>
      </nav>
      <div class="flex items-center gap-4">
        <div class="relative">
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <input type="text" placeholder="Search data..." class="pl-10 pr-4 py-2 bg-gray-100 rounded-lg text-sm w-64 focus:outline-none">
        </div>
        <button class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center relative">
          <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.31 2.31 0 0118 14.235V11a6 6 0 10-12 0v3.235c0 .628-.134 1.219-.401 1.76L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        </button>
        <div class="w-8 h-8 rounded-full bg-amber-200"></div>
      </div>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <div class="mb-8 px-2">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
          <span>Admin</span>
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
          <span class="text-gray-900 font-medium">Sales & Stock Reports</span>
        </div>
        <div class="flex items-start justify-between">
          <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Reports Overview</h1>
            <p class="text-gray-500 max-w-md">Comprehensive insights into your platform's financial performance, inventory health, and transaction history.</p>
          </div>
          <button class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-lg text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Oct 01 - Oct 31, 2023
          </button>
        </div>
      </div>
      
      <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <p class="text-xs font-medium text-gray-500 uppercase mb-1">Total Revenue</p>
          <p class="text-2xl font-bold text-gray-900 mb-1">{{ \App\Helpers\CurrencyHelper::rupiah($stats['revenue_month']) }}</p>
          <p class="text-xs text-green-500 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            +12.5% vs last month
          </p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <p class="text-xs font-medium text-gray-500 uppercase mb-1">Low Stock Items</p>
          <p class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['low_stock'] ?? 18 }}</p>
          <p class="text-xs text-red-500 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            Action required
          </p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <p class="text-xs font-medium text-gray-500 uppercase mb-1">New Customers</p>
          <p class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['new_users_month'] ?? 1240 }}</p>
          <p class="text-xs text-green-500 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            +8.2% vs last month
          </p>
        </div>
        <div class="bg-green-100 rounded-xl border border-green-200 p-6">
          <p class="text-xs font-medium text-green-700 uppercase mb-1">Current Conversion</p>
          <p class="text-2xl font-bold text-gray-900 mb-1">3.42%</p>
          <p class="text-xs text-green-600 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Optimized Performance
          </p>
        </div>
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
