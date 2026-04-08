
<?php $__env->startSection('title','Dashboard - Staff'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.staff-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4"><h2 class="text-lg font-semibold">Dashboard Staff</h2></header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Menunggu Konfirmasi</p><p class="text-3xl font-bold text-amber-600"><?php echo e($stats['pending_payments']); ?></p><a href="<?php echo e(route('staff.payments.index')); ?>" class="text-xs text-gray-400 hover:underline">Lihat semua</a></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Diproses Hari Ini</p><p class="text-2xl font-bold text-gray-900"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($stats['processed_today'])); ?></p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Total Produk</p><p class="text-3xl font-bold text-gray-900"><?php echo e($stats['total_products']); ?></p></div>
        <div class="bg-white rounded-xl border border-gray-200 p-6"><p class="text-sm text-gray-500 mb-1">Stok Rendah</p><p class="text-3xl font-bold text-amber-600"><?php echo e($stats['low_stock']); ?></p></div>
      </div>
      <div class="bg-white rounded-xl border border-gray-200">
        <div class="px-6 py-4 border-b flex items-center justify-between">
          <h3 class="font-semibold">Pembayaran Menunggu Konfirmasi</h3>
          <a href="<?php echo e(route('staff.payments.index')); ?>" class="text-sm text-gray-500 hover:underline">Lihat semua</a>
        </div>
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Order</th><th class="text-left px-6 py-3">Pelanggan</th>
            <th class="text-left px-6 py-3">Total</th><th class="text-left px-6 py-3">Aksi</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-sm font-medium"><?php echo e($order->order_number); ?></td>
              <td class="px-6 py-3 text-sm text-gray-600"><?php echo e($order->user->name); ?></td>
              <td class="px-6 py-3 text-sm font-semibold"><?php echo e($order->total_formatted); ?></td>
              <td class="px-6 py-3"><a href="<?php echo e(route('staff.payments.show',$order)); ?>" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Proses</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="4" class="text-center py-8 text-gray-400">Tidak ada pembayaran menunggu.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\staff\dashboard.blade.php ENDPATH**/ ?>