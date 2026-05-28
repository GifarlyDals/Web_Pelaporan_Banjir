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

    Route::get('/buatlaporan', [CLaporan::class, 'buat'])
        ->name('buatlaporan');

    Route::post('/simpanlaporan', [CLaporan::class, 'simpan'])
        ->name('simpanlaporan');

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
