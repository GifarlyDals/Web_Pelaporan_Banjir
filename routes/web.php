<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CLandingPage;
use App\Http\Controllers\CAuth;
use App\Http\Controllers\CLaporan;
use App\Http\Controllers\CLaporanAdmin;
use App\Http\Controllers\CKomentar;
use App\Http\Controllers\CPeta;

Route::get('/', [CLandingPage::class, 'index'])->name('');






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



// User 



Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // ======================
    // Laporan  
    // ======================
    Route::get('/buat-laporan', [CLaporan::class, 'buat'])
        ->name('buatlaporan');

    Route::post('/simpan-laporan', [CLaporan::class, 'simpan'])
        ->name('simpanlaporan');


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
    // Peta
    // ======================
    Route::get(
        '/peta-banjir',
        [CPeta::class, 'index']
    )->name('peta');
});

Route::middleware(['auth'])->group(function () {

    // ======================
    // Komentar Laporan
    // ======================
    Route::post(
        '/laporan/{id}/komentar',
        [CKomentar::class, 'store']
    )->name('laporan.komentar');

    Route::get(
        '/laporan/{id}',
        [CLaporanAdmin::class, 'lihat']
    )->name('admin.laporan.lihat');
});


// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {

        return view('admin.dashboard');
    });

    Route::get(
        '/laporan',
        [CLaporanAdmin::class, 'index']
    )->name('admin.laporan');


    Route::put(
        '/laporan/{id}/status',
        [CLaporanAdmin::class, 'updateStatus']
    )->name('admin.laporan.status');
});
