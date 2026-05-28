<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CAuth;
use App\Http\Controllers\CLaporan;

Route::get('/', function () {
    return view('welcome');
});



// ======================
// REGISTER
// ======================

Route::get('/register',
    [CAuth::class, 'showRegister'])
    ->name('register');

Route::post('/register',
    [CAuth::class, 'register'])
    ->name('register.process');


// ======================
// LOGIN
// ======================

Route::get('/login',
    [CAuth::class, 'showLogin'])
    ->name('login');

Route::post('/login',
    [CAuth::class, 'login'])
    ->name('login.process');



// ======================
// LOGOUT
// ======================

Route::post('/logout',
    [CAuth::class, 'logout'])
    ->name('logout');

// ======================
// Laporan  
// ======================


Route::middleware('auth')->group(function () {

    Route::get('/buat-laporan', [CLaporan::class, 'buat'])
        ->name('buatlaporan');

    Route::post('/simpan-laporan', [CLaporan::class, 'simpan'])
        ->name('simpanlaporan');

});

// ======================
// Laporan   Saya
// ======================

Route::get('/laporan-saya',
    [CLaporan::class, 'index']
)->name('laporansaya');

// ======================
// Detail Laporan
// ======================
Route::get(
    '/laporan/{id}',
    [CLaporan::class, 'lihat']
)->name('laporan.detail');


// ======================
// Komentar Laporan
// ======================
Route::post(
    '/laporan/{id}/komentar',
    [CLaporan::class, 'komentar']
)->name('laporan.komentar');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
