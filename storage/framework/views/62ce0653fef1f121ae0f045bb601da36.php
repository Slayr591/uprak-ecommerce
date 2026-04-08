
<?php $__env->startSection('title','Pengguna - Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
      <input type="text" placeholder="Search users..." class="px-4 py-2 bg-gray-100 rounded-lg text-sm w-64 focus:outline-none">
      <nav class="flex items-center gap-6 text-sm">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-500 hover:text-gray-900">Dashboard</a>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="text-gray-500 hover:text-gray-900">Products</a>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-gray-500 hover:text-gray-900">Orders</a>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="text-black font-medium border-b-2 border-black pb-1">Users</a>
      </nav>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="px-8 pt-8">
        <div class="flex items-center justify-between mb-6">
          <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">User Management</h1>
            <p class="text-gray-500">Review and manage platform access permissions and account statuses.</p>
          </div>
          <a href="<?php echo e(route('admin.users.create')); ?>" class="flex items-center gap-2 bg-black text-white px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-900">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Create New User
          </a>
        </div>
        
        <div class="flex border-b border-gray-200 mb-6">
          <button class="px-4 py-2 text-sm font-medium text-black border-b-2 border-black">All Accounts</button>
          <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-900">Administrators</button>
          <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-900">Staff Only</button>
          <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-900">Standard Users</button>
        </div>
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">USER PROFILE</th>
            <th class="text-left px-6 py-3">ROLE</th>
            <th class="text-left px-6 py-3">ACCOUNT STATUS</th>
            <th class="text-left px-6 py-3">JOIN DATE</th>
            <th class="text-left px-6 py-3">ACTIONS</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center text-white text-sm font-bold"><?php echo e(substr($user->name,0,2)); ?></div>
                  <div>
                    <p class="text-sm font-semibold text-gray-900"><?php echo e($user->name); ?></p>
                    <p class="text-xs text-gray-400"><?php echo e($user->email); ?></p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4">
                <span class="text-xs px-2.5 py-1 rounded-full bg-gray-100 text-gray-700"><?php echo e(ucfirst($user->role)); ?></span>
              </td>
              <td class="px-6 py-4">
                <?php if($user->is_active): ?>
                  <span class="inline-flex items-center gap-1.5">
                    <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                    <span class="text-xs text-gray-600">Active</span>
                  </span>
                <?php else: ?>
                  <span class="inline-flex items-center gap-1.5">
                    <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                    <span class="text-xs text-gray-600">Inactive</span>
                  </span>
                <?php endif; ?>
              </td>
              <td class="px-6 py-4 text-sm text-gray-500"><?php echo e($user->created_at->format('M d, Y')); ?></td>
              <td class="px-6 py-4 flex items-center gap-2">
                <a href="<?php echo e(route('admin.users.edit',$user)); ?>" class="w-7 h-7 rounded border border-gray-200 flex items-center justify-center hover:bg-gray-50">
                  <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </a>
                <form method="POST" action="<?php echo e(route('admin.users.toggle',$user)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                  <button type="submit" class="w-7 h-7 rounded border border-amber-200 flex items-center justify-center hover:bg-amber-50">
                    <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                  </button>
                </form>
                <?php if($user->id !== auth()->id()): ?>
                <form method="POST" action="<?php echo e(route('admin.users.destroy',$user)); ?>" onsubmit="return confirm('Hapus pengguna?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                  <button type="submit" class="w-7 h-7 rounded border border-red-200 flex items-center justify-center hover:bg-red-50">
                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </form>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="5" class="text-center py-12 text-gray-400">Tidak ada pengguna.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="px-6 py-4 border-t"><?php echo e($users->withQueryString()->links()); ?></div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/admin/users/index.blade.php ENDPATH**/ ?>