
<?php $__env->startSection('title', isset($product) ? 'Edit Produk' : 'Tambah Produk'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.staff-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center gap-3">
      <a href="<?php echo e(route('staff.products.index')); ?>" class="text-gray-500 hover:text-gray-900"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
      <h2 class="text-lg font-semibold"><?php echo e(isset($product) ? 'Edit Produk' : 'Tambah Produk Baru'); ?></h2>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="max-w-2xl">
        <form method="POST" action="<?php echo e(isset($product) ? route('staff.products.update',$product) : route('staff.products.store')); ?>" enctype="multipart/form-data" class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
          <?php echo csrf_field(); ?> <?php if(isset($product)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
          <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Produk *</label><input type="text" name="name" value="<?php echo e(old('name', $product->name ?? '')); ?>" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600"></div>
          <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Harga (Rp) *</label><input type="number" name="price" value="<?php echo e(old('price', $product->price ?? '')); ?>" required min="0" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Stok *</label><input type="number" name="stock" value="<?php echo e(old('stock', $product->stock ?? '')); ?>" required min="0" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600"></div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori *</label><input type="text" name="category" value="<?php echo e(old('category', $product->category ?? '')); ?>" list="cats" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600"><datalist id="cats"><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c); ?>"><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></datalist></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">SKU *</label><input type="text" name="sku" value="<?php echo e(old('sku', $product->sku ?? '')); ?>" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600"></div>
          </div>
          <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label><textarea name="description" rows="3" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600"><?php echo e(old('description', $product->description ?? '')); ?></textarea></div>
          <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar</label><input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-600 file:text-white"><?php if(isset($product) && $product->image): ?><img src="<?php echo e(Storage::url($product->image)); ?>" class="mt-2 w-20 h-20 object-cover rounded-lg border"><?php endif; ?></div>
          <div class="flex gap-3">
            <button type="submit" class="bg-emerald-600 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-emerald-700">Simpan</button>
            <a href="<?php echo e(route('staff.products.index')); ?>" class="border border-gray-200 text-gray-700 px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-50">Batal</a>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\staff\products\edit.blade.php ENDPATH**/ ?>