<?php

use App\Http\Controllers\PresensiController;
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

Route::resource('presensi', PresensiController::class);
Route::get('presensi/detail/{id}', [PresensiController::class, 'getPresensiPegawai'])->name('presensi.detail');
