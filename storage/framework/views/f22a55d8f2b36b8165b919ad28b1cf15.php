<?php $__env->startSection('title','Laporan - Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4"><h2 class="text-lg font-semibold">Laporan Penjualan</h2></header>
    <main class="flex-1 overflow-y-auto p-8">
      <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Total Pendapatan</p><p class="text-2xl font-bold text-gray-900"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($stats['revenue_total'])); ?></p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Pendapatan Bulan Ini</p><p class="text-2xl font-bold text-emerald-600"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($stats['revenue_month'])); ?></p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Total Pesanan</p><p class="text-2xl font-bold text-gray-900"><?php echo e(number_format($stats['orders_total'])); ?></p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Pesanan Bulan Ini</p><p class="text-2xl font-bold text-gray-900"><?php echo e($stats['orders_month']); ?></p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Stok Rendah</p><p class="text-2xl font-bold text-amber-600"><?php echo e($stats['low_stock']); ?></p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">User Baru Bulan Ini</p><p class="text-2xl font-bold text-gray-900"><?php echo e($stats['new_users_month']); ?></p></div>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b flex items-center justify-between">
          <h3 class="font-semibold">Daftar Transaksi</h3>
          <form method="GET"><select name="status" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm focus:outline-none">
            <option value="">Semua Status</option>
            <?php $__currentLoopData = ['pending'=>'Menunggu','paid'=>'Dibayar','confirmed'=>'Dikonfirmasi','shipped'=>'Dikirim','completed'=>'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($v); ?>" <?php echo e(request('status')==$v?'selected':''); ?>><?php echo e($l); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select></form>
        </div>
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Order ID</th><th class="text-left px-6 py-3">Pelanggan</th>
            <th class="text-left px-6 py-3">Total</th><th class="text-left px-6 py-3">Metode Bayar</th>
            <th class="text-left px-6 py-3">Status</th><th class="text-left px-6 py-3">Tanggal</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-sm font-medium text-gray-900"><?php echo e($order->order_number); ?></td>
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