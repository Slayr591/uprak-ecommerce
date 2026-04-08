
<?php $__env->startSection('title','Daftar - UKK E-Commerce'); ?>
<?php $__env->startSection('content'); ?>
<?php ($redirectTarget = old('redirect', request('redirect', $backUrl ?? route('user.products')))); ?>
<div class="min-h-screen bg-gray-50">
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg>
                <span class="font-bold">Store</span>
            </div>
            <nav class="flex items-center gap-6 text-sm">
                <a href="<?php echo e(route('user.products')); ?>" class="text-gray-600 hover:text-gray-900">Katalog</a>
                <a href="<?php echo e(route('user.products')); ?>" class="text-gray-600 hover:text-gray-900">Support</a>
            </nav>
        </div>
    </header>

    <main class="min-h-[calc(100vh-73px)] flex items-center justify-center p-4 py-10">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-900 rounded-xl mb-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Buat Akun</h1>
                <p class="text-gray-500 text-sm mt-1">Daftar untuk mulai berbelanja</p>
            </div>

            <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="redirect" value="<?php echo e($redirectTarget); ?>">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                        placeholder="Budi Santoso">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                        placeholder="nama@email.com">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">No. Telepon (opsional)</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                        placeholder="+62 812 3456 7890">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                        placeholder="Minimal 8 karakter">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                        placeholder="Ulangi password">
                </div>
                <button type="submit" class="w-full bg-gray-900 text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-800 transition-colors">
                    Buat Akun
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Sudah punya akun? <a href="<?php echo e(route('login', ['redirect' => $redirectTarget])); ?>" class="text-gray-900 font-semibold hover:underline">Masuk</a>
            </p>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/auth/register.blade.php ENDPATH**/ ?>