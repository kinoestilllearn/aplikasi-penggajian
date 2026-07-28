<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenggajianController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('penggajian', PenggajianController::class);
    Route::resource('pegawai', PegawaiController::class);
    Route::get('generate-pdf/penggajian/{id}', [PenggajianController::class, 'generatePDF'])->name('generate-pdf');
    Route::get('generate-pdf/penggajian/{id}/cetak', [PenggajianController::class, 'cetakPDF'])->name('cetak-pdf');
});

Route::get('data-pegawai/', [PegawaiController::class, 'dataPegawai'])->name('data-pegawai');
Route::get('data-penggajian/', [PenggajianController::class, 'dataPenggajian'])->name('data-penggajian');
