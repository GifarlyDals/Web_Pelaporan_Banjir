<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CLandingPage;
use App\Http\Controllers\CAuth;
use App\Http\Controllers\CLaporan;
use App\Http\Controllers\CLaporanAdmin;
use App\Http\Controllers\CKomentar;
use App\Http\Controllers\CPeta;
use App\Http\Controllers\CAdminDashboard;
use App\Http\Controllers\CUser;


Route::get('/', [CLandingPage::class, 'index'])->name('');


use App\Http\Controllers\SoapController;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;

Route::get('/soap/laporan.wsdl', [SoapController::class, 'wsdl']);

Route::post('/soap/server', [SoapController::class, 'handle'])
    ->withoutMiddleware([PreventRequestForgery::class]);

Route::get('/soap/server', [SoapController::class, 'wsdl']);
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


    Route::post(
        '/laporan/{id}/komentar',
        [CKomentar::class, 'store']
    )->name('laporan.komentar');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard',  [CAdminDashboard::class, 'index'])
        ->name('admin.dashboard');

    Route::get(
        '/laporan',
        [CLaporanAdmin::class, 'index']
    )->name('admin.laporan');

    Route::get(
        '/laporan/{id}',
        [CLaporanAdmin::class, 'lihat']
    )->name('admin.laporan.lihat');

    Route::put(
        '/laporan/{id}/status',
        [CLaporanAdmin::class, 'updateStatus']
    )->name('admin.laporan.status');

    // CRUD USER

    Route::get('/user', [CUser::class, 'index'])
        ->name('admin.user');

    Route::get('/user/buat', [CUser::class, 'buat'])
        ->name('admin.user.buat');

    Route::post('/user/simpan', [CUser::class, 'simpan'])
        ->name('admin.user.simpan');

    Route::put('/admin/user/update/{id}', [CUser::class, 'update'])
        ->name('admin.user.update');

    Route::delete('/admin/user/hapus/{id}', [CUser::class, 'hapus'])
        ->name('admin.user.hapus');
});
