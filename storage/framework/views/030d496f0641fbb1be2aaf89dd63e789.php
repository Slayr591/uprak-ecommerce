<?php $__env->startSection('title','Produk - UKK E-Commerce'); ?>
<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-white">
<header class="border-b border-gray-100 sticky top-0 bg-white z-10">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center gap-4">
    <a href="<?php echo e(route('user.products')); ?>" class="flex items-center gap-2">
      <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg></div>
      <span class="text-xl font-bold text-gray-900">UKK Store</span>
    </a>
    <form method="GET" action="<?php echo e(route('user.products')); ?>" class="flex-1 max-w-md relative">
      <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
    </form>
    <div class="ml-auto flex items-center gap-4">
      <a href="<?php echo e(route('cart')); ?>" class="relative p-2 text-gray-600 hover:text-gray-900">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 7H4l1-7z"/></svg>
        <?php if(($cartCount ?? 0) > 0): ?><span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center"><?php echo e($cartCount); ?></span><?php endif; ?>
      </a>
      <a href="<?php echo e(route('user.history')); ?>" class="text-sm text-gray-600 hover:text-gray-900">Pesanan Saya</a>
      <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline"><?php echo csrf_field(); ?><button class="text-sm text-gray-500 hover:text-red-600">Keluar</button></form>
    </div>
  </div>
</header>
<main class="max-w-7xl mx-auto px-6 py-8">
  <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="mb-6"><h1 class="text-3xl font-bold text-gray-900">Produk Kami</h1></div>
  <div class="flex flex-wrap gap-2 mb-8">
    <a href="<?php echo e(route('user.products')); ?>" class="px-4 py-1.5 rounded-full text-sm font-medium <?php echo e(!request('category') ? 'bg-gray-900 text-white' : 'border border-gray-200 text-gray-600 hover:border-gray-900'); ?>">Semua</a>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('user.products',['category'=>$cat])); ?>" class="px-4 py-1.5 rounded-full text-sm font-medium <?php echo e(request('category')==$cat ? 'bg-gray-900 text-white' : 'border border-gray-200 text-gray-600 hover:border-gray-900'); ?>"><?php echo e($cat); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg transition-all">
      <div class="relative bg-gray-50 aspect-square">
        <?php if($product->image): ?>
          <img src="<?php echo e(Storage::url($product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover">
        <?php else: ?>
          <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          </div>
        <?php endif; ?>
        <?php if($product->isOutOfStock()): ?>
          <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center"><span class="bg-white text-gray-800 text-xs font-bold px-3 py-1 rounded-full">Habis</span></div>
        <?php elseif($product->isLowStock()): ?>
          <span class="absolute top-2 left-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full">Stok Terbatas</span>
        <?php endif; ?>
        <?php if(!$product->isOutOfStock()): ?>
        <form method="POST" action="<?php echo e(route('cart.add')); ?>" class="absolute bottom-2 left-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
          <?php echo csrf_field(); ?><input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
          <button class="w-full bg-gray-900 text-white text-xs font-semibold py-2 rounded-xl shadow">+ Keranjang</button>
        </form>
        <?php endif; ?>
      </div>
      <div class="p-4">
        <h3 class="font-semibold text-gray-900 text-sm mb-0.5"><a href="<?php echo e(route('user.products.show',$product)); ?>" class="hover:underline"><?php echo e($product->name); ?></a></h3>
        <p class="text-xs text-gray-400 mb-2"><?php echo e($product->category); ?></p>
        <p class="font-bold text-gray-900"><?php echo e($product->price_formatted); ?></p>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-span-4 text-center py-16 text-gray-400">Produk tidak ditemukan.</div>
    <?php endif; ?>
  </div>
  <div class="mt-6"><?php echo e($products->withQueryString()->links()); ?></div>
</main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/user/product-list.blade.php ENDPATH**/ ?>