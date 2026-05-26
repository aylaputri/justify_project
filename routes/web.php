<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KatalogController; 

use App\Http\Controllers\Admin\AuthController;
Route::get('/admin/login', [AuthController::class, 'showLogin']);
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/admin/logout', [AuthController::class, 'logout']);

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('admin');

Route::get('/home', function () {
    return view('page.home');
});

// ROUTE KATALOG YANG SUDAH DIPERBAIKI (Hanya butuh 1 baris ini saja)
Route::get('/katalog', [KatalogController::class, 'index']);

Route::get('/mixmatch', function () {
    return view('page.mixmatch');
});

Route::get('/cart', function () {
    return view('page.cart');
});

Route::get('/profile', function () {
    return view('page.profile');
});

Route::get('/addAddress', function () {
    return view('page.addAddress');
});

Route::get('/checkout', function () {
    return view('page.checkout');
});

Route::post('/checkout/payment', [PaymentController::class, 'payment']);
?>