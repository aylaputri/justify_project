<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/landing', function () {
    return view('landing');
});

Route::get('/katalog', function () {
    return view('page.katalog');
});

Route::get('/mixmatch', function () {
    return view('page.mixmatch');
});

Route::get('/home', function () {
    return view('page.home');
});
?>

