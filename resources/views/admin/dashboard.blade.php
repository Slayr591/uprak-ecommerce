@extends('layouts.app')
@section('title','Dashboard - Admin')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.admin-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-6">
        <h2 class="text-lg font-semibold text-gray-900">Dashboard Overview</h2>
        <div class="relative">
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <input type="text" placeholder="Search data..." class="pl-10 pr-4 py-2 bg-gray-100 rounded-lg text-sm w-64 focus:outline-none">
        </div>
      </div>
      <div class="flex items-center gap-4">
        <button class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center relative">
          <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.31 2.31 0 0118 14.235V11a6 6 0 10-12 0v3.235c0 .628-.134 1.219-.401 1.76L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
          <span class="absolute -top-1 -right-1 w-2 h-2 bg-green-400 rounded-full"></span>
        </button>
        <button class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center">
          <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </button>
      </div>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-gray-500">Total Users</p>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          </div>
          <p class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($stats['total_users']) }}</p>
          <p class="text-xs text-green-500">+5.2% vs last month</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-gray-500">Total Staff</p>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
          </div>
          <p class="text-3xl font-bold text-gray-900 mb-1">{{ $stats['total_staff'] ?? 128 }}</p>
          <p class="text-xs text-green-500">+2.0% active now</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-gray-500">Monthly Revenue</p>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <p class="text-3xl font-bold text-gray-900 mb-1">{{ \App\Helpers\CurrencyHelper::rupiah($stats['revenue_month']) }}</p>
          <p class="text-xs text-green-500">+12.4% growth curve</p>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="col-span-2 bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h3 class="font-semibold text-gray-900">Sales Trends</h3>
              <p class="text-xs text-gray-500">Revenue performance over the last 7 months</p>
            </div>
            <div class="flex bg-gray-100 rounded-md p-1">
              <button class="px-3 py-1 text-xs font-medium bg-black text-white rounded">Month</button>
              <button class="px-3 py-1 text-xs font-medium text-gray-500 hover:text-gray-900">Week</button>
            </div>
          </div>
          <canvas id="salesChart" height="220"></canvas>
        </div>
        
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <h3 class="font-semibold text-gray-900 mb-4">Recent Activity</h3>
          <p class="text-xs text-gray-500 mb-4">Live system access logs</p>
          
          <div class="space-y-4">
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between">
                  <p class="text-sm font-medium">John Doe</p>
                  <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full">STAFF</span>
                </div>
                <p class="text-xs text-gray-500">Logged in from San Francisco</p>
                <p class="text-xs text-gray-400 mt-1">2 mins ago</p>
              </div>
            </div>
            
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between">
                  <p class="text-sm font-medium">Sarah Connor</p>
                  <span class="px-2 py-0.5 bg-gray-100 text-gray-700 text-xs rounded-full">USER</span>
                </div>
                <p class="text-xs text-gray-500">Updated profile settings</p>
                <p class="text-xs text-gray-400 mt-1">14 mins ago</p>
              </div>
            </div>
            
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between">
                  <p class="text-sm font-medium">Mike Ross</p>
                  <span class="px-2 py-0.5 bg-black text-white text-xs rounded-full">ADMIN</span>
                </div>
                <p class="text-xs text-gray-500">Generated monthly report</p>
                <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
              </div>
            </div>
          </div>
          
          <button class="w-full mt-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-700">View All Activity</button>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const ctx = document.getElementById('salesChart').getContext('2d');
  
  const gradient = ctx.createLinearGradient(0, 0, 0, 220);
  gradient.addColorStop(0, 'rgba(34, 197, 94, 0.2)');
  gradient.addColorStop(1, 'rgba(34, 197, 94, 0)');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL'],
      datasets: [{
        label: 'Revenue',
        data: [12, 15, 14, 38, 32, 18, 45],
        borderColor: '#22c55e',
        backgroundColor: gradient,
        borderWidth: 3,
        tension: 0.4,
        fill: true,
        pointBackgroundColor: '#ffffff',
        pointBorderColor: '#22c55e',
        pointBorderWidth: 2,
        pointRadius: 6,
        pointHoverRadius: 8
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: { enabled: false }
      },
      scales: {
        y: { display: false },
        x: {
          grid: { display: false },
          ticks: { font: { size: 10 }, color: '#9ca3af' }
        }
      },
      elements: { line: { capBezierPoints: true } }
    }
  });
});
</script>
@endsection
