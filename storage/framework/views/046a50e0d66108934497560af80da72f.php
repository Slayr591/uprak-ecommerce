
<?php $__env->startSection('title','Login - UKK E-Commerce'); ?>
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
        <div class="w-full max-w-md bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-10 h-10 bg-black rounded-lg mb-4">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg>
                </div>
                <h1 class="text-xl font-bold text-gray-900">Welcome Back</h1>
                <p class="text-gray-500 text-sm mt-1">Masuk ke akun Anda untuk melanjutkan belanja</p>
            </div>

            <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="redirect" value="<?php echo e($redirectTarget); ?>">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                        placeholder="nama@email.com">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                        placeholder="••••••••">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="rounded">
                    <label for="remember" class="text-sm text-gray-600">Ingat saya</label>
                </div>
                <button type="submit" class="w-full bg-black text-white py-3 rounded-lg text-sm font-semibold hover:bg-gray-900 transition-colors">
                    Login
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Belum punya akun? <a href="<?php echo e(route('register', ['redirect' => $redirectTarget])); ?>" class="text-black font-semibold hover:underline">Daftar</a>
            </p>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\auth\login.blade.php ENDPATH**/ ?>