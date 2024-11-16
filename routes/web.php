<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InputDataController;
use App\Http\Controllers\KeuanganBulananController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RiwayatPembayaranController;
use App\Models\KeuanganBulanan;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResiController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard/inputdata', [InputDataController::class, 'index'])->middleware('penagih');

Route::resource('/dashboard/inputdata/inputmeteran', RiwayatPembayaranController::class)->middleware('penagih');

Route::resource('/dashboard/laporan', LaporanController::class)->middleware('penagih');
// Route::get('/dashboard/laporan/{id}/edit/{token}', [LaporanController::class, 'edit'])->middleware('auth')->name('laporan.edit');

Route::resource('/dashboard/keuangan', KeuanganBulananController::class)->middleware('pengurus');
// Route::get('/dashboard/keuangan/{id}/edit/{token}', [KeuanganBulananController::class, 'edit'])->middleware('auth')->name('keuangan.edit');



Route::post('/export-pdf-bulan', [PdfController::class, 'cetakPdf_bulan'])->middleware('auth');
Route::post('/export-pdf-tahun', [PdfController::class, 'cetakPdf_tahun'])->middleware('auth');

// Route::post('/export-pdf-buktipembayaran', [PdfController::class, 'cetakPdf_buktiPembayaran']);

Route::get('/{uuid}/resi',[ResiController::class, 'index'])->middleware('auth')->name('resi');
Route::post('/{uuid}/export-pdf-buktilunas', [PdfController::class, 'cetakPdf_buktiLunas'])->middleware('auth')->name('buktilunas');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


