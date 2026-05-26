<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

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

Route::get('/katalog', function () {
    return view('page.katalog');
});

Route::get('/mixmatch', function () {
    return view('page.mixmatch');
});

Route::get('/cart', function () {
    return view('page.cart');
});

Route::get('/profile', function () {
    return view('page.profile');
});

Route::get('/checkout', function () {
    return view('page.checkout');
});

Route::get('/addAddress', function () {
    return view('page.addAddress');
});

?>