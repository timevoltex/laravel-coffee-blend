<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// products
Route::get('products/products-single/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleProduct'])->name('product.single');
Route::post('products/products-single/{id}', [App\Http\Controllers\Products\ProductsController::class, 'addCart'])->name('add.cart');

//cart
Route::get('products/cart', [App\Http\Controllers\Products\ProductsController::class, 'cart'])->name('cart');
