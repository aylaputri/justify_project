<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

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