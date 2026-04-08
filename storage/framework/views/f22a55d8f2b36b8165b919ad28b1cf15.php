<?php $__env->startSection('title','Laporan - Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
      <nav class="flex items-center gap-6 text-sm">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-500 hover:text-gray-900">Dashboard</a>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-gray-500 hover:text-gray-900">Orders</a>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="text-gray-500 hover:text-gray-900">Products</a>
        <a href="<?php echo e(route('admin.reports')); ?>" class="text-black font-medium border-b-2 border-black pb-1">Reports</a>
      </nav>
      <div class="flex items-center gap-4">
        <form method="GET" class="relative">
          <?php if(request('status')): ?>
          <input type="hidden" name="status" value="<?php echo e(request('status')); ?>">
          <?php endif; ?>
          <?php if(isset($selectedMonth)): ?>
          <input type="hidden" name="month" value="<?php echo e($selectedMonth->format('Y-m')); ?>">
          <?php endif; ?>
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <input type="text" name="search" value="<?php echo e($search ?? request('search')); ?>" placeholder="Cari produk, pelanggan, pembayaran..." class="pl-10 pr-4 py-2 bg-gray-100 rounded-lg text-sm w-64 focus:outline-none">
        </form>
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
          <form method="GET" class="flex items-center gap-3">
            <?php if(request('status')): ?>
            <input type="hidden" name="status" value="<?php echo e(request('status')); ?>">
            <?php endif; ?>
            <label class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-lg text-sm font-medium">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              <span><?php echo e($dateRangeLabel); ?></span>
              <input type="month" name="month" value="<?php echo e($selectedMonth->format('Y-m')); ?>" onchange="this.form.submit()" class="bg-transparent text-sm focus:outline-none">
            </label>
          </form>
        </div>
      </div>
      
      <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <p class="text-xs font-medium text-gray-500 uppercase mb-1">Total Revenue</p>
          <p class="text-2xl font-bold text-gray-900 mb-1"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($stats['revenue_month'])); ?></p>
          <p class="text-xs text-green-500 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            <?php echo e($stats['revenue_growth'] >= 0 ? '+' : ''); ?><?php echo e($stats['revenue_growth']); ?>% vs last month
          </p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <p class="text-xs font-medium text-gray-500 uppercase mb-1">Low Stock Items</p>
          <p class="text-2xl font-bold text-gray-900 mb-1"><?php echo e($stats['low_stock']); ?></p>
          <p class="text-xs text-red-500 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <?php echo e($stats['low_stock'] > 0 ? $stats['low_stock'] . ' produk perlu restock' : 'Stok aman'); ?>

          </p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <p class="text-xs font-medium text-gray-500 uppercase mb-1">New Customers</p>
          <p class="text-2xl font-bold text-gray-900 mb-1"><?php echo e($stats['new_users_month']); ?></p>
          <p class="text-xs text-green-500 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            <?php echo e($stats['new_users_growth'] >= 0 ? '+' : ''); ?><?php echo e($stats['new_users_growth']); ?>% vs last month
          </p>
        </div>
        <div class="bg-green-100 rounded-xl border border-green-200 p-6">
          <p class="text-xs font-medium text-green-700 uppercase mb-1">Current Conversion</p>
          <p class="text-2xl font-bold text-gray-900 mb-1"><?php echo e(number_format($stats['conversion_rate'], 2)); ?>%</p>
          <p class="text-xs text-green-600 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <?php echo e($stats['paid_orders_month']); ?> paid of <?php echo e($stats['orders_month']); ?> orders
          </p>
        </div>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b flex items-center justify-between">
          <h3 class="font-semibold">Daftar Transaksi</h3>
          <form method="GET" class="flex items-center gap-2">
            <?php if(isset($selectedMonth)): ?>
            <input type="hidden" name="month" value="<?php echo e($selectedMonth->format('Y-m')); ?>">
            <?php endif; ?>
            <?php if(!empty($search)): ?>
            <input type="hidden" name="search" value="<?php echo e($search); ?>">
            <?php endif; ?>
            <select name="status" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm focus:outline-none">
            <option value="">Semua Status</option>
            <?php $__currentLoopData = ['pending'=>'Menunggu','paid'=>'Dibayar','confirmed'=>'Dikonfirmasi','shipped'=>'Dikirim','completed'=>'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($v); ?>" <?php echo e(request('status')==$v?'selected':''); ?>><?php echo e($l); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </form>
        </div>
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Produk</th><th class="text-left px-6 py-3">Pelanggan</th>
            <th class="text-left px-6 py-3">Total</th><th class="text-left px-6 py-3">Metode Bayar</th>
            <th class="text-left px-6 py-3">Status</th><th class="text-left px-6 py-3">Tanggal</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3">
                <div class="text-sm font-medium text-gray-900">
                  <?php $__currentLoopData = $order->items->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <p><?php echo e($item->product->name ?? $item->product_name); ?></p>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php if($order->items->count() > 2): ?>
                  <p class="text-xs text-gray-400">+ <?php echo e($order->items->count() - 2); ?> item lainnya</p>
                  <?php endif; ?>
                </div>
              </td>
              <td class="px-6 py-3 text-sm text-gray-600"><?php echo e($order->user->name); ?></td>
              <td class="px-6 py-3 text-sm font-semibold"><?php echo e($order->total_formatted); ?></td>
              <td class="px-6 py-3 text-sm text-gray-600"><?php echo e($order->payment_method); ?></td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full <?php echo e($order->payment_status=='paid'?'bg-emerald-50 text-emerald-700':'bg-amber-50 text-amber-700'); ?>"><?php echo e($order->payment_status_label); ?></span></td>
              <td class="px-6 py-3 text-xs text-gray-400"><?php echo e($order->created_at->format('d M Y')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6" class="text-center py-10 text-gray-400">Tidak ada data.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="px-6 py-4 border-t"><?php echo e($orders->withQueryString()->links()); ?></div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/admin/reports.blade.php ENDPATH**/ ?>