<?php $__env->startSection('title','Produk - Staff'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.staff-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
      <h2 class="text-lg font-semibold">Manajemen Produk</h2>
      <a href="<?php echo e(route('staff.products.create')); ?>" class="flex items-center gap-2 bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-emerald-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Produk
      </a>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
        <form method="GET" class="flex gap-3">
          <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama atau SKU..." class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600">
          <select name="category" class="border border-gray-200 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($cat); ?>" <?php echo e(request('category')==$cat?'selected':''); ?>><?php echo e($cat); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium">Cari</button>
        </form>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Produk</th><th class="text-left px-6 py-3">Kategori</th>
            <th class="text-left px-6 py-3">Harga</th><th class="text-left px-6 py-3">Stok</th><th class="text-left px-6 py-3">Aksi</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="<?php echo e($p->isOutOfStock()?'bg-red-50':($p->isLowStock()?'bg-amber-50':'hover:bg-gray-50')); ?>">
              <td class="px-6 py-3"><p class="text-sm font-semibold text-gray-900"><?php echo e($p->name); ?></p><p class="text-xs text-gray-400"><?php echo e($p->sku); ?></p></td>
              <td class="px-6 py-3 text-sm text-gray-600"><?php echo e($p->category); ?></td>
              <td class="px-6 py-3 text-sm font-semibold"><?php echo e($p->price_formatted); ?></td>
              <td class="px-6 py-3">
                <?php if($p->isOutOfStock()): ?><span class="text-xs px-2 py-1 bg-red-100 text-red-700 rounded-full">Habis</span>
                <?php elseif($p->isLowStock()): ?><span class="text-xs px-2 py-1 bg-amber-100 text-amber-700 rounded-full"><?php echo e($p->stock); ?> ⚠️</span>
                <?php else: ?><span class="text-sm text-gray-700"><?php echo e($p->stock); ?></span><?php endif; ?>
              </td>
              <td class="px-6 py-3 flex items-center gap-2">
                <a href="<?php echo e(route('staff.products.edit',$p)); ?>" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Edit</a>
                <form method="POST" action="<?php echo e(route('staff.products.destroy',$p)); ?>" onsubmit="return confirm('Hapus produk?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                  <button class="text-xs px-2 py-1 border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Hapus</button>
                </form>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="5" class="text-center py-12 text-gray-400">Tidak ada produk.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="px-6 py-4 border-t"><?php echo e($products->withQueryString()->links()); ?></div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/staff/products/index.blade.php ENDPATH**/ ?>