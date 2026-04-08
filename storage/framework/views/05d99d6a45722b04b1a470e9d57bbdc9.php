
<?php $__env->startSection('title','Detail Pesanan - Staff'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.staff-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center gap-3">
      <a href="<?php echo e(route('staff.orders.index')); ?>" class="text-gray-500 hover:text-gray-900"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
      <h2 class="text-lg font-semibold"><?php echo e($order->order_number); ?></h2>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 bg-white rounded-xl border border-gray-200 p-6">
          <h3 class="font-semibold mb-4">Item Pesanan</h3>
          <table class="w-full text-sm">
            <thead><tr class="text-xs text-gray-500 uppercase border-b"><th class="text-left pb-2">Produk</th><th class="text-right pb-2">Harga</th><th class="text-right pb-2">Qty</th><th class="text-right pb-2">Subtotal</th></tr></thead>
            <tbody><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><tr class="border-b border-gray-50"><td class="py-2"><?php echo e($item->product_name); ?></td><td class="text-right"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($item->price)); ?></td><td class="text-right"><?php echo e($item->qty); ?></td><td class="text-right font-semibold"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($item->subtotal)); ?></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></tbody>
          </table>
          <div class="mt-4 text-sm space-y-1">
            <div class="flex justify-end gap-8"><span class="text-gray-500">Subtotal</span><span><?php echo e(\App\Helpers\CurrencyHelper::rupiah($order->subtotal)); ?></span></div>
            <div class="flex justify-end gap-8"><span class="text-gray-500">Ongkir</span><span><?php echo e(\App\Helpers\CurrencyHelper::rupiah($order->shipping_cost)); ?></span></div>
            <div class="flex justify-end gap-8 font-bold border-t pt-2"><span>Total</span><span><?php echo e($order->total_formatted); ?></span></div>
          </div>
        </div>
        <div class="space-y-4">
          <div class="bg-white rounded-xl border border-gray-200 p-6 text-sm space-y-3">
            <h3 class="font-semibold">Info Pengiriman</h3>
            <div><span class="text-gray-400">Penerima</span><p class="font-medium"><?php echo e($order->shipping_name); ?></p></div>
            <div><span class="text-gray-400">Telepon</span><p><?php echo e($order->shipping_phone); ?></p></div>
            <div><span class="text-gray-400">Alamat</span><p><?php echo e($order->shipping_address); ?>, <?php echo e($order->shipping_city); ?> <?php echo e($order->shipping_postal); ?></p></div>
            <div><span class="text-gray-400">Metode</span><p><?php echo e($order->shipping_method); ?></p></div>
            <div><span class="text-gray-400">Status</span><br><span class="text-xs px-2 py-1 rounded-full bg-amber-50 text-amber-700"><?php echo e($order->status_label); ?></span></div>
          </div>
          <?php if($order->status=='confirmed'): ?>
          <form method="POST" action="<?php echo e(route('staff.orders.ship',$order)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
            <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700">Tandai Sudah Dikirim</button>
          </form>
          <?php endif; ?>
        </div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\staff\orders\show.blade.php ENDPATH**/ ?>