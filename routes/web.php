<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;

Route::get('/', [MenuController::class, 'index'])->name('home'); // главная = меню
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// простые страницы (можно позже, но удобно сразу)
Route::view('/delivery', 'pages.delivery')->name('delivery');
Route::view('/contacts', 'pages.contacts')->name('contacts');
