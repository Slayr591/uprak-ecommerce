
<?php $__env->startSection('title','Profil Saya - UKK E-Commerce'); ?>
<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50">
  <header class="bg-white border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
      <a href="<?php echo e(route('user.products')); ?>" class="flex items-center gap-2">
        <div class="w-8 h-8 bg-black rounded-lg flex items-center justify-center">
          <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg>
        </div>
        <span class="text-xl font-bold text-gray-900">NEXUS</span>
      </a>
      <nav class="flex items-center gap-6 text-sm">
        <a href="<?php echo e(route('user.products')); ?>" class="text-gray-600 hover:text-gray-900">Home</a>
        <a href="<?php echo e(route('user.history')); ?>" class="text-gray-600 hover:text-gray-900">History</a>
        <a href="<?php echo e(route('user.profile')); ?>" class="text-black font-medium border-b-2 border-black pb-1">Account</a>
      </nav>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-6 py-8">
    <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="grid lg:grid-cols-3 gap-6">
      <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <div class="flex flex-col items-center text-center">
          <?php if($user->profile_photo_url): ?>
            <img src="<?php echo e($user->profile_photo_url); ?>" alt="<?php echo e($user->name); ?>" class="w-24 h-24 rounded-full object-cover border border-gray-200 shadow-sm">
          <?php else: ?>
            <div class="w-24 h-24 rounded-full bg-black text-white flex items-center justify-center text-3xl font-bold shadow-sm">
              <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

            </div>
          <?php endif; ?>
          <h1 class="mt-4 text-xl font-bold text-gray-900"><?php echo e($user->name); ?></h1>
          <p class="text-sm text-gray-500"><?php echo e($user->email); ?></p>
          <div class="mt-4 w-full space-y-3 text-left text-sm">
            <div class="rounded-xl bg-gray-50 border border-gray-200 px-4 py-3">
              <p class="text-xs text-gray-400">Telepon</p>
              <p class="font-medium text-gray-900"><?php echo e($user->phone ?: 'Belum diisi'); ?></p>
            </div>
            <div class="rounded-xl bg-gray-50 border border-gray-200 px-4 py-3">
              <p class="text-xs text-gray-400">Alamat</p>
              <p class="font-medium text-gray-900"><?php echo e($user->address ?: 'Belum diisi'); ?></p>
            </div>
          </div>
        </div>
      </div>

      <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
          <h2 class="text-lg font-bold text-gray-900 mb-4">Informasi Profil</h2>
          <form method="POST" action="<?php echo e(route('user.profile.update')); ?>" enctype="multipart/form-data" class="space-y-5">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-black">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-black">
              </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Telepon</label>
                <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-black">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto Profil</label>
                <input type="file" name="profile_photo" accept="image/*" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-black">
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
              <textarea name="address" rows="4" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-black"><?php echo e(old('address', $user->address)); ?></textarea>
            </div>
            <button type="submit" class="bg-black text-white px-5 py-3 rounded-xl text-sm font-semibold hover:bg-gray-900 transition-colors">Simpan Perubahan Profil</button>
          </form>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 p-6">
          <h2 class="text-lg font-bold text-gray-900 mb-4">Ubah Password</h2>
          <form method="POST" action="<?php echo e(route('user.profile.password')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Saat Ini</label>
              <input type="password" name="current_password" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-black">
            </div>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                <input type="password" name="password" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-black">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-black">
              </div>
            </div>
            <button type="submit" class="bg-black text-white px-5 py-3 rounded-xl text-sm font-semibold hover:bg-gray-900 transition-colors">Ubah Password</button>
          </form>
        </div>
      </div>
    </div>
  </main>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/user/profile.blade.php ENDPATH**/ ?>