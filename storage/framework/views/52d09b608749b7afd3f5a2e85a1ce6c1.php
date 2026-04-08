
<?php $__env->startSection('title','Pesanan - Staff'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.staff-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
      <h2 class="text-lg font-semibold">Daftar Pesanan</h2>
      <form method="GET"><select name="status" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
        <option value="">Semua Status</option>
        <?php $__currentLoopData = ['pending'=>'Menunggu','paid'=>'Dibayar','confirmed'=>'Dikonfirmasi','shipped'=>'Dikirim','completed'=>'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($v); ?>" <?php echo e(request('status')==$v?'selected':''); ?>><?php echo e($l); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select></form>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Order</th><th class="text-left px-6 py-3">Pelanggan</th>
            <th class="text-left px-6 py-3">Total</th><th class="text-left px-6 py-3">Status</th>
            <th class="text-left px-6 py-3">Tanggal</th><th class="text-left px-6 py-3">Aksi</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3 text-sm font-medium text-gray-900"><?php echo e($order->order_number); ?></td>
              <td class="px-6 py-3 text-sm text-gray-600"><?php echo e($order->user->name); ?></td>
              <td class="px-6 py-3 text-sm font-semibold"><?php echo e($order->total_formatted); ?></td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full <?php echo e($order->status=='confirmed'?'bg-blue-50 text-blue-700':'bg-amber-50 text-amber-700'); ?>"><?php echo e($order->status_label); ?></span></td>
              <td class="px-6 py-3 text-xs text-gray-400"><?php echo e($order->created_at->format('d M Y')); ?></td>
              <td class="px-6 py-3 flex items-center gap-2">
                <a href="<?php echo e(route('staff.orders.show',$order)); ?>" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Detail</a>
                <?php if($order->status=='confirmed'): ?>
                <form method="POST" action="<?php echo e(route('staff.orders.ship',$order)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                  <button class="text-xs px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kirim</button>
                </form>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6" class="text-center py-12 text-gray-400">Tidak ada pesanan.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="px-6 py-4 border-t"><?php echo e($orders->withQueryString()->links()); ?></div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/staff/orders/index.blade.php ENDPATH**/ ?>