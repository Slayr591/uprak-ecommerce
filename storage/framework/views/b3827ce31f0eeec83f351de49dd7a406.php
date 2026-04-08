<aside class="w-64 bg-black border-r border-gray-800 flex flex-col flex-shrink-0 h-screen sticky top-0">
    <div class="p-6 flex items-center gap-3 border-b border-gray-800">
        <div class="w-8 h-8 bg-green-400 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-black" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg>
        </div>
        <h1 class="text-lg font-bold text-white">STAFF<span class="text-green-400">PORTAL</span></h1>
    </div>
    <nav class="flex-1 p-4 space-y-1">
        <a href="<?php echo e(route('staff.dashboard')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('staff.dashboard') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="<?php echo e(route('staff.products.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('staff.products.*') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            Produk
        </a>
        <a href="<?php echo e(route('staff.payments.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('staff.payments.*') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Konfirmasi Pembayaran
        </a>
        <a href="<?php echo e(route('staff.orders.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('staff.orders.*') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Pesanan
        </a>
    </nav>
    <div class="p-4 border-t border-gray-800">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-8 h-8 bg-green-400 rounded-full flex items-center justify-center text-black text-xs font-bold"><?php echo e(substr(auth()->user()->name,0,1)); ?></div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate"><?php echo e(auth()->user()->name); ?></p>
                <p class="text-xs text-gray-400">Staff Lead</p>
            </div>
        </div>
        <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?>
            <button type="submit" class="flex items-center gap-2 w-full px-3 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-800 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
<?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\partials\staff-sidebar.blade.php ENDPATH**/ ?>