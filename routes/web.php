<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authentication')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(ProductController::class)->group(function() {
    Route::get('/product', 'index')->name('product.index');
    Route::get('/product/{product_code}', 'show')->name('product.show');
});

Route::controller(CartController::class)->group(function() {
    Route::post('/cart/add/{product_code}', 'addToCart')->name('cart.addToCart');
    Route::get('/cart', 'viewCart')->name('cart.viewCart');
});

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
