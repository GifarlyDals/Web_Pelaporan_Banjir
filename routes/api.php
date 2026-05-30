<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LaporanApiController;
use App\Http\Controllers\Api\KomentarApiController;

/*
|--------------------------------------------------------------------------
| PUBLIC API
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| PROTECTED API
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource(
        'laporan',
        LaporanApiController::class
    );

    Route::get(
        '/laporan/{id}/komentar',
        [KomentarApiController::class, 'index']
    );

    Route::post(
        '/laporan/{id}/komentar',
        [KomentarApiController::class, 'store']
    );
});