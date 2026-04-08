@extends('layouts.app')
@section('title','Admin Dashboard')

@section('content')
<div class="app-viewport">
    <div class="app-canvas">
        @include('partials.admin-sidebar')

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-16 bg-[#fbfbfc] border-b border-[#dfe3e8] px-6 flex items-center justify-between">
                <div class="flex items-center gap-4 w-full max-w-[560px]">
                    <h1 class="text-[30px] font-extrabold tracking-tight text-[#121826]">Dashboard Overview</h1>
                    <div class="relative flex-1">
                        <svg class="w-4 h-4 text-[#98a1ae] absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" class="ui-input pl-9" placeholder="Search data...">
                    </div>
                </div>
                <div class="flex items-center gap-3 ml-6">
                    <button class="w-8 h-8 rounded-lg border border-[#d9dde3] bg-white text-[#667085] grid place-items-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.2-1.2A2 2 0 0118 14.4V11a6 6 0 10-12 0v3.4c0 .5-.2 1-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1"/></svg>
                    </button>
                    <button class="w-8 h-8 rounded-lg border border-[#d9dde3] bg-white text-[#667085] grid place-items-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.2 9a3.9 3.9 0 017.6 1.3c0 2.5-2.7 3.1-2.7 4.5m-.1 2.7h.01M22 12A10 10 0 112 12a10 10 0 0120 0z"/></svg>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto px-5 py-5 bg-[#f7f8fa]">
                @include('partials.alert')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                    <div class="ui-card p-5">
                        <p class="text-[13px] text-[#6b7280]">Total Users</p>
                        <p class="mt-2 text-5xl font-extrabold text-[#111827]">{{ number_format($stats['total_users']) }}</p>
                        <p class="mt-2 text-xs {{ $stats['user_growth'] >= 0 ? 'text-[#10b981]' : 'text-[#ef4444]' }} font-bold">{{ $stats['user_growth'] >= 0 ? '+' : '' }}{{ $stats['user_growth'] }}% vs last month</p>
                    </div>
                    <div class="ui-card p-5">
                        <p class="text-[13px] text-[#6b7280]">Total Staff</p>
                        <p class="mt-2 text-5xl font-extrabold text-[#111827]">{{ number_format($stats['total_staff']) }}</p>
                        <p class="mt-2 text-xs text-[#10b981] font-bold">+{{ number_format($stats['active_staff']) }} active now</p>
                    </div>
                    <div class="ui-card p-5">
                        <p class="text-[13px] text-[#6b7280]">Monthly Revenue</p>
                        <p class="mt-2 text-4xl font-extrabold text-[#111827]">{{ \App\Helpers\CurrencyHelper::rupiah($stats['revenue_month']) }}</p>
                        <p class="mt-2 text-xs {{ $stats['revenue_growth'] >= 0 ? 'text-[#10b981]' : 'text-[#ef4444]' }} font-bold">{{ $stats['revenue_growth'] >= 0 ? '+' : '' }}{{ $stats['revenue_growth'] }}% growth curve</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
                    <div class="xl:col-span-2 ui-card p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h2 class="text-[30px] font-extrabold tracking-tight text-[#111827]">Sales Trends</h2>
                                <p class="text-xs text-[#7b8190]">Revenue performance over the last 7 months</p>
                            </div>
                            <span class="px-3 py-1 rounded-md bg-black text-white text-xs font-bold">Month</span>
                        </div>
                        <div class="h-[280px]"><canvas id="salesChart"></canvas></div>
                    </div>

                    <div class="ui-card p-5">
                        <h2 class="text-[30px] font-extrabold tracking-tight text-[#111827] mb-1">Recent Activity</h2>
                        <p class="text-xs text-[#7b8190] mb-4">Live system access logs</p>
                        <div class="space-y-3">
                            @forelse($recentActivity as $activity)
                                <div class="flex gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#eef1f5] grid place-items-center text-[10px] font-bold text-[#1f2937]">{{ strtoupper(substr($activity['user']->name, 0, 2)) }}</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-2">
                                            <p class="text-sm font-semibold text-[#111827] truncate">{{ $activity['user']->name }}</p>
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded {{ $activity['type'] === 'admin' ? 'bg-black text-white' : ($activity['type'] === 'staff' ? 'bg-[#d1fae5] text-[#065f46]' : 'bg-[#eef2f7] text-[#475569]') }}">{{ strtoupper($activity['type']) }}</span>
                                        </div>
                                        <p class="text-xs text-[#6b7280]">{{ $activity['action'] }}</p>
                                        <p class="text-[11px] text-[#9aa1ad] mt-1">{{ $activity['time'] }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-[#9aa1ad]">No recent activity.</p>
                            @endforelse
                        </div>
                        <a href="{{ route('admin.reports') }}" class="mt-4 block w-full h-10 rounded-lg bg-[#eef1f5] text-[#111827] text-sm font-bold text-center leading-10">View All Activity</a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const chartEl = document.getElementById('salesChart');
    if (!chartEl) return;
    const ctx = chartEl.getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 280);
    gradient.addColorStop(0, 'rgba(44, 201, 122, 0.35)');
    gradient.addColorStop(1, 'rgba(44, 201, 122, 0.02)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                data: @json($chartData),
                borderColor: '#2cc97a',
                backgroundColor: gradient,
                borderWidth: 6,
                fill: true,
                pointRadius: 6,
                pointBackgroundColor: '#f7f8fa',
                pointBorderColor: '#2cc97a',
                pointBorderWidth: 3,
                tension: 0.45
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, border: { display: false }, ticks: { color: '#9ca3af', font: { size: 11, weight: '700' } } },
                y: { grid: { color: '#edf0f4' }, border: { display: false }, ticks: { color: '#b3b9c4', maxTicksLimit: 5, callback: v => 'Rp ' + (v / 1000000).toFixed(0) + ' jt' } }
            }
        }
    });
});
</script>
@endsection
