<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukGudangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiManagerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
*/
// Route::get('/download-pdf', [PDFController::class, 'downloadPDF'])->name('download.pdf');

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes for Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/index', [DashboardController::class, 'Adminindex'])->name('index');
    Route::resource('user', PegawaiController::class);
    Route::resource('gudang', GudangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
});

// Routes for Admingudang
Route::middleware(['auth', 'role:admingudang'])->prefix('admingudang')->name('admingudang.')->group(function () {
    Route::get('/index', [DashboardController::class, 'Admingudangindex'])->name('index');
    Route::resource('produk', ProdukGudangController::class);
    Route::get('/transaksi/pdf', [TransaksiController::class, 'generatePDF'])->name('transaksi.pdf');
    Route::resource('transaksi', TransaksiController::class);
});


// Routes for Manager
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/index', [DashboardController::class, 'Managerindex'])->name('index');
    Route::resource('transaksi', TransaksiManagerController::class);
    Route::get('/transaksi/downloadPDF', [TransaksiManagerController::class, 'downloadPDF'])->name('transaksi.downloadPDF');
});
