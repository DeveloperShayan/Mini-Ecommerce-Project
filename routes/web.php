<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ProductController::class,'index']);

Auth::routes();

Route::prefix('users')->middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart');
    Route::get('/checkout', [App\Http\Controllers\CartController::class, 'index'])->name('checkout');
    Route::get('/checkout/get/items', [App\Http\Controllers\CartController::class, 'getCartItemForCheckout']);
    Route::post('/process/user/payment', [App\Http\Controllers\CartController::class, 'processPayment']);
});