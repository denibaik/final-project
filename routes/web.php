<?php

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Kategori;
use App\Http\Controllers\Admin\Produk;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/get-produk', [HomeController::class, 'get_produk'])->name('get_produk');
Route::post('/beli', [HomeController::class, 'beli'])->name('beli');

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'login_page'])->name('login');
    Route::get('register', [AuthController::class, 'register_page'])->name('register');
    Route::post('register', [AuthController::class, 'register_process']);
    Route::post('login', [AuthController::class, 'login_process']);
});

Route::get('logout', [AuthController::class, 'logout_process'])
    ->middleware('auth')
    ->name('logout');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', AdminOnly::class]
], function () {
    Route::get('', [Dashboard::class, 'index'])->name('admin');
    Route::get('edit/{id}', [Dashboard::class, 'edit'])->name('transaksi.edit');
    Route::put('edit/{id}', [Dashboard::class, 'edit_process'])->name('transaksi.save');
    Route::delete('delete/{id}', [Dashboard::class, 'delete'])->name('transaksi.destroy');

    Route::resource('kategori', Kategori::class);
    Route::resource('produk', Produk::class);
});