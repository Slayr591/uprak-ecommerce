
<?php $__env->startSection('title','Dashboard - Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-gray-500">Total Users</p>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          </div>
          <p class="text-3xl font-bold text-gray-900 mb-1"><?php echo e(number_format($stats['total_users'])); ?></p>
          <p class="text-xs <?php echo e($stats['user_growth'] >= 0 ? 'text-green-500' : 'text-red-500'); ?>"><?php echo e($stats['user_growth'] >= 0 ? '+' : ''); ?><?php echo e($stats['user_growth']); ?>% vs last month</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-gray-500">Total Staff</p>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
          </div>
          <p class="text-3xl font-bold text-gray-900 mb-1"><?php echo e($stats['total_staff']); ?></p>
          <p class="text-xs <?php echo e($stats['staff_growth'] >= 0 ? 'text-green-500' : 'text-red-500'); ?>"><?php echo e($stats['active_staff']); ?> active · <?php echo e($stats['staff_growth'] >= 0 ? '+' : ''); ?><?php echo e($stats['staff_growth']); ?>% vs last month</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-gray-500">Monthly Revenue</p>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <p class="text-3xl font-bold text-gray-900 mb-1"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($stats['revenue_month'])); ?></p>
          <p class="text-xs <?php echo e($stats['revenue_growth'] >= 0 ? 'text-green-500' : 'text-red-500'); ?>"><?php echo e($stats['revenue_growth'] >= 0 ? '+' : ''); ?><?php echo e($stats['revenue_growth']); ?>% growth vs last month</p>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="col-span-2 bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h3 class="font-semibold text-gray-900">Sales Trends</h3>
              <p class="text-xs text-gray-500">Monthly revenue performance over the last 7 months</p>
            </div>
            <span class="px-3 py-1 text-xs font-medium bg-black text-white rounded-md">Monthly</span>
          </div>
          <div class="h-56">
            <canvas id="salesChart"></canvas>
          </div>
          <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3 mt-5">
            <?php $__currentLoopData = $chartLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="rounded-lg border border-gray-200 bg-gray-50 px-3 py-2">
              <p class="text-[11px] font-semibold text-gray-500 uppercase"><?php echo e($label); ?></p>
              <p class="mt-1 text-xs font-bold text-gray-900"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($chartData[$index] ?? 0)); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
        
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <h3 class="font-semibold text-gray-900 mb-4">Recent Activity</h3>
          <p class="text-xs text-gray-500 mb-4">Live system access logs</p>
          
          <div class="space-y-4">
            <?php $__currentLoopData = $recentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                <span class="text-xs font-bold"><?php echo e(substr($activity['user']->name,0,2)); ?></span>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between">
                  <p class="text-sm font-medium"><?php echo e($activity['user']->name); ?></p>
                  <span class="px-2 py-0.5 <?php echo e($activity['type'] == 'admin' ? 'bg-black text-white' : ($activity['type'] == 'staff' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700')); ?> text-xs rounded-full"><?php echo e(strtoupper($activity['type'])); ?></span>
                </div>
                <p class="text-xs text-gray-500"><?php echo e($activity['action']); ?></p>
                <p class="text-xs text-gray-400 mt-1"><?php echo e($activity['time']); ?></p>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          
          <a href="<?php echo e(route('admin.reports')); ?>" class="block w-full mt-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-700 text-center hover:bg-gray-200 transition-colors">View All Activity</a>
        </div>
      </div>
      
      <div class="bg-white rounded-xl border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
          <h3 class="font-semibold text-gray-900">Pesanan Terbaru</h3>
          <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-sm text-gray-500 hover:text-gray-900">Lihat semua</a>
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
            <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-sm font-medium text-gray-900"><?php echo e($order->order_number); ?></td>
              <td class="px-6 py-3 text-sm text-gray-600"><?php echo e($order->user->name); ?></td>
              <td class="px-6 py-3 text-sm font-semibold"><?php echo e($order->total_formatted); ?></td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full bg-amber-50 text-amber-700"><?php echo e($order->status_label); ?></span></td>
              <td class="px-6 py-3 text-sm text-gray-400"><?php echo e($order->created_at->format('d M Y')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
  const currencyFormatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0
  });
  
  const gradient = ctx.createLinearGradient(0, 0, 0, 200);
  gradient.addColorStop(0, 'rgba(34, 197, 94, 0.2)');
  gradient.addColorStop(1, 'rgba(34, 197, 94, 0)');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($chartLabels, 15, 512) ?>,
        datasets: [{
        label: 'Revenue',
        data: <?php echo json_encode($chartData, 15, 512) ?>,
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
      interaction: {
        mode: 'index',
        intersect: false
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          enabled: true,
          backgroundColor: '#111827',
          titleColor: '#ffffff',
          bodyColor: '#ffffff',
          displayColors: false,
          callbacks: {
            label: function(context) {
              return 'Pendapatan: ' + currencyFormatter.format(context.parsed.y || 0);
            }
          }
        }
      },
      scales: {
        y: {
          display: true,
          border: { display: false },
          grid: { color: '#f3f4f6' },
          ticks: {
            color: '#9ca3af',
            maxTicksLimit: 5,
            callback: function(value) {
              if (value >= 1000000) {
                return 'Rp ' + (value / 1000000).toFixed(value % 1000000 === 0 ? 0 : 1) + ' Jt';
              }
              if (value >= 1000) {
                return 'Rp ' + (value / 1000).toFixed(0) + ' Rb';
              }
              return 'Rp ' + value;
            }
          }
        },
        x: {
          border: { display: false },
          grid: { display: false },
          ticks: { font: { size: 10 }, color: '#9ca3af' }
        }
      },
      elements: { line: { capBezierPoints: true } }
    }
  });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>