@extends('layouts.app')
@section('title','Pesanan - Admin')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.admin-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4"><h2 class="text-lg font-semibold">Manajemen Pesanan</h2></header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
        <form method="GET" class="flex gap-3">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor pesanan..." class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
          <select name="status" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
            <option value="">Semua Status</option>
            @foreach(['pending'=>'Menunggu','paid'=>'Dibayar','confirmed'=>'Dikonfirmasi','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Dibatalkan'] as $v=>$l)
            <option value="{{ $v }}" {{ request('status')==$v?'selected':'' }}>{{ $l }}</option>
            @endforeach
          </select>
          <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium">Filter</button>
        </form>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Order</th><th class="text-left px-6 py-3">Pelanggan</th>
            <th class="text-left px-6 py-3">Total</th><th class="text-left px-6 py-3">Status</th>
            <th class="text-left px-6 py-3">Pembayaran</th><th class="text-left px-6 py-3">Tanggal</th>
            <th class="text-left px-6 py-3">Aksi</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $order->order_number }}</td>
              <td class="px-6 py-3 text-sm text-gray-600">{{ $order->user->name }}</td>
              <td class="px-6 py-3 text-sm font-semibold">{{ $order->total_formatted }}</td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full bg-amber-50 text-amber-700">{{ $order->status_label }}</span></td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full {{ $order->payment_status=='paid'?'bg-emerald-50 text-emerald-700':'bg-gray-100 text-gray-600' }}">{{ $order->payment_status_label }}</span></td>
              <td class="px-6 py-3 text-xs text-gray-400">{{ $order->created_at->format('d M Y') }}</td>
              <td class="px-6 py-3"><a href="{{ route('admin.orders.show',$order) }}" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Detail</a></td>
            </tr>
            @empty<tr><td colspan="7" class="text-center py-12 text-gray-400">Tidak ada pesanan.</td></tr>
            @endforelse
          </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $orders->withQueryString()->links() }}</div>
      </div>
    </main>
  </div>
</div>
@endsection
