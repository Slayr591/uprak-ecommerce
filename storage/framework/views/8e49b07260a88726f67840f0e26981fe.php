<?php $__env->startSection('title','Staff - Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <h2 class="text-lg font-semibold">Staff Management</h2>
        <div class="relative">
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <input type="text" placeholder="Search staff members..." class="pl-10 pr-4 py-2 bg-gray-100 rounded-lg text-sm w-72 focus:outline-none">
        </div>
      </div>
      <div class="flex items-center gap-4">
        <a href="<?php echo e(route('admin.staff.create')); ?>" class="flex items-center gap-2 bg-black text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-900">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Add New Staff
        </a>
        <button class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center">
          <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.31 2.31 0 0118 14.235V11a6 6 0 10-12 0v3.235c0 .628-.134 1.219-.401 1.76L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        </button>
        <button class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center">
          <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </button>
        <div class="w-8 h-8 rounded-full bg-amber-200"></div>
      </div>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      
      <div class="grid grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-gray-500">Total Staff</p>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
          </div>
          <p class="text-2xl font-bold text-gray-900 mb-1"><?php echo e($staff->total() ?? 42); ?></p>
          <p class="text-xs text-green-500">+2% from last month</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-gray-500">Active Now</p>
            <span class="w-3 h-3 bg-green-400 rounded-full"></span>
          </div>
          <p class="text-2xl font-bold text-gray-900 mb-1">18</p>
          <p class="text-xs text-gray-400">Internal team currently logged in</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
          <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-gray-500">Pending Invites</p>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
          <p class="text-2xl font-bold text-gray-900 mb-1">5</p>
          <p class="text-xs text-green-500">+1 invited today</p>
        </div>
      </div>
      
      <div class="mb-4">
        <span class="text-xs font-semibold text-gray-500 uppercase">FILTER BY:</span>
        <div class="flex gap-2 mt-2">
          <button class="px-3 py-1.5 bg-black text-white text-xs rounded-full font-medium">All Roles</button>
          <button class="px-3 py-1.5 bg-white border border-gray-200 text-xs rounded-full font-medium">Super Admin</button>
          <button class="px-3 py-1.5 bg-white border border-gray-200 text-xs rounded-full font-medium">Support</button>
          <button class="px-3 py-1.5 bg-white border border-gray-200 text-xs rounded-full font-medium">Warehouse</button>
        </div>
      </div>
      
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">MEMBER</th>
            <th class="text-left px-6 py-3">EMAIL</th>
            <th class="text-left px-6 py-3">ROLE</th>
            <th class="text-left px-6 py-3">STATUS</th>
            <th class="text-left px-6 py-3">ACTIONS</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 text-xs font-bold"><?php echo e(substr($s->name,0,1)); ?></div>
                  <div>
                    <p class="text-sm font-semibold"><?php echo e($s->name); ?></p>
                    <p class="text-xs text-gray-400">Joined <?php echo e($s->created_at->format('M Y')); ?></p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 text-sm text-gray-500"><?php echo e($s->email); ?></td>
              <td class="px-6 py-4">
                <span class="text-xs px-2.5 py-1 rounded-full bg-gray-900 text-white font-medium"><?php echo e($s->role ?? 'Super Admin'); ?></span>
              </td>
              <td class="px-6 py-4">
                <span class="inline-flex items-center gap-1.5">
                  <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                  <span class="text-xs text-gray-600">Active</span>
                </span>
              </td>
              <td class="px-6 py-4 flex items-center gap-2">
                <a href="<?php echo e(route('admin.staff.edit',$s)); ?>" class="w-7 h-7 rounded border border-gray-200 flex items-center justify-center hover:bg-gray-50">
                  <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </a>
                <form method="POST" action="<?php echo e(route('admin.staff.destroy',$s)); ?>" onsubmit="return confirm('Hapus staff ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                  <button class="w-7 h-7 rounded border border-gray-200 flex items-center justify-center hover:bg-red-50 hover:border-red-200">
                    <svg class="w-3.5 h-3.5 text-gray-500 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
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