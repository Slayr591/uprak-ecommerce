<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;
use App\Http\Controllers\Staff\ProductController as StaffProductController;
use App\Http\Controllers\Staff\PaymentController as StaffPaymentController;
use App\Http\Controllers\Staff\OrderController as StaffOrderController;

// ─── ROOT ────────────────────────────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('user.products'));

// ─── AUTH ─────────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─── USER (role: user) ────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:user'])->group(function () {

    // Products
    Route::get('/products',          [ProductController::class, 'index'])->name('user.products');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('user.products.show');

    // Cart
    Route::get('/cart',                      [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add',                 [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}',             [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}',            [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart',                   [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout',  [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Payment
    Route::get('/payment/{order}',        [PaymentController::class, 'show'])->name('payment');
    Route::post('/payment/{order}/upload',[PaymentController::class, 'upload'])->name('payment.upload');
    Route::get('/payment/{order}/success',[PaymentController::class, 'success'])->name('payment.success');

    // Order History
    Route::get('/history',          [UserOrderController::class, 'index'])->name('user.history');
    Route::get('/history/{order}',  [UserOrderController::class, 'show'])->name('user.history.show');
});

// ─── ADMIN (role: admin) ──────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Users
    Route::resource('users', AdminUserController::class);
    Route::patch('users/{user}/toggle', [AdminUserController::class, 'toggle'])->name('users.toggle');

    // Products
    Route::resource('products', AdminProductController::class);

    // Orders
    Route::get('orders',              [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}',      [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');

    // Staff management
    Route::resource('staff', StaffController::class);

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports');

    // Role & Permissions
    Route::get('permissions/{role?}', [\App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions');
    Route::put('permissions/{role}',  [\App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('permissions.update');

    // Backup & Restore
    Route::get('backup',                    [\App\Http\Controllers\Admin\BackupController::class, 'index'])->name('backup.index');
    Route::post('backup',                   [\App\Http\Controllers\Admin\BackupController::class, 'create'])->name('backup.create');
    Route::post('backup/{file}/restore',     [\App\Http\Controllers\Admin\BackupController::class, 'restore'])
        ->where('file', '[A-Za-z0-9._-]+')
        ->name('backup.restore');
    Route::delete('backup/{file}',           [\App\Http\Controllers\Admin\BackupController::class, 'destroy'])
        ->where('file', '[A-Za-z0-9._-]+')
        ->name('backup.destroy');
});

// ─── STAFF (role: staff) ──────────────────────────────────────────────────────
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {

    Route::get('/dashboard', [StaffDashboard::class, 'index'])->name('dashboard');

    // Products
    Route::get('products',              [StaffProductController::class, 'index'])->name('products.index');
    Route::get('products/create',       [StaffProductController::class, 'create'])->name('products.create');
    Route::post('products',             [StaffProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit',[StaffProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}',    [StaffProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [StaffProductController::class, 'destroy'])->name('products.destroy');

    // Payment confirmation
    Route::get('payments',                   [StaffPaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/{order}',           [StaffPaymentController::class, 'show'])->name('payments.show');
    Route::patch('payments/{order}/confirm', [StaffPaymentController::class, 'confirm'])->name('payments.confirm');
    Route::patch('payments/{order}/reject',  [StaffPaymentController::class, 'reject'])->name('payments.reject');

    // Orders
    Route::get('orders',         [StaffOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [StaffOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/ship', [StaffOrderController::class, 'ship'])->name('orders.ship');
});
