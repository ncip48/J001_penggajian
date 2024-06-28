<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Auth\UbahPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\PotongGajiController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('login');
});

Auth::routes();

Route::middleware(['auth', 'web'])->group(function () {
    //dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //karyawan
    Route::resource('karyawan', KaryawanController::class);

    //jabatan
    Route::resource('jabatan', JabatanController::class);

    //absensi
    Route::resource('absensi', AbsensiController::class);

    //lembur
    Route::resource('lembur', LemburController::class);

    //setting potong gaji
    Route::resource('setting-potong-gaji', PotongGajiController::class);

    //gaji
    Route::resource('gaji', GajiController::class);

    //ubah password
    Route::get('ubah-password', [UbahPasswordController::class, 'index'])->name('ubah-password');
    Route::put('ubah-password', [UbahPasswordController::class, 'action'])->name('ubah-password.action');
});
