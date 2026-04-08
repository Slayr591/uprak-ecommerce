
<?php $__env->startSection('title','Konfirmasi Pembayaran - Staff'); ?>
<?php $__env->startSection('content'); ?>
<div class="app-viewport">
  <div class="app-canvas">
  <?php echo $__env->make('partials.staff-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="flex-1 flex flex-col overflow-hidden bg-[#f7f8fa]">
    <header class="h-16 bg-[#fbfbfc] border-b border-[#dfe3e8] px-8 py-4 flex items-center justify-between"><h2 class="text-[46px] font-extrabold tracking-tight">STAFF PAYMENT CONFIRMATION</h2><a href="#" class="btn-dark !h-10">Export Report</a></header>
    <main class="flex-1 overflow-y-auto p-8">
      <?php echo $__env->make('partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <div class="grid grid-cols-3 gap-4 mb-4">
        <div class="ui-card p-4"><p class="text-sm text-gray-500">Pending Approvals</p><p class="text-5xl font-extrabold"><?php echo e($orders->total()); ?></p></div>
        <div class="rounded-xl border border-[#121212] bg-[#8cf58f] p-4"><p class="text-sm">Processed Today</p><p class="text-5xl font-extrabold">Rp.211.957.000</p></div>
        <div class="ui-card p-4"><p class="text-sm text-gray-500">Rejection Rate</p><p class="text-5xl font-extrabold">3.2%</p></div>
      </div>
      <div class="ui-card overflow-hidden border-2 border-black">
        <table class="w-full">
          <thead><tr class="bg-black text-xs font-bold text-white uppercase">
            <th class="text-left px-6 py-3">User Name</th><th class="text-left px-6 py-3">Date & Time</th>
            <th class="text-left px-6 py-3">Order ID</th><th class="text-left px-6 py-3">Amount</th><th class="text-left px-6 py-3">Payment Proof</th><th class="text-left px-6 py-3">Actions</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3"><p class="text-sm font-semibold"><?php echo e($order->user->name); ?></p><p class="text-xs text-gray-400"><?php echo e($order->user->email); ?></p></td>
              <td class="px-6 py-3 text-sm text-gray-700"><?php echo e($order->created_at->format('d M Y, H:i')); ?></td>
              <td class="px-6 py-3 text-sm font-medium text-gray-900"><?php echo e($order->order_number); ?></td>
              <td class="px-6 py-3 text-sm font-semibold text-gray-900"><?php echo e($order->total_formatted); ?></td>
              <td class="px-6 py-3 text-xs font-bold">VIEW PROOF</td>
              <td class="px-6 py-3 flex items-center gap-2">
                <a href="<?php echo e(route('staff.payments.show',$order)); ?>" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">View</a>
                <form method="POST" action="<?php echo e(route('staff.payments.confirm',$order)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                  <button class="text-xs px-3 py-1.5 bg-[#8cf58f] text-black rounded border border-black font-bold">Confirm</button>
                </form>
                <form method="POST" action="<?php echo e(route('staff.payments.reject',$order)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                  <button class="text-xs px-3 py-1.5 bg-[#ef4444] text-white rounded border border-black font-bold">Reject</button>
                </form>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6" class="text-center py-12 text-gray-400">Tidak ada pembayaran menunggu konfirmasi.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="px-6 py-4 border-t"><?php echo e($orders->links()); ?></div>
      </div>
    </main>
  </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views/staff/payments/index.blade.php ENDPATH**/ ?>