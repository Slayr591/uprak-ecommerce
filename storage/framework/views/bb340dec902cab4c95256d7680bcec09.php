<div id="logout-modal" class="hidden fixed inset-0 z-[80] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/55" onclick="document.getElementById('logout-modal').classList.add('hidden')"></div>

    <div class="relative w-full max-w-[450px] rounded-2xl bg-white border border-[#e5e7eb] shadow-[0_30px_70px_rgba(0,0,0,.32)] px-6 py-7">
        <div class="text-center">
            <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-[#ffe9e9] flex items-center justify-center text-[#f10808]">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H9m4 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </div>

            <h3 class="text-[34px] font-extrabold tracking-tight text-[#111827]">Konfirmasi Keluar</h3>
            <p class="mt-2 text-sm text-[#6b7280] leading-relaxed max-w-[330px] mx-auto">
                Apakah Anda yakin ingin logout? Anda harus masuk kembali untuk mengakses akun Anda.
            </p>
        </div>

        <div class="mt-6 border-t border-[#eceff3] pt-5 space-y-3">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full h-11 rounded-lg bg-[#ff1010] text-white text-base font-bold hover:bg-[#e00d0d] transition">
                    Logout
                </button>
            </form>

            <button type="button"
                    onclick="document.getElementById('logout-modal').classList.add('hidden')"
                    class="w-full h-11 rounded-lg border border-[#d4d8df] bg-white text-[#303741] text-base font-semibold hover:bg-[#f8fafc] transition">
                Batal
            </button>

            <p class="pt-2 text-center text-xs text-[#9ca3af]">Variant 8 of 8</p>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\partials\logout-modal.blade.php ENDPATH**/ ?>