
<?php $__env->startSection('title','Pesanan - Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4"><h2 class="text-lg font-semibold">Manajemen Pesanan</h2></header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
        <form method="GET" class="flex gap-3">
          <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nomor pesanan..." class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
          <select name="status" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
            <option value="">Semua Status</option>
            <?php $__currentLoopData = ['pending'=>'Menunggu','paid'=>'Dibayar','confirmed'=>'Dikonfirmasi','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Dibatalkan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($v); ?>" <?php echo e(request('status')==$v?'selected':''); ?>><?php echo e($l); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-sm font-medium text-gray-900"><?php echo e($order->order_number); ?></td>
              <td class="px-6 py-3 text-sm text-gray-600"><?php echo e($order->user->name); ?></td>
              <td class="px-6 py-3 text-sm font-semibold"><?php echo e($order->total_formatted); ?></td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full bg-amber-50 text-amber-700"><?php echo e($order->status_label); ?></span></td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full <?php echo e($order->payment_status=='paid'?'bg-emerald-50 text-emerald-700':'bg-gray-100 text-gray-600'); ?>"><?php echo e($order->payment_status_label); ?></span></td>
              <td class="px-6 py-3 text-xs text-gray-400"><?php echo e($order->created_at->format('d M Y')); ?></td>
              <td class="px-6 py-3"><a href="<?php echo e(route('admin.orders.show',$order)); ?>" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Detail</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="7" class="text-center py-12 text-gray-400">Tidak ada pesanan.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="px-6 py-4 border-t"><?php echo e($orders->withQueryString()->links()); ?></div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\admin\orders\index.blade.php ENDPATH**/ ?>