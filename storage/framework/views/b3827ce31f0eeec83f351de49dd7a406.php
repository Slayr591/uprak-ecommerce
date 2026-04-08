<aside class="w-[250px] bg-[#02050b] border-r border-[#111827] flex flex-col flex-shrink-0">
    <div class="px-5 py-6 border-b border-[#101a2a] flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-[#8cf5d2] text-[#042218] flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <p class="text-[30px] leading-none text-white font-extrabold tracking-tight">STAFF <span class="text-[#8cf5d2]">PORTAL</span></p>
    </div>

    <nav class="flex-1 px-3 py-4 overflow-y-auto space-y-1.5">
        <a href="<?php echo e(route('staff.dashboard')); ?>" class="admin-side-link <?php echo e(request()->routeIs('staff.dashboard') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4.5 10.5V21h5.25v-6h4.5v6h5.25V10.5"/></svg>
            Dashboard
        </a>
        <a href="<?php echo e(route('staff.products.index')); ?>" class="admin-side-link <?php echo e(request()->routeIs('staff.products.*') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7l8-4 8 4-8 4-8-4zm0 5l8 4 8-4m-16 5l8 4 8-4"/></svg>
            Product Management
        </a>
        <a href="<?php echo e(route('staff.payments.index')); ?>" class="admin-side-link <?php echo e(request()->routeIs('staff.payments.*') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Payment Confirmation
        </a>
        <a href="<?php echo e(route('staff.orders.index')); ?>" class="admin-side-link <?php echo e(request()->routeIs('staff.orders.*') ? 'active' : ''); ?>">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-10 4h6M5 4h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"/></svg>
            Orders
        </a>

        <div class="pt-3">
            <p class="px-3 pb-1 text-[10px] uppercase tracking-[0.16em] text-[#4f5b70] font-bold">System Maintenance</p>
            <a href="javascript:void(0)" class="admin-side-link opacity-60 cursor-not-allowed">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 7.5A2.25 2.25 0 016 5.25h12A2.25 2.25 0 0120.25 7.5v9A2.25 2.25 0 0118 18.75H6A2.25 2.25 0 013.75 16.5v-9zm4.5 2.25h7.5"/></svg>
                Backup & Restore
            </a>
        </div>
    </nav>

    <div class="border-t border-[#101a2a] p-4">
        <div class="rounded-xl border border-[#142235] bg-[#050913] p-3.5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-full bg-[#8cf5d2] text-[#04140d] flex items-center justify-center font-extrabold text-xs"><?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?></div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-white truncate"><?php echo e(auth()->user()->name); ?></p>
                    <p class="text-[11px] uppercase tracking-wide text-[#7f8ea3]">Staff Lead</p>
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



<?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\partials\staff-sidebar.blade.php ENDPATH**/ ?>