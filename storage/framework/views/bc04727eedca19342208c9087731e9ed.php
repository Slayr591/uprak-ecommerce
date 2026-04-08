<aside class="w-64 bg-black border-r border-gray-800 flex flex-col flex-shrink-0 h-screen sticky top-0">
    <div class="p-6 flex items-center gap-3 border-b border-gray-800">
        <div class="w-8 h-8 bg-green-400 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-black" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg>
        </div>
        <h1 class="text-lg font-bold text-white">Admin<span class="text-green-400">Panel</span></h1>
    </div>
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.users.*') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Pengguna
        </a>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.products.*') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            Produk
        </a>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.orders.*') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Pesanan
        </a>
        <a href="<?php echo e(route('admin.staff.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.staff.*') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            Manajemen Staff
        </a>
        <a href="<?php echo e(route('admin.reports')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.reports') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Laporan
        </a>

        <div class="pt-2">
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">System</p>
            <a href="<?php echo e(route('admin.permissions')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.permissions*') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                Role & Permission
            </a>
            <a href="<?php echo e(route('admin.backup.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.backup*') ? 'bg-green-400 text-black' : 'text-gray-400 hover:bg-gray-800 hover:text-white'); ?>">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
                Backup & Restore
            </a>
        </div>
    </nav>
    <div class="p-4 border-t border-gray-800">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-8 h-8 bg-green-400 rounded-full flex items-center justify-center text-black text-xs font-bold"><?php echo e(substr(auth()->user()->name,0,1)); ?></div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate"><?php echo e(auth()->user()->name); ?></p>
                <p class="text-xs text-gray-400 truncate">Super Admin</p>
            </div>
        </div>
        <button type="button"
                onclick="document.getElementById('logout-modal').classList.remove('hidden')"
                class="flex items-center gap-2 w-full px-3 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-800 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Keluar
        </button>
    </div>
</aside>
<?php echo $__env->make('partials.logout-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/partials/admin-sidebar.blade.php ENDPATH**/ ?>