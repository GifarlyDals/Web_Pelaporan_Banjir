<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\CAuth;

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



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
