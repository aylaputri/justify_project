<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KatalogController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ManageCatalogController;

Route::get('/admin/login', [AuthController::class, 'showLogin']);
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/admin/logout', [AuthController::class, 'logout']);

Route::middleware('admin')->group(function () {

    Route::get('/admin/dashboard', fn() => view('admin.dashboard'));

    Route::get('/admin/profile', fn() => view('admin.profile'));

    Route::get('/admin/customers', fn() => view('admin.customers'));

    Route::get('/admin/staffs', fn() => view('admin.staffs'));

    Route::get('/admin/orders', fn() => view('admin.orders'));

    Route::get('/admin/manage-home', fn() => view('admin.manageHome'));

    Route::get(
        '/admin/manage-catalog',
        [ManageCatalogController::class, 'index']
    );

    Route::post(
        '/admin/catalog/store',
        [ManageCatalogController::class, 'store']
    );

    Route::put(
        '/admin/catalog/update/{id}',
        [ManageCatalogController::class, 'update']
    );

    Route::delete(
        '/admin/catalog/delete/{id}',
        [ManageCatalogController::class, 'destroy']
    );

    Route::get('/admin/manage-mixmatch', fn() => view('admin.manageMixmatch'));

    Route::get('/admin/reports', fn() => view('admin.reports'));

    Route::get('/admin/size-chart/{id_category}', [ManageCatalogController::class, 'getSizeChart']);
});

Route::get('/home', fn() => view('page.home'));

Route::get('/katalog', [KatalogController::class, 'index']);

Route::get('/mixmatch', fn() => view('page.mixmatch'));

Route::get('/cart', fn() => view('page.cart'));

Route::get('/profile', fn() => view('page.profile'));

Route::get('/addAddress', fn() => view('page.addAddress'));

Route::get('/checkout', fn() => view('page.checkout'));

Route::post('/checkout/payment', [PaymentController::class, 'payment']);