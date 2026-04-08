
<?php $__env->startSection('title','Detail Pembayaran - Staff'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.staff-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center gap-3">
      <a href="<?php echo e(route('staff.payments.index')); ?>" class="text-gray-500 hover:text-gray-900"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
      <h2 class="text-lg font-semibold">Detail Pembayaran <?php echo e($order->order_number); ?></h2>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="grid grid-cols-2 gap-6">
        <div class="space-y-6">
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-4">Info Pelanggan</h3>
            <div class="space-y-2 text-sm">
              <div class="flex gap-4"><span class="text-gray-400 w-28">Nama</span><span class="font-medium"><?php echo e($order->user->name); ?></span></div>
              <div class="flex gap-4"><span class="text-gray-400 w-28">Email</span><span><?php echo e($order->user->email); ?></span></div>
              <div class="flex gap-4"><span class="text-gray-400 w-28">No. Order</span><span class="font-medium"><?php echo e($order->order_number); ?></span></div>
              <div class="flex gap-4"><span class="text-gray-400 w-28">Total</span><span class="font-bold text-lg"><?php echo e($order->total_formatted); ?></span></div>
              <div class="flex gap-4"><span class="text-gray-400 w-28">Metode Bayar</span><span><?php echo e($order->payment_method); ?></span></div>
              <div class="flex gap-4"><span class="text-gray-400 w-28">Tanggal</span><span><?php echo e($order->created_at->format('d M Y, H:i')); ?></span></div>
            </div>
          </div>
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-3">Item Pesanan</h3>
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex justify-between text-sm py-2 border-b border-gray-50 last:border-0">
              <span><?php echo e($item->product_name); ?> x<?php echo e($item->qty); ?></span>
              <span class="font-semibold"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($item->subtotal)); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
        <div class="space-y-6">
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-4">Bukti Pembayaran</h3>
            <?php if($order->payment_proof): ?>
              <img src="<?php echo e(Storage::url($order->payment_proof)); ?>" class="w-full rounded-xl border object-contain max-h-96">
            <?php else: ?>
              <div class="border-2 border-dashed border-gray-200 rounded-xl p-10 text-center text-gray-400">Belum ada bukti pembayaran</div>
            <?php endif; ?>
          </div>
          <div class="bg-white rounded-xl border border-gray-200 p-6 flex gap-3">
            <form method="POST" action="<?php echo e(route('staff.payments.confirm',$order)); ?>" class="flex-1"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
              <button class="w-full bg-emerald-600 text-white py-3 rounded-xl font-semibold hover:bg-emerald-700">✓ Konfirmasi Pembayaran</button>
            </form>
            <form method="POST" action="<?php echo e(route('staff.payments.reject',$order)); ?>" class="flex-1"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
              <button class="w-full bg-red-500 text-white py-3 rounded-xl font-semibold hover:bg-red-600">✕ Tolak</button>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/staff/payments/show.blade.php ENDPATH**/ ?>