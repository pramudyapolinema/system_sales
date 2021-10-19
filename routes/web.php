<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth', 'ceklevel:admin'])->group(function () {
    Route::resource('/admin', AdminController::class);
    Route::resource('/pelanggan', CustomerController::class);
});

Route::middleware(['auth', 'ceklevel:admin,pelanggan'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('/produk', ProductController::class);
});

Route::middleware(['auth', 'ceklevel:pelanggan'])->group(function () {
    Route::resource('/keranjang', CartController::class);
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
