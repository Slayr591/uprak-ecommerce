@extends('layouts.app')
@section('title','Dashboard - Staff')
@section('content')
<div class="app-viewport">
  <div class="app-canvas">
  @include('partials.staff-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden bg-[#f7f8fa]">
    <header class="h-16 bg-[#fbfbfc] border-b border-[#dfe3e8] px-8 py-3 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <p class="text-sm text-[#7c8492]">Staff</p>
        <span class="text-[#d1d5db]">/</span>
        <h2 class="text-lg font-extrabold text-[#111827]">Dashboard Overview</h2>
      </div>
      <a href="{{ route('staff.products.create') }}" class="btn-dark !h-10">+ NEW PRODUCT</a>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <h1 class="text-[52px] font-extrabold tracking-tight text-[#111827] leading-none mb-2">DASHBOARD OVERVIEW</h1>
      <p class="text-[#697180] mb-6">Real-time performance metrics and system activity.</p>

      <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="ui-card p-5"><p class="text-xs text-[#6b7280] uppercase font-bold">Total Products</p><p class="text-5xl font-extrabold text-[#111827] mt-2">{{ $stats['total_products'] }}</p></div>
        <div class="ui-card p-5"><p class="text-xs text-[#6b7280] uppercase font-bold">Today's Orders</p><p class="text-5xl font-extrabold text-[#111827] mt-2">{{ $stats['pending_payments'] }}</p></div>
        <div class="ui-card p-5"><p class="text-xs text-[#6b7280] uppercase font-bold">Pending Payments</p><p class="text-5xl font-extrabold text-[#111827] mt-2">{{ $stats['pending_payments'] }}</p></div>
        <div class="rounded-xl bg-[#191c21] p-5"><p class="text-xs text-[#9ca3af] uppercase font-bold">Total Revenue</p><p class="text-4xl font-extrabold text-white mt-2">{{ \App\Helpers\CurrencyHelper::rupiah($stats['processed_today']) }}</p></div>
      </div>

      <div class="ui-card overflow-hidden">
        <div class="px-6 py-4 border-b flex items-center justify-between">
          <h3 class="text-[30px] font-extrabold tracking-tight text-[#111827]">RECENT ACTIVITY</h3>
          <a href="{{ route('staff.payments.index') }}" class="text-xs font-bold text-[#7eeac2]">VIEW ALL LOGS</a>
        </div>
        <table class="w-full">
          <thead><tr class="bg-[#f7f8fa] text-xs font-bold text-[#6b7280] uppercase">
            <th class="text-left px-6 py-3">ID</th><th class="text-left px-6 py-3">TIMESTAMP</th>
            <th class="text-left px-6 py-3">ACTION</th><th class="text-left px-6 py-3">STAFF MEMBER</th><th class="text-left px-6 py-3">STATUS</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            @forelse($recentOrders as $order)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-sm font-semibold">{{ $order->order_number }}</td>
              <td class="px-6 py-3 text-sm text-gray-600">{{ $order->created_at->format('d M, h:i A') }}</td>
              <td class="px-6 py-3 text-sm font-semibold text-[#111827]">Payment Verification</td>
              <td class="px-6 py-3 text-sm text-gray-600">{{ auth()->user()->name }}</td>
              <td class="px-6 py-3"><span class="status-pill bg-[#d1fae5] text-[#047857]">Completed</span></td>
            </tr>
            @empty<tr><td colspan="5" class="text-center py-8 text-gray-400">Tidak ada aktivitas.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>
  </div>
  </div>
</div>
@endsection
