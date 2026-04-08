
<?php $__env->startSection('title','Produk - Staff'); ?>
<?php $__env->startSection('content'); ?>
<div class="app-viewport">
  <div class="app-canvas">
  <?php echo $__env->make('partials.staff-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden bg-[#f7f8fa]">
    <header class="h-16 bg-[#fbfbfc] border-b border-[#dfe3e8] px-8 py-4 flex items-center justify-between">
      <h2 class="text-[52px] font-extrabold tracking-tight">Staff Product Management</h2>
      <a href="<?php echo e(route('staff.products.create')); ?>" class="btn-dark !h-11">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add New Product
      </a>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="ui-card p-4 mb-4">
        <form method="GET" class="flex gap-3">
          <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search products by name, SKU, or tag..." class="ui-input flex-1">
          <select name="category" class="ui-input !w-[180px]">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($cat); ?>" <?php echo e(request('category')==$cat?'selected':''); ?>><?php echo e($cat); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <button type="submit" class="btn-dark !h-10">Cari</button>
        </form>
      </div>
      <div class="ui-card overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-[#f7f8fa] text-xs font-extrabold text-[#6b7280] uppercase">
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
                  <button class="text-xs px-2 py-1 border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Delete</button>
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
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\staff\products\index.blade.php ENDPATH**/ ?>