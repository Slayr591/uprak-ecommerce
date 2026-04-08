
<?php $__env->startSection('title','Login - UKK E-Commerce'); ?>
<?php $__env->startSection('content'); ?>
<?php ($redirectTarget = old('redirect', request('redirect', $backUrl ?? route('user.products')))); ?>
<div class="app-viewport">
    <div class="app-canvas !block !min-h-[calc(100vh-52px)]">
        <header class="h-16 bg-[#fcfcfd] border-b border-[#e3e6eb] px-7 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M7 4v3m10-3v3M5 7l1 13h12l1-13"/></svg>
                <span class="text-[31px] font-extrabold tracking-tight">Store</span>
            </div>
            <nav class="flex items-center gap-8 text-sm font-semibold text-[#111827]">
                <a href="<?php echo e(route('user.products')); ?>">Home</a>
                <a href="<?php echo e(route('user.products')); ?>">Categories</a>
                <a href="<?php echo e(route('user.products')); ?>">Support</a>
            </nav>
        </header>

        <main class="min-h-[calc(100vh-116px)] flex items-center justify-center p-6">
            <div class="w-full max-w-[480px] ui-card rounded-2xl p-8">
                <div class="text-center mb-8">
                    <div class="w-14 h-14 rounded-xl bg-black text-white grid place-items-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M7 4v3m10-3v3M5 7l1 13h12l1-13"/></svg>
                    </div>
                    <h1 class="text-[42px] font-extrabold tracking-tight text-[#111827]">Welcome Back</h1>
                    <p class="text-sm text-[#6b7280]">Masuk ke akun Anda untuk melanjutkan belanja</p>
                </div>

                <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="redirect" value="<?php echo e($redirectTarget); ?>">
                    <div>
                        <label class="block text-xs font-bold text-[#111827] mb-1.5">Email</label>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required class="ui-input" placeholder="nama@email.com">
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-xs font-bold text-[#111827]">Password</label>
                            <span class="text-xs text-[#6b7280]">Lupa sandi?</span>
                        </div>
                        <input type="password" name="password" required class="ui-input" placeholder="••••••••">
                    </div>
                    <label class="flex items-center gap-2 text-sm text-[#6b7280]">
                        <input type="checkbox" name="remember" class="rounded border-[#d9dde3]">
                        Ingat saya
                    </label>
                    <button type="submit" class="w-full h-11 rounded-lg bg-black text-white font-bold hover:bg-[#111827] transition">Login</button>
                </form>

                <div class="mt-6 border-t border-[#eceff3] pt-6 text-center text-sm text-[#6b7280]">
                    Belum punya akun? <a href="<?php echo e(route('register', ['redirect' => $redirectTarget])); ?>" class="font-bold text-[#111827]">Daftar</a>
                </div>
            </div>
        </main>

        <footer class="h-14 border-t border-[#e3e6eb] text-xs text-[#9aa1ad] flex items-center justify-center">© 2024 E-Commerce Store Platform. All rights reserved.</footer>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\auth\login.blade.php ENDPATH**/ ?>