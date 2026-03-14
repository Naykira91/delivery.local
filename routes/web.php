<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [CheckoutController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('checkout.store');

Route::get('/', [MenuController::class, 'index'])->name('home'); // главная = меню
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// простые страницы (можно позже, но удобно сразу)
Route::view('/delivery', 'pages.delivery')->name('delivery');
Route::view('/contacts', 'pages.contacts')->name('contacts');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/inc/{product}', [CartController::class, 'inc'])->name('cart.inc');
Route::post('/cart/dec/{product}', [CartController::class, 'dec'])->name('cart.dec');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


