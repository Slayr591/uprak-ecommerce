@extends('layouts.app')
@section('title','Pesanan - Staff')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.staff-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
      <h2 class="text-lg font-semibold">Daftar Pesanan</h2>
      <form method="GET"><select name="status" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
        <option value="">Semua Status</option>
        @foreach(['pending'=>'Menunggu','paid'=>'Dibayar','confirmed'=>'Dikonfirmasi','shipped'=>'Dikirim','completed'=>'Selesai'] as $v=>$l)
        <option value="{{ $v }}" {{ request('status')==$v?'selected':'' }}>{{ $l }}</option>
        @endforeach
      </select></form>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Order</th><th class="text-left px-6 py-3">Pelanggan</th>
            <th class="text-left px-6 py-3">Total</th><th class="text-left px-6 py-3">Status</th>
            <th class="text-left px-6 py-3">Tanggal</th><th class="text-left px-6 py-3">Aksi</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $order->order_number }}</td>
              <td class="px-6 py-3 text-sm text-gray-600">{{ $order->user->name }}</td>
              <td class="px-6 py-3 text-sm font-semibold">{{ $order->total_formatted }}</td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full {{ $order->status=='confirmed'?'bg-blue-50 text-blue-700':'bg-amber-50 text-amber-700' }}">{{ $order->status_label }}</span></td>
              <td class="px-6 py-3 text-xs text-gray-400">{{ $order->created_at->format('d M Y') }}</td>
              <td class="px-6 py-3 flex items-center gap-2">
                <a href="{{ route('staff.orders.show',$order) }}" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Detail</a>
                @if($order->status=='confirmed')
                <form method="POST" action="{{ route('staff.orders.ship',$order) }}">@csrf @method('PATCH')
                  <button class="text-xs px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kirim</button>
                </form>
                @endif
              </td>
            </tr>
            @empty<tr><td colspan="6" class="text-center py-12 text-gray-400">Tidak ada pesanan.</td></tr>
            @endforelse
          </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $orders->withQueryString()->links() }}</div>
      </div>
    </main>
  </div>
</div>
@endsection
