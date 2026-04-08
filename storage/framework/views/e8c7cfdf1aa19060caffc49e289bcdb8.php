
<?php $__env->startSection('title','Daftar - UKK E-Commerce'); ?>
<?php $__env->startSection('content'); ?>
<?php ($redirectTarget = old('redirect', request('redirect', $backUrl ?? route('user.products')))); ?>
<div class="app-viewport">
    <div class="app-canvas !block !min-h-[calc(100vh-52px)]">
        <header class="h-16 bg-[#fcfcfd] border-b border-[#e3e6eb] px-7 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M7 4v3m10-3v3M5 7l1 13h12l1-13"/></svg>
                <span class="text-[31px] font-extrabold tracking-tight">ShopCentral</span>
            </div>
            <nav class="flex items-center gap-8 text-sm font-semibold text-[#111827]">
                <a href="<?php echo e(route('user.products')); ?>">Beranda</a>
                <a href="<?php echo e(route('user.products')); ?>">Produk</a>
                <a href="<?php echo e(route('user.products')); ?>">Bantuan</a>
                <a href="<?php echo e(route('login', ['redirect' => $redirectTarget])); ?>" class="btn-dark !h-10 !px-5">Masuk</a>
            </nav>
        </header>

        <main class="min-h-[calc(100vh-116px)] flex items-center justify-center p-6">
            <div class="w-full max-w-[520px] ui-card rounded-2xl p-8 border-t-4 border-t-[#74f0c2]">
                <div class="text-center mb-6">
                    <h1 class="text-[42px] font-extrabold tracking-tight text-[#111827]">Buat Akun Baru</h1>
                    <p class="text-sm text-[#6b7280]">Bergabunglah dengan ribuan pengguna lainnya di platform kami.</p>
                </div>

                <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="redirect" value="<?php echo e($redirectTarget); ?>">

                    <div>
                        <label class="block text-xs font-bold text-[#111827] mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>" required class="ui-input" placeholder="Masukkan nama lengkap">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#111827] mb-1.5">Email</label>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required class="ui-input" placeholder="nama@email.com">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#111827] mb-1.5">Kata Sandi</label>
                        <input type="password" name="password" required class="ui-input" placeholder="Minimal 8 karakter">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#111827] mb-1.5">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" required class="ui-input" placeholder="Ulangi kata sandi Anda">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#111827] mb-1.5">No. Telepon (opsional)</label>
                        <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" class="ui-input" placeholder="+62 812 3456 7890">
                    </div>

                    <button type="submit" class="w-full h-11 rounded-lg bg-black text-white font-bold hover:bg-[#111827] transition">Daftar Sekarang</button>
                </form>

                <div class="mt-6 border-t border-[#eceff3] pt-6 text-center text-sm text-[#6b7280]">
                    Sudah memiliki akun? <a href="<?php echo e(route('login', ['redirect' => $redirectTarget])); ?>" class="font-bold text-[#111827]">Masuk di sini</a>
                </div>
            </div>
        </main>

        <footer class="h-14 border-t border-[#e3e6eb] text-xs text-[#9aa1ad] flex items-center justify-center">© 2023 ShopCentral E-Commerce. Hak Cipta Dilindungi.</footer>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/auth/register.blade.php ENDPATH**/ ?>