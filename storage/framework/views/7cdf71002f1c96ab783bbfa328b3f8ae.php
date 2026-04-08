
<?php $__env->startSection('title', isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50">
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center gap-3">
      <a href="<?php echo e(route('admin.users.index')); ?>" class="text-gray-500 hover:text-gray-900"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
      <h2 class="text-lg font-semibold"><?php echo e(isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna Baru'); ?></h2>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="max-w-lg">
        <form method="POST" action="<?php echo e(isset($user) ? route('admin.users.update',$user) : route('admin.users.store')); ?>" class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
          <?php echo csrf_field(); ?> <?php if(isset($user)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap *</label>
            <input type="text" name="name" value="<?php echo e(old('name', $user->name ?? '')); ?>" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Email *</label>
            <input type="email" name="email" value="<?php echo e(old('email', $user->email ?? '')); ?>" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Password <?php echo e(isset($user) ? '(kosongkan jika tidak diganti)' : '*'); ?></label>
            <input type="password" name="password" <?php echo e(isset($user)?'':'required'); ?> class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900" placeholder="Minimal 8 karakter">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Role *</label>
            <select name="role" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
              <option value="user" <?php echo e(old('role', $user->role ?? '')=='user'?'selected':''); ?>>User</option>
              <option value="staff" <?php echo e(old('role', $user->role ?? '')=='staff'?'selected':''); ?>>Staff</option>
              <option value="admin" <?php echo e(old('role', $user->role ?? '')=='admin'?'selected':''); ?>>Admin</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">No. Telepon</label>
            <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone ?? '')); ?>" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
          </div>
          <div class="flex gap-3">
            <button type="submit" class="bg-gray-900 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-800"><?php echo e(isset($user) ? 'Simpan' : 'Tambah'); ?></button>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="border border-gray-200 text-gray-700 px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-50">Batal</a>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\admin\users\create.blade.php ENDPATH**/ ?>