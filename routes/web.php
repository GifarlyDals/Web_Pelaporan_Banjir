<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CAuth;
use App\Http\Controllers\CLaporan;
use App\Http\Controllers\CKomentar;
use App\Http\Controllers\CPeta;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// ======================
// REGISTER
// ======================

Route::get(
    '/register',
    [CAuth::class, 'showRegister']
)
    ->name('register');

Route::post(
    '/register',
    [CAuth::class, 'register']
)
    ->name('register.process');


// ======================
// LOGIN
// ======================

Route::get(
    '/login',
    [CAuth::class, 'showLogin']
)
    ->name('login');

Route::post(
    '/login',
    [CAuth::class, 'login']
)
    ->name('login.process');



// ======================
// LOGOUT
// ======================

Route::post(
    '/logout',
    [CAuth::class, 'logout']
)
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

Route::get(
    '/laporan-saya',
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
    [CKomentar::class, 'store']
)->name('laporan.komentar');

// ======================
// Peta
// ======================
Route::get(
    '/peta-banjir',
    [CPeta::class, 'index']
)->name('peta');
