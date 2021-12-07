<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DependentDropdownController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
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
    Route::get('/konfirmasipembayaran/{id}', [TransactionController::class, 'konfirmasipembayaran'])->name('konfirmasipembayaran');
    Route::post('/updateresi/{id}', [TransactionController::class, 'updateResi'])->name('updateResi');
});

Route::middleware(['auth', 'ceklevel:admin,pelanggan'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/transaksi/diproses', [TransactionController::class, 'prosesTransaksi'])->name('prosesTransaksi');
    Route::get('/transaksi/dikirim', [TransactionController::class, 'kirimTransaksi'])->name('kirimTransaksi');
    Route::get('/transaksi/selesai', [TransactionController::class, 'selesaiTransaksi'])->name('selesaiTransaksi');
    Route::get('/transaksi/batalkan/{id}', [TransactionController::class, 'cancelTransaksi'])->name('cancelTransaksi');
    Route::resource('/produk', ProductController::class);
    Route::resource('/transaksi', TransactionController::class);

});

Route::middleware(['auth', 'ceklevel:pelanggan'])->group(function () {
    Route::resource('/keranjang', CartController::class);
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [CustomerController::class, 'updateProfile'])->name('updateProfile');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/cities/{province_id}', [CustomerController::class, 'getCities']);

Route::get('/ongkir', [CartController::class, 'get_ongkir'])->name('ongkir');
