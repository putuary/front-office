<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\User\MenuController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\FeedbackController;
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

Route::get('/admin/pesanan', function () {
    $client = new Client();
    $request = $client->get(env('URL') . '/api/pesanan/showstatus?status=di pesan');
    $response = json_decode($request->getBody()->getContents());
    $data = $response->data;

    //return collection of posts as a resource
    return view('admin.pesanan', ['data' => $data]);
})->name('pesanan');

Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('Transaksi');
Route::get('/admin/transaksi/{no_meja}', [TransaksiController::class, 'transaksiMeja'])->name('Transaksi.Meja');
Route::put('/admin/transaksi/{id_pesanan}', [TransaksiController::class, 'ubahStatus'])->name('Transaksi.Status');

Route::get('/admin/riwayat', function () {
    $client = new Client();
    $request = $client->get(env('URL') . '/api/riwayat_transaksi');
    $response = json_decode($request->getBody()->getContents());
    // dd($response->data);
    $data = $response->data;

    //return collection of posts as a resource
    return view('admin.riwayat_transaksi', ['data' => $data]);
})->name('RiwayatTransaksi');

Route::get('/', [MenuController::class, 'index'])->name('katalog');
Route::get('/promo', [MenuController::class, 'promo'])->name('promo');
Route::get('/makanan', [MenuController::class, 'makanan'])->name('makanan');
Route::get('/minuman', [MenuController::class, 'minuman'])->name('minuman');
Route::get('/dessert', [MenuController::class, 'dessert'])->name('dessert');

Route::resource('/meja', MejaController::class);
Route::resource('/login', LoginController::class);


Route::get('/fasilitas', function () {
    return view('user.fasilitas');
});

Route::get('/riwayat', function () {
    $client = new Client();
    $request = $client->get(env('URL') . '/api/pesanan/showpesananmeja/2');
    $response = json_decode($request->getBody()->getContents());
    #dd($response);
    $data = $response->data;
    return view('user.riwayat', ['data' => $data]);
});

Route::get('/detail', function () {
    $id_menu = $_GET['id_menu'];
    $client = new Client();
    $request = $client->get(env('URL') . '/api/menu/' . $id_menu);
    $response = json_decode($request->getBody()->getContents());
    $data = $response->data;
    return view('user.detail', ['data' => $data]);
});


Route::resource('/feedback', FeedbackController::class);

Route::resource('/keranjang', KeranjangController::class);
Route::delete('/keranjang', [KeranjangController::class, 'destroy']);



//posts

Route::get('/pesanan/showpesananmeja', [PesananController::class, 'showPesananMeja']);
Route::resource('/pesanan', PesananController::class);
