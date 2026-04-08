
<?php $__env->startSection('title','Riwayat Pesanan - UKK'); ?>
<?php $__env->startSection('content'); ?>
<div class="app-viewport">
  <div class="app-canvas !block">
  <header class="h-16 bg-[#fcfcfd] border-b border-[#e3e6eb] px-6 py-4 flex items-center justify-between">
    <a href="<?php echo e(route('user.products')); ?>" class="flex items-center gap-2">
      <div class="w-7 h-7 bg-gray-900 rounded-lg flex items-center justify-center"><svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg></div>
      <span class="font-bold text-gray-900">UKK Store</span>
    </a>
    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline"><?php echo csrf_field(); ?><button class="text-sm text-gray-500 hover:text-red-600">Keluar</button></form>
  </header>
  <main class="max-w-5xl mx-auto px-6 py-8">
    <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <h1 class="text-[48px] font-extrabold tracking-tight text-[#111827] mb-6">Transaction History</h1>
    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
      $trackingText = match($order->status) {
        'pending' => 'Menunggu pembayaran dari Anda.',
        'paid' => 'Pembayaran diterima, menunggu verifikasi.',
        'confirmed' => 'Pesanan sedang disiapkan oleh tim kami.',
        'shipped' => 'Paket sedang dalam perjalanan ke alamat Anda.',
        'completed' => 'Paket sudah diterima. Pesanan selesai.',
        'cancelled' => 'Pesanan dibatalkan.',
        default => 'Status pesanan sedang diperbarui.',
      };
    ?>
    <div class="ui-card p-5 mb-4">
      <div class="flex items-center justify-between mb-3">
        <div>
          <p class="font-semibold text-gray-900"><?php echo e($order->order_number); ?></p>
          <p class="text-xs text-gray-400"><?php echo e($order->created_at->format('d M Y, H:i')); ?></p>
        </div>
        <div class="text-right">
          <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
            <?php if($order->status=='completed'): ?> bg-emerald-50 text-emerald-700
            <?php elseif($order->status=='shipped'): ?> bg-blue-50 text-blue-700
            <?php elseif($order->status=='cancelled'): ?> bg-red-50 text-red-700
            <?php else: ?> bg-amber-50 text-amber-700 <?php endif; ?>">
            <?php echo e($order->status_label); ?>

          </span>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500"><?php echo e($order->items->count()); ?> item &bull; <?php echo e($order->payment_status_label); ?></p>
        <p class="font-bold text-gray-900"><?php echo e($order->total_formatted); ?></p>
      </div>

      <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between gap-3">
        <p class="text-xs text-gray-500">Tracking: <?php echo e($trackingText); ?></p>
        <div class="flex items-center gap-2">
          <a href="<?php echo e(route('user.history.show', $order)); ?>" class="text-xs px-3 py-1.5 border border-gray-200 rounded-lg hover:bg-gray-50">Lihat Detail</a>

          <?php if($order->status === 'shipped'): ?>
          <form method="POST" action="<?php echo e(route('user.history.complete', $order)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <button type="submit" class="text-xs px-3 py-1.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
              Paket Sudah Sampai
            </button>
          </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="text-center py-16 bg-white rounded-2xl border border-gray-200">
      <p class="text-gray-400">Belum ada pesanan.</p>
      <a href="<?php echo e(route('user.products')); ?>" class="mt-4 inline-block bg-gray-900 text-white px-6 py-2.5 rounded-lg text-sm font-semibold">Mulai Belanja</a>
    </div>
    <?php endif; ?>
    <div class="mt-4"><?php echo e($orders->links()); ?></div>
  </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/user/history.blade.php ENDPATH**/ ?>