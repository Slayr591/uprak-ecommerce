
<?php $__env->startSection('title','Keranjang - UKK E-Commerce'); ?>
<?php $__env->startSection('content'); ?>
<div class="app-viewport">
  <div class="app-canvas !block">
  <header class="h-16 bg-[#fcfcfd] border-b border-[#e3e6eb] px-7 flex items-center justify-between">
    <a href="<?php echo e(route('user.products')); ?>" class="flex items-center gap-3">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M7 4v3m10-3v3M5 7l1 13h12l1-13"/></svg>
      <span class="text-[30px] font-extrabold tracking-tight">MODERN SHOP</span>
    </a>
    <div class="flex items-center gap-8 text-sm font-semibold">
      <a href="<?php echo e(route('user.products')); ?>">New Arrivals</a>
      <a href="<?php echo e(route('user.products')); ?>">Collections</a>
      <a href="<?php echo e(route('user.products')); ?>">Support</a>
    </div>
  </header>
  <main class="max-w-6xl mx-auto px-8 py-7">
    <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <h1 class="text-[48px] font-extrabold tracking-tight text-[#111827] mb-5">YOUR BAG (<?php echo e($cartItems->count()); ?>)</h1>
    <?php if($cartItems->isEmpty()): ?>
      <div class="text-center py-20 bg-white rounded-2xl border border-gray-200">
        <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 7H4l1-7z"/></svg>
        <p class="text-gray-500 mb-4">Keranjang Anda masih kosong</p>
        <a href="<?php echo e(route('user.products')); ?>" class="bg-gray-900 text-white px-6 py-2.5 rounded-lg text-sm font-semibold">Mulai Belanja</a>
      </div>
    <?php else: ?>
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-6 items-start">
      <div class="flex-1 space-y-4">
        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="ui-card p-4 flex items-start gap-4">
          <div class="w-20 h-20 bg-gray-100 rounded-lg flex-shrink-0">
            <?php if($item->product->image): ?><img src="<?php echo e(Storage::url($item->product->image)); ?>" class="w-full h-full object-cover rounded-lg"><?php endif; ?>
          </div>
          <div class="flex-1">
            <h3 class="font-semibold text-gray-900"><?php echo e($item->product->name); ?></h3>
            <p class="text-sm text-gray-500"><?php echo e($item->product->category); ?></p>
            <p class="font-bold text-gray-900 mt-1"><?php echo e($item->product->price_formatted); ?></p>
          </div>
          <div class="flex items-center gap-2">
            <form method="POST" action="<?php echo e(route('cart.update',$item)); ?>" class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
              <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
              <button type="button" onclick="this.closest('form').qty.value=Math.max(1,parseInt(this.closest('form').qty.value)-1);this.closest('form').submit()" class="px-3 py-2 text-gray-500 hover:bg-gray-50">-</button>
              <input type="number" name="qty" value="<?php echo e($item->qty); ?>" min="1" class="w-12 text-center text-sm border-0 focus:outline-none py-2">
              <button type="button" onclick="this.closest('form').qty.value=parseInt(this.closest('form').qty.value)+1;this.closest('form').submit()" class="px-3 py-2 text-gray-500 hover:bg-gray-50">+</button>
            </form>
            <form method="POST" action="<?php echo e(route('cart.destroy',$item)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
              <button class="p-2 text-gray-400 hover:text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
            </form>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="flex justify-end">
          <form method="POST" action="<?php echo e(route('cart.clear')); ?>"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
            <button class="text-sm text-red-500 hover:text-red-700">Hapus Semua</button>
          </form>
        </div>
      </div>
      <div class="w-full">
        <div class="ui-card p-6">
          <h2 class="text-[33px] font-extrabold tracking-tight text-[#111827] mb-4">ORDER SUMMARY</h2>
          <div class="space-y-3 text-sm mb-4">
            <div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span class="font-medium"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($subtotal)); ?></span></div>
            <div class="flex justify-between"><span class="text-gray-500">Pengiriman</span><span class="text-emerald-600 font-medium"><?php echo e($shipping > 0 ? \App\Helpers\CurrencyHelper::rupiah($shipping) : 'Gratis'); ?></span></div>
            <div class="flex justify-between"><span class="text-gray-500">Pajak (11%)</span><span class="font-medium"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($tax)); ?></span></div>
            <div class="border-t pt-3 flex justify-between"><span class="font-bold text-gray-900">Total</span><span class="font-bold text-lg text-gray-900"><?php echo e(\App\Helpers\CurrencyHelper::rupiah($total)); ?></span></div>
          </div>
          <a href="<?php echo e(route('checkout')); ?>" class="block w-full h-12 rounded-xl bg-black text-white text-center leading-[48px] font-bold">PROCEED TO CHECKOUT</a>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </main>
  <footer class="h-14 border-t border-[#e3e6eb] text-xs text-[#9aa1ad] flex items-center justify-center">© 2024 MODERN E-COMMERCE PLATFORM. ALL RIGHTS RESERVED.</footer>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\user\cart.blade.php ENDPATH**/ ?>