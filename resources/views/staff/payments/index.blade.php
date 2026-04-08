@extends('layouts.app')
@section('title','Konfirmasi Pembayaran - Staff')
@section('content')
<div class="app-viewport">
  <div class="app-canvas">
  @include('partials.staff-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden bg-[#f7f8fa]">
    <header class="h-16 bg-[#fbfbfc] border-b border-[#dfe3e8] px-8 py-4 flex items-center justify-between"><h2 class="text-[46px] font-extrabold tracking-tight">STAFF PAYMENT CONFIRMATION</h2><a href="#" class="btn-dark !h-10">Export Report</a></header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="grid grid-cols-3 gap-4 mb-4">
        <div class="ui-card p-4"><p class="text-sm text-gray-500">Pending Approvals</p><p class="text-5xl font-extrabold">{{ $orders->total() }}</p></div>
        <div class="rounded-xl border border-[#121212] bg-[#8cf58f] p-4"><p class="text-sm">Processed Today</p><p class="text-5xl font-extrabold">Rp.211.957.000</p></div>
        <div class="ui-card p-4"><p class="text-sm text-gray-500">Rejection Rate</p><p class="text-5xl font-extrabold">3.2%</p></div>
      </div>
      <div class="ui-card overflow-hidden border-2 border-black">
        <table class="w-full">
          <thead><tr class="bg-black text-xs font-bold text-white uppercase">
            <th class="text-left px-6 py-3">User Name</th><th class="text-left px-6 py-3">Date & Time</th>
            <th class="text-left px-6 py-3">Order ID</th><th class="text-left px-6 py-3">Amount</th><th class="text-left px-6 py-3">Payment Proof</th><th class="text-left px-6 py-3">Actions</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3"><p class="text-sm font-semibold">{{ $order->user->name }}</p><p class="text-xs text-gray-400">{{ $order->user->email }}</p></td>
              <td class="px-6 py-3 text-sm text-gray-700">{{ $order->created_at->format('d M Y, H:i') }}</td>
              <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $order->order_number }}</td>
              <td class="px-6 py-3 text-sm font-semibold text-gray-900">{{ $order->total_formatted }}</td>
              <td class="px-6 py-3 text-xs font-bold">VIEW PROOF</td>
              <td class="px-6 py-3 flex items-center gap-2">
                <a href="{{ route('staff.payments.show',$order) }}" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">View</a>
                <form method="POST" action="{{ route('staff.payments.confirm',$order) }}">@csrf @method('PATCH')
                  <button class="text-xs px-3 py-1.5 bg-[#8cf58f] text-black rounded border border-black font-bold">Confirm</button>
                </form>
                <form method="POST" action="{{ route('staff.payments.reject',$order) }}">@csrf @method('PATCH')
                  <button class="text-xs px-3 py-1.5 bg-[#ef4444] text-white rounded border border-black font-bold">Reject</button>
                </form>
              </td>
            </tr>
            @empty<tr><td colspan="6" class="text-center py-12 text-gray-400">Tidak ada pembayaran menunggu konfirmasi.</td></tr>
            @endforelse
          </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $orders->links() }}</div>
      </div>
    </main>
  </div>
  </div>
</div>
@endsection
