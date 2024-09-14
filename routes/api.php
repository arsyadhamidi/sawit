<?php

use App\Http\Controllers\Api\ApiDashboardPageController;
use App\Http\Controllers\Api\ApiJadwalPanenController;
use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiPeminjamanPageController;
use App\Http\Controllers\Api\ApiPetaniPageController;
use App\Http\Controllers\Api\ApiRegistrasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login-action', [ApiLoginController::class, 'authenticate']);
Route::post('register-action', [ApiRegistrasiController::class, 'register']);
Route::get('/harga-sawit', [ApiDashboardPageController::class, 'hargasawit']);
Route::get('/data-petani/{id}', [ApiPetaniPageController::class, 'index']);
Route::post('/data-petani/update/{id}', [ApiPetaniPageController::class, 'update']);
Route::get('/jadwal-panen/{id}', [ApiJadwalPanenController::class, 'index']);
Route::post('/jadwal-panen/store', [ApiJadwalPanenController::class, 'store']);
Route::post('/jadwal-panen/update/{id}', [ApiJadwalPanenController::class, 'update']);
Route::post('/jadwal-panen/destroy/{id}', [ApiJadwalPanenController::class, 'destroy']);
Route::get('/peminjaman/{id}', [ApiPeminjamanPageController::class, 'index']);
Route::post('/peminjaman/store', [ApiPeminjamanPageController::class, 'store']);
Route::post('/peminjaman/update/{id}', [ApiPeminjamanPageController::class, 'update']);
Route::post('/peminjaman/destroy/{id}', [ApiPeminjamanPageController::class, 'destroy']);
