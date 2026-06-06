<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ManageCatalogController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\AddressController;

/* Admin Routes */
// Admin Authentication
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// Admin Dashboard & Management (Protected)
Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {
    
    // Main Dashboard & Pages
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', fn() => view('admin.profile'))->name('profile');
    Route::get('/manage-home', fn() => view('admin.manageHome'))->name('manage-home');
    Route::get('/manage-mixmatch', fn() => view('admin.manageMixmatch'))->name('manage-mixmatch');
    Route::get('/reports', fn() => view('admin.reports'))->name('reports');

    // Customers Management
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

    // Staffs Management (CRUD)
    Route::prefix('staffs')->as('staffs.')->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('index');
        Route::get('/create', [StaffController::class, 'create'])->name('create');
        Route::post('/', [StaffController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [StaffController::class, 'edit'])->name('edit');
        Route::put('/{id}', [StaffController::class, 'update'])->name('update');
        Route::delete('/{id}', [StaffController::class, 'destroy'])->name('destroy');
    });

    // Orders Management
    Route::prefix('orders')->as('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::put('/update/{id}', [OrderController::class, 'update'])->name('update');
    });

    // Catalog Management 
    // Mengakses URL: http://127.0.0.1:8000/admin/manage-catalog
    Route::prefix('manage-catalog')->as('catalog.')->group(function () {
        Route::get('/', [ManageCatalogController::class, 'index'])->name('index');
        Route::post('/store', [ManageCatalogController::class, 'store'])->name('store'); // Ditambahkan kembali agar bisa create data
        Route::put('/update/{id}', [ManageCatalogController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ManageCatalogController::class, 'destroy'])->name('destroy');
        Route::get('/size-chart/{id_category}', [ManageCatalogController::class, 'getSizeChart'])->name('size-chart');
    });
});

/* User Routes */
Route::get('/', function () {

    if (session()->has('user_id')) {

        return redirect('/home');

    }

    return redirect('/login');

});

// =========================
// USER AUTHENTICATION
// =========================

Route::get(
    '/login',
    [UserAuthController::class, 'showLogin']
)->name('login');

Route::post(
    '/login',
    [UserAuthController::class, 'login']
);

Route::get(
    '/register',
    [UserAuthController::class, 'showRegister']
)->name('register');

Route::post(
    '/register',
    [UserAuthController::class, 'register']
);

// =========================
// PROTECTED USER PAGES
// =========================

Route::middleware('user')->group(function () {

    // HOME
    Route::get(
        '/home',
        fn() => view('page.home')
    )->name('home');

    // KATALOG
    Route::get(
        '/katalog',
        [KatalogController::class, 'index']
    )->name('katalog');

    // MIXMATCH
    Route::get(
        '/mixmatch',
        fn() => view('page.mixmatch')
    )->name('mixmatch');

    // CART
    Route::get(
        '/cart',
        fn() => view('page.cart')
    )->name('cart');

    // PROFILE
    Route::get(
        '/profile',
        fn() => view('page.profile')
    )->name('profile');

    // ADDRESS
    Route::get(
        '/addAddress',
        fn() => view('page.addAddress')
    )->name('addAddress');

    // CHECKOUT
    Route::get(
        '/checkout',
        fn() => view('page.checkout')
    )->name('checkout');

    // PAYMENT
    Route::post(
        '/checkout/payment',
        [PaymentController::class, 'payment']
    )->name('payment.process');

    // INVOICE
    Route::get(
        '/invoice/{id}',
        [PaymentController::class, 'invoice']
    )->name('payment.invoice');

    // LOGOUT
    Route::get(
        '/logout',
        [UserAuthController::class, 'logout']
    )->name('logout');
});

// Midtrans Notification (Webhook - Skip CSRF)
Route::post('/checkout/notification', [PaymentController::class, 'notification'])
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
    ->name('payment.notification');

/* Debugging Routes */
Route::get('/debug-session', function () {
    return response()->json([
        'user_id'   => session('user_id'),
        'user_name' => session('user_name'),
    ]);
});