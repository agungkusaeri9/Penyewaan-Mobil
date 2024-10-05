<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MerkController;
use App\Http\Controllers\Admin\MetodePembayaranController;
use App\Http\Controllers\Admin\MobilController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;
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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', AboutController::class)->name('about');
Route::get('/contact', ContactController::class)->name('contact');


Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/cek-ketersediaan', [BookingController::class, 'cek_ketersediaan'])->name('cek-ketersediaan');

Route::middleware('auth')->group(function () {
    Route::get('peminjaman/{uuid}/success', [PeminjamanController::class, 'success'])->name('peminjaman.success');
    Route::post('peminjaman/{uuid}/upload-bukti', [PeminjamanController::class, 'upload_bukti'])->name('peminjaman.upload-bukti');
    Route::post('peminjaman', [PeminjamanController::class, 'pinjam'])->name('peminjaman.pinjam');
    Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('peminjaman/{uuid}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
});
// admin
Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('customer', UserController::class)->only(['index', 'edit', 'update']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // merk
    Route::resource('merk', MerkController::class)->except('show');
    // mobil
    Route::resource('mobil', MobilController::class)->except('show');
    Route::resource('metode-pembayaran', MetodePembayaranController::class)->except('show');
    Route::get('peminjaman/getJson', [AdminPeminjamanController::class, 'getJson'])->name('peminjaman.getJson');
    Route::resource('peminjaman', \App\Http\Controllers\Admin\PeminjamanController::class)->only(['index', 'edit', 'update', 'show']);
    Route::resource('pengembalian', \App\Http\Controllers\Admin\PengembalianController::class);
});
