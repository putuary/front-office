<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class TransaksiController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/pesanan/daftarmeja');
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        #dd($data);
        return view('admin.transaksi.daftar_transaksi', ['data' => $data]);
    }
    public function transaksiMeja($no_meja)
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/pesanan/showpesananmeja/'.$no_meja);
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        #dd($data);
        return view('admin.transaksi.transaksi_meja', ['data' => $data]);
    }

}