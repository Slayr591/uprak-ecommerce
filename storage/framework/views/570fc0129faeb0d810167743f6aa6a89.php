
<?php $__env->startSection('title','Produk - Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="app-viewport">
  <div class="app-canvas">
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden bg-[#f7f8fa]">
    <header class="h-16 bg-[#fbfbfc] border-b border-[#dfe3e8] px-8 py-4 flex items-center justify-between">
      <h2 class="text-[44px] font-extrabold tracking-tight text-gray-900">Manajemen Produk</h2>
      <a href="<?php echo e(route('admin.products.create')); ?>" class="btn-dark !h-10">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Produk
      </a>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="ui-card p-4 mb-4 flex gap-3">
        <form method="GET" class="flex-1 flex gap-3">
          <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama atau SKU..." class="ui-input flex-1">
          <select name="category" class="ui-input !w-[220px]">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($cat); ?>" <?php echo e(request('category')==$cat?'selected':''); ?>><?php echo e($cat); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <button type="submit" class="btn-dark !h-10">Cari</button>
        </form>
      </div>
      <div class="ui-card overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-[#f7f8fa] text-xs font-extrabold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Produk</th>
            <th class="text-left px-6 py-3">Kategori</th>
            <th class="text-left px-6 py-3">Harga</th>
            <th class="text-left px-6 py-3">Stok</th>
            <th class="text-left px-6 py-3">Status</th>
            <th class="text-left px-6 py-3">Aksi</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3"><p class="text-sm font-semibold text-gray-900"><?php echo e($p->name); ?></p><p class="text-xs text-gray-400"><?php echo e($p->sku); ?></p></td>
              <td class="px-6 py-3 text-sm text-gray-600"><?php echo e($p->category); ?></td>
              <td class="px-6 py-3 text-sm font-semibold text-gray-900"><?php echo e($p->price_formatted); ?></td>
              <td class="px-6 py-3">
                <?php if($p->isOutOfStock()): ?><span class="text-xs px-2 py-1 bg-red-50 text-red-700 rounded-full">Habis</span>
                <?php elseif($p->isLowStock()): ?><span class="text-xs px-2 py-1 bg-amber-50 text-amber-700 rounded-full"><?php echo e($p->stock); ?> (Rendah)</span>
                <?php else: ?><span class="text-sm text-gray-700"><?php echo e($p->stock); ?></span><?php endif; ?>
              </td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full <?php echo e($p->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-500'); ?>"><?php echo e($p->is_active ? 'Aktif' : 'Nonaktif'); ?></span></td>
              <td class="px-6 py-3 flex items-center gap-2">
                <a href="<?php echo e(route('admin.products.edit',$p)); ?>" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Edit</a>
                <form method="POST" action="<?php echo e(route('admin.products.destroy',$p)); ?>" onsubmit="return confirm('Hapus produk ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                  <button class="text-xs px-2 py-1 border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Hapus</button>
                </form>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6" class="text-center py-12 text-gray-400">Tidak ada produk.</td></tr>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\admin\products\index.blade.php ENDPATH**/ ?>