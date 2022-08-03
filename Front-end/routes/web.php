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
Route::put('/admin/transaksi/{id_pesanan}', [AdminController::class, 'ubahStatus'])->name('Transaksi.Status')->middleware('auth');

Route::get('/admin/riwayat', [AdminController::class, 'riwayat'])->name('RiwayatTransaksi')->middleware('auth');



Route::get('/', [MenuController::class, 'index'])->name('katalog');
Route::get('/promo', [MenuController::class, 'promo'])->name('promo');
Route::get('/makanan', [MenuController::class, 'makanan'])->name('makanan');
Route::get('/minuman', [MenuController::class, 'minuman'])->name('minuman');
Route::get('/dessert', [MenuController::class, 'dessert'])->name('dessert');

Route::resource('/meja', MejaController::class);
Route::resource('/login', LoginMejaController::class);


Route::get('/fasilitas', function () {
        return view('user.fasilitas');
});

Route::get('/riwayat', function () {
    $client = new Client();
    $request = $client->get(env('URL').'/api/pesanan/showpesananmeja/2');
    $response = json_decode($request->getBody()->getContents());
    #dd($response);
    $data=$response->data;
    return view('user.riwayat', ['data' => $data]);
});

Route::get('/detail', function () {
    $id_menu=$_GET['id_menu'];
    $client = new Client();
    $request = $client->get(env('URL').'/api/menu/'.$id_menu);
    $response = json_decode($request->getBody()->getContents());
    $data=$response->data;
    return view('user.detail', ['data' => $data]);
});

Route::get('/feedback', [FeedbackController::class, 'index']);
Route::get('/feedback/{id_pesanan}', [FeedbackController::class, 'tambah_feedback']);
Route::post('/feedback', [FeedbackController::class, 'store']);

Route::resource('/keranjang', KeranjangController::class);
Route::delete('/keranjang',[KeranjangController::class, 'destroy']);



//posts

Route::get('/pesanan/showpesananmeja',[PesananController::class, 'showPesananMeja']);
Route::resource('/pesanan', PesananController::class);