<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MejaController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\KeranjangController;
use App\Http\Controllers\Api\PesananController;
use App\Http\Controllers\Api\RiwayatTransaksiController;
use App\Http\Controllers\Api\FeedbackController;


//posts
Route::apiResource('/meja', MejaController::class);
Route::get('/menu/showtype',[MenuController::class, 'showtype']);
Route::apiResource('/menu', MenuController::class);
Route::apiResource('/keranjang', KeranjangController::class);
Route::delete('/keranjang',[KeranjangController::class, 'destroy']);
Route::get('/pesanan/showstatus',[PesananController::class, 'showstatus']);
Route::get('/pesanan/showpesananmeja/{no_meja}',[PesananController::class, 'showPesananMeja']);
Route::get('/pesanan/daftarmeja',[PesananController::class, 'daftarMeja']);
Route::apiResource('/pesanan', PesananController::class);
Route::get('/riwayat',[RiwayatTransaksiController::class, 'riwayat']);
Route::apiResource('/riwayat_transaksi', RiwayatTransaksiController::class);
// Route::get('/feedback/belum_isi/{no_meja}', [FeedbackController::class, 'belum_isi']);
Route::apiResource('/feedback', FeedbackController::class);