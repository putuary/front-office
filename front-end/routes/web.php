<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Login\LoginController;
use App\Http\Controllers\Admin\Login\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\MejaController;
use App\Http\Controllers\User\LoginMejaController ;
use App\Http\Controllers\User\MenuController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\PesananController;
use App\Http\Controllers\User\FeedbackController;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/admin', [LoginController::class, 'authenticate']);
Route::post('/admin/logout', [LoginController::class, 'logout']);

Route::get('/admin/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/admin/register', [RegisterController::class, 'store']);

Route::get('/admin/pesanan', [AdminController::class, 'pesanan'])->name('pesanan')->middleware('auth');

Route::get('/admin/transaksi', [AdminController::class, 'transaksi'])->name('Transaksi')->middleware('auth');;
Route::get('/admin/transaksi/{no_meja}', [AdminController::class, 'transaksi_meja'])->name('Transaksi.Meja')->middleware('auth');
Route::post('/admin/transaksi', [AdminController::class, 'ubahStatus'])->name('Transaksi.Status')->middleware('auth');
Route::get('/admin/struk/{id_pesanan}', [AdminController::class, 'cetak_struk'])->name('cetak_struk')->middleware('auth');

Route::get('/admin/riwayat', [AdminController::class, 'riwayat'])->name('RiwayatTransaksi')->middleware('auth');


Route::get('/login', [LoginMejaController::class, 'index']);
Route::post('/login', [LoginMejaController::class, 'store']);
Route::post('/save_meja', [LoginMejaController::class, 'save_meja']);
Route::get('/meja', [LoginMejaController::class, 'login_as'])->name('login_meja');

Route::resource('/login', LoginMejaController::class);

Route::get('/', [MenuController::class, 'index'])->name('katalog');
Route::get('/promo', [MenuController::class, 'promo'])->name('promo');
Route::get('/makanan', [MenuController::class, 'makanan'])->name('makanan');
Route::get('/minuman', [MenuController::class, 'minuman'])->name('minuman');
Route::get('/dessert', [MenuController::class, 'dessert'])->name('dessert');
Route::get('/detail/{id_menu}', [MenuController::class, 'detail']);


Route::get('/fasilitas', function () {
        return view('user.fasilitas');
});

Route::get('/pesanan/{id_pesanan}', [PesananController::class, 'show']);
Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');

Route::get('/riwayat/{no_meja}', [PesananController::class, 'riwayat']);

Route::get('/feedback/{no_meja}', [FeedbackController::class, 'index'])->name('feedback');
Route::get('/feedback_pesanan/{id_pesanan}', [FeedbackController::class, 'tambah_feedback']);
Route::post('/feedback', [FeedbackController::class, 'store'])->name("feedback.store");

Route::get('/keranjang/{no_meja}', [KeranjangController::class, 'tampil_item']);
Route::post('/tambah_keranjang', [KeranjangController::class, 'store'])->name("keranjang.store");