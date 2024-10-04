<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MerkController;
use App\Http\Controllers\Admin\MetodePembayaranController;
use App\Http\Controllers\Admin\MobilController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
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

Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');

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
});
