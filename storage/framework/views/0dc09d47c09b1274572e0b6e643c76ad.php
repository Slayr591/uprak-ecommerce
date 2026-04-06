

<div id="logout-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
         onclick="document.getElementById('logout-modal').classList.add('hidden')"></div>

    
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">

        
        <div class="px-8 pt-10 pb-6 text-center">
            <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Keluar</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
                Apakah Anda yakin ingin logout? Anda harus masuk kembali untuk mengakses akun Anda.
            </p>
        </div>

        <hr class="border-gray-100">

        
        <div class="px-8 py-6 space-y-3">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit"
                        class="w-full py-3 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition-colors">
                    Ya, Logout
                </button>
            </form>
            <button type="button"
                    onclick="document.getElementById('logout-modal').classList.add('hidden')"
                    class="w-full py-3 border border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                Batal
            </button>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/partials/logout-modal.blade.php ENDPATH**/ ?>