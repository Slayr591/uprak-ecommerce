
<?php $__env->startSection('title','Konfirmasi Pembayaran - Staff'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.staff-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4"><h2 class="text-lg font-semibold">Konfirmasi Pembayaran</h2></header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Pelanggan</th><th class="text-left px-6 py-3">Order</th>
            <th class="text-left px-6 py-3">Total</th><th class="text-left px-6 py-3">Tanggal</th><th class="text-left px-6 py-3">Aksi</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3"><p class="text-sm font-semibold"><?php echo e($order->user->name); ?></p><p class="text-xs text-gray-400"><?php echo e($order->user->email); ?></p></td>
              <td class="px-6 py-3 text-sm font-medium text-gray-900"><?php echo e($order->order_number); ?></td>
              <td class="px-6 py-3 text-sm font-semibold text-gray-900"><?php echo e($order->total_formatted); ?></td>
              <td class="px-6 py-3 text-xs text-gray-400"><?php echo e($order->created_at->format('d M Y, H:i')); ?></td>
              <td class="px-6 py-3 flex items-center gap-2">
                <a href="<?php echo e(route('staff.payments.show',$order)); ?>" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Lihat Bukti</a>
                <form method="POST" action="<?php echo e(route('staff.payments.confirm',$order)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                  <button class="text-xs px-2 py-1 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Konfirmasi</button>
                </form>
                <form method="POST" action="<?php echo e(route('staff.payments.reject',$order)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                  <button class="text-xs px-2 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">Tolak</button>
                </form>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="5" class="text-center py-12 text-gray-400">Tidak ada pembayaran menunggu konfirmasi.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="px-6 py-4 border-t"><?php echo e($orders->links()); ?></div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\staff\payments\index.blade.php ENDPATH**/ ?>