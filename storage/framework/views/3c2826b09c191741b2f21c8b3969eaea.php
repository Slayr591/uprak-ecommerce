
<?php $__env->startSection('title','Detail Pesanan - UKK'); ?>
<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50">
  <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center gap-3">
    <a href="<?php echo e(route('user.history')); ?>" class="text-gray-500 hover:text-gray-900 flex items-center gap-2 text-sm">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Kembali
    </a>
    <span class="font-semibold text-gray-900"><?php echo e($order->order_number); ?></span>
  </header>
  <main class="max-w-3xl mx-auto px-6 py-8">
    <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php
      $trackingSteps = [
        'pending' => 1,
        'paid' => 2,
        'confirmed' => 3,
        'shipped' => 4,
        'completed' => 5,
      ];

      $currentStep = $trackingSteps[$order->status] ?? 0;

      $trackingMessage = match($order->status) {
        'pending' => 'Menunggu pembayaran Anda.',
        'paid' => 'Pembayaran diterima dan sedang diverifikasi.',
        'confirmed' => 'Pesanan sudah dikonfirmasi dan sedang diproses.',
        'shipped' => 'Paket sedang dikirim ke alamat tujuan.',
        'completed' => 'Paket sudah diterima. Pesanan selesai.',
        'cancelled' => 'Pesanan dibatalkan.',
        default => 'Status pesanan sedang diperbarui.',
      };
    ?>

    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-4">
      <h3 class="font-semibold mb-3">Tracking Paket</h3>
      <p class="text-sm text-gray-600 mb-4"><?php echo e($trackingMessage); ?></p>

      <?php if($order->status !== 'cancelled'): ?>
      <div class="grid grid-cols-1 md:grid-cols-5 gap-3 text-xs">
        <?php $__currentLoopData = [
          1 => 'Pesanan Dibuat',
          2 => 'Pembayaran Masuk',
          3 => 'Diproses',
          4 => 'Dikirim',
          5 => 'Selesai',
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="rounded-lg border px-3 py-2 <?php echo e($currentStep >= $step ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-gray-200 bg-gray-50 text-gray-400'); ?>">
            <?php echo e($label); ?>

          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>

      <?php if($order->status === 'shipped'): ?>
      <form method="POST" action="<?php echo e(route('user.history.complete', $order)); ?>" class="mt-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>
        <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-700">
          Konfirmasi Paket Sudah Sampai
        </button>
      </form>
      <?php endif; ?>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-4">
      <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-gray-900">Detail Pesanan</h2>
        <span class="text-xs px-2.5 py-1.5 rounded-full font-medium
          <?php if($order->status=='completed'): ?> bg-emerald-50 text-emerald-700
          <?php elseif($order->status=='shipped'): ?> bg-blue-50 text-blue-700
          <?php elseif($order->status=='cancelled'): ?> bg-red-50 text-red-700
          <?php else: ?> bg-amber-50 text-amber-700 <?php endif; ?>"><?php echo e($order->status_label); ?></span>
      </div>
      <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="flex items-center gap-4 py-3 border-b border-gray-100 last:border-0">
        <div class="w-12 h-12 bg-gray-100 rounded-lg flex-shrink-0"></div>
        <div class="flex-1"><p class="text-sm font-medium text-gray-900"><?php echo e($item->product_name); ?></p><p class="text-xs text-gray-400">x<?php echo e($item->qty); ?></p></div>
        <p class="text-sm font-semibold"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($item->subtotal)); ?></p>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <div class="mt-4 space-y-1 text-sm">
        <div class="flex justify-between text-gray-500"><span>Subtotal</span><span><?php echo e(\App\Helpers\CurrencyHelper::rupiah($order->subtotal)); ?></span></div>
        <div class="flex justify-between text-gray-500"><span>Ongkir</span><span><?php echo e(\App\Helpers\CurrencyHelper::rupiah($order->shipping_cost)); ?></span></div>
        <div class="flex justify-between text-gray-500"><span>Pajak</span><span><?php echo e(\App\Helpers\CurrencyHelper::rupiah($order->tax)); ?></span></div>
        <div class="flex justify-between font-bold text-base border-t pt-2"><span>Total</span><span><?php echo e($order->total_formatted); ?></span></div>
      </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-6 text-sm">
      <h3 class="font-semibold mb-3">Info Pengiriman</h3>
      <div class="grid grid-cols-2 gap-3 text-sm">
        <div><p class="text-gray-400 text-xs">Penerima</p><p class="font-medium"><?php echo e($order->shipping_name); ?></p></div>
        <div><p class="text-gray-400 text-xs">Telepon</p><p><?php echo e($order->shipping_phone); ?></p></div>
        <div class="col-span-2"><p class="text-gray-400 text-xs">Alamat</p><p><?php echo e($order->shipping_address); ?>, <?php echo e($order->shipping_city); ?> <?php echo e($order->shipping_postal); ?></p></div>
        <div><p class="text-gray-400 text-xs">Metode Kirim</p><p><?php echo e($order->shipping_method); ?></p></div>
        <div><p class="text-gray-400 text-xs">Metode Bayar</p><p><?php echo e($order->payment_method); ?></p></div>
      </div>
    </div>
  </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\user\history-detail.blade.php ENDPATH**/ ?>