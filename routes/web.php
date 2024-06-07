<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('show-products',  [App\Http\Controllers\HomeController::class, 'showProducts'])->name('showProducts');

Route::get('create-product',  [App\Http\Controllers\HomeController::class, 'createProduct'])->name('createProduct');
Route::post('create-product',  [App\Http\Controllers\HomeController::class, 'storeProduct'])->name('storeProduct');
