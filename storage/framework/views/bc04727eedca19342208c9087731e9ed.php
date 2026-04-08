<aside class="w-[250px] bg-[#02050b] border-r border-[#111827] flex flex-col flex-shrink-0">
    <div class="px-5 py-6 border-b border-[#101a2a] flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-[#2ad887] text-[#02140d] flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2m0 0h13.6l-1.2 6H7.2M5.4 5L7.2 13m0 0a2 2 0 102 2m-2-2h8m0 0a2 2 0 102 2"/>
            </svg>
        </div>
        <p class="text-[29px] leading-none text-white font-extrabold tracking-tight">Admin<span class="text-[#2ad887]">Panel</span></p>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-side-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4.5 10.5V21h5.25v-6h4.5v6h5.25V10.5"/></svg>
            Dashboard
        </a>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="admin-side-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 14a4 4 0 10-8 0m12 7a8 8 0 10-16 0h16z"/></svg>
            Users
        </a>
        <a href="<?php echo e(route('admin.staff.index')); ?>" class="admin-side-link <?php echo e(request()->routeIs('admin.staff.*') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16v12H4zM9 7V5h6v2M9 12h6"/></svg>
            Staff
        </a>
        <a href="<?php echo e(route('admin.permissions')); ?>" class="admin-side-link <?php echo e(request()->routeIs('admin.permissions*') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25a3.75 3.75 0 00-7.5 0V9m-1.5 0h10.5A1.5 1.5 0 0118.75 10.5v8.25A1.5 1.5 0 0117.25 20.25H6.75a1.5 1.5 0 01-1.5-1.5V10.5A1.5 1.5 0 016.75 9z"/></svg>
            Role Management
        </a>
        <a href="<?php echo e(route('admin.reports')); ?>" class="admin-side-link <?php echo e(request()->routeIs('admin.reports') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19V5m5 14V9m5 10V7m5 12V11"/></svg>
            Reports
        </a>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="admin-side-link <?php echo e(request()->routeIs('admin.products.*') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7l8-4 8 4-8 4-8-4zm0 5l8 4 8-4m-16 5l8 4 8-4"/></svg>
            Products
        </a>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="admin-side-link <?php echo e(request()->routeIs('admin.orders.*') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-10 4h6M5 4h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"/></svg>
            Orders
        </a>

        <div class="pt-3">
            <p class="px-3 pb-1 text-[10px] uppercase tracking-[0.16em] text-[#4f5b70] font-bold">System Maintenance</p>
            <a href="<?php echo e(route('admin.backup.index')); ?>" class="admin-side-link <?php echo e(request()->routeIs('admin.backup*') ? 'active' : ''); ?>">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 7.5A2.25 2.25 0 016 5.25h12A2.25 2.25 0 0120.25 7.5v9A2.25 2.25 0 0118 18.75H6A2.25 2.25 0 013.75 16.5v-9zm4.5 2.25h7.5"/></svg>
                Backup & Restore
            </a>
        </div>
    </nav>

    <div class="border-t border-[#101a2a] p-4">
        <div class="rounded-xl border border-[#142235] bg-[#050913] p-3.5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-full bg-[#2ad887] text-[#04140d] flex items-center justify-center font-extrabold text-xs"><?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?></div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-white truncate"><?php echo e(auth()->user()->name); ?></p>
                    <p class="text-[11px] uppercase tracking-wide text-[#7f8ea3]">Super Admin</p>
                </div>
            </div>
            <button type="button"
                    onclick="document.getElementById('logout-modal').classList.remove('hidden')"
                    class="w-full h-9 rounded-lg border border-[#16263b] bg-[#0a1220] text-[#8b98ac] text-xs font-semibold hover:text-white hover:bg-[#111d31] transition">
                Logout
            </button>
        </div>
    </div>
</aside>


<?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/partials/admin-sidebar.blade.php ENDPATH**/ ?>