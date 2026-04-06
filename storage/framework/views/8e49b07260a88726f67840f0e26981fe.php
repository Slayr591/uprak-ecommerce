<?php $__env->startSection('title','Staff - Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
      <h2 class="text-lg font-semibold">Manajemen Staff</h2>
      <a href="<?php echo e(route('admin.staff.create')); ?>" class="flex items-center gap-2 bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-800">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Staff
      </a>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Staff</th><th class="text-left px-6 py-3">No. Telepon</th>
            <th class="text-left px-6 py-3">Bergabung</th><th class="text-left px-6 py-3">Aksi</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3"><div class="flex items-center gap-3"><div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-700 text-xs font-bold"><?php echo e(substr($s->name,0,1)); ?></div><div><p class="text-sm font-semibold"><?php echo e($s->name); ?></p><p class="text-xs text-gray-400"><?php echo e($s->email); ?></p></div></div></td>
              <td class="px-6 py-3 text-sm text-gray-600"><?php echo e($s->phone ?? '-'); ?></td>
              <td class="px-6 py-3 text-xs text-gray-400"><?php echo e($s->created_at->format('d M Y')); ?></td>
              <td class="px-6 py-3 flex items-center gap-2">
                <a href="<?php echo e(route('admin.staff.edit',$s)); ?>" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Edit</a>
                <form method="POST" action="<?php echo e(route('admin.staff.destroy',$s)); ?>" onsubmit="return confirm('Hapus staff ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                  <button class="text-xs px-2 py-1 border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Hapus</button>
                </form>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="4" class="text-center py-12 text-gray-400">Belum ada staff.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="px-6 py-4 border-t"><?php echo e($staff->links()); ?></div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/admin/staff/index.blade.php ENDPATH**/ ?>