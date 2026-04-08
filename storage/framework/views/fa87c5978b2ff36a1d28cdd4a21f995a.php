
<?php $__env->startSection('title', 'Detail Pesanan - Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center gap-3">
      <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-gray-500 hover:text-gray-900"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
      <h2 class="text-lg font-semibold">Detail Pesanan <?php echo e($order->order_number); ?></h2>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 space-y-6">
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-4">Item Pesanan</h3>
            <table class="w-full text-sm">
              <thead><tr class="text-xs text-gray-500 uppercase border-b"><th class="text-left pb-2">Produk</th><th class="text-right pb-2">Harga</th><th class="text-right pb-2">Qty</th><th class="text-right pb-2">Subtotal</th></tr></thead>
              <tbody>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b border-gray-50 py-2">
                  <td class="py-2"><?php echo e($item->product_name); ?></td>
                  <td class="text-right py-2"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($item->price)); ?></td>
                  <td class="text-right py-2"><?php echo e($item->qty); ?></td>
                  <td class="text-right py-2 font-semibold"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($item->subtotal)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <div class="mt-4 space-y-1 text-sm text-right">
              <div class="flex justify-end gap-8"><span class="text-gray-500">Subtotal</span><span><?php echo e(\App\Helpers\CurrencyHelper::rupiah($order->subtotal)); ?></span></div>
              <div class="flex justify-end gap-8"><span class="text-gray-500">Ongkir</span><span><?php echo e(\App\Helpers\CurrencyHelper::rupiah($order->shipping_cost)); ?></span></div>
              <div class="flex justify-end gap-8"><span class="text-gray-500">Pajak</span><span><?php echo e(\App\Helpers\CurrencyHelper::rupiah($order->tax)); ?></span></div>
              <div class="flex justify-end gap-8 font-bold text-base border-t pt-2"><span>Total</span><span><?php echo e($order->total_formatted); ?></span></div>
            </div>
          </div>
          <?php if($order->payment_proof): ?>
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-4">Bukti Pembayaran</h3>
            <img src="<?php echo e(Storage::url($order->payment_proof)); ?>" class="max-w-sm rounded-lg border">
          </div>
          <?php endif; ?>
        </div>
        <div class="space-y-6">
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-4">Update Status</h3>
            <form method="POST" action="<?php echo e(route('admin.orders.status',$order)); ?>">
              <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
              <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm mb-3 focus:outline-none focus:ring-2 focus:ring-gray-900">
                <?php $__currentLoopData = ['pending'=>'Menunggu','paid'=>'Dibayar','confirmed'=>'Dikonfirmasi','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Dibatalkan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($v); ?>" <?php echo e($order->status==$v?'selected':''); ?>><?php echo e($l); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg text-sm font-semibold">Update Status</button>
            </form>
          </div>
          <div class="bg-white rounded-xl border border-gray-200 p-6 text-sm space-y-3">
            <h3 class="font-semibold">Info Pelanggan</h3>
            <div><p class="text-gray-400 text-xs">Nama</p><p class="font-medium"><?php echo e($order->user->name); ?></p></div>
            <div><p class="text-gray-400 text-xs">Email</p><p><?php echo e($order->user->email); ?></p></div>
            <div><p class="text-gray-400 text-xs">Alamat Pengiriman</p><p><?php echo e($order->shipping_name); ?>, <?php echo e($order->shipping_address); ?>, <?php echo e($order->shipping_city); ?> <?php echo e($order->shipping_postal); ?></p></div>
            <div><p class="text-gray-400 text-xs">Metode Bayar</p><p><?php echo e($order->payment_method); ?></p></div>
            <div><p class="text-gray-400 text-xs">Status Bayar</p><span class="text-xs px-2 py-1 rounded-full <?php echo e($order->payment_status=='paid'?'bg-emerald-50 text-emerald-700':'bg-amber-50 text-amber-700'); ?>"><?php echo e($order->payment_status_label); ?></span></div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\admin\orders\show.blade.php ENDPATH**/ ?>