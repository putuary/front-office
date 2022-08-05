<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class AdminController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function pesanan()
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/pesanan/showstatus?status=di pesan');
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        return view('admin.pesanan', ['data' => $data]);
    }

    public function riwayat()
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/riwayat');
        $response = json_decode($request->getBody()->getContents());
        // dd($response->data);
        $data=$response->data;

        //return collection of posts as a resource
        return view('admin.riwayat_transaksi', ['data' => $data]);
    }

    public function transaksi()
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/pesanan/daftarmeja');
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        #dd($data);
        return view('admin.transaksi.daftar_transaksi', ['data' => $data]);
    }

    public function transaksi_meja($no_meja)
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/pesanan/showpesananmeja/'.$no_meja);
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        #dd($data);
        return view('admin.transaksi.transaksi_meja', ['data' => $data]);
    }

    public function ubahStatus(Request $request)
    {
        $client = new Client();
        $response=$client->request('PUT',env('URL').'/api/riwayat_transaksi/'.$request->id_pesanan,
             array(
                 'form_params' => array(
                    'uang_bayar' => $request->uang_bayar,
                 )
             )
         );
         $data = json_decode($response->getBody()->getContents());

         return redirect()->back();
    }

    public function cetak_struk($id_pesanan) {
        $client = new Client();
        $request = $client->get(env('URL').'/api/riwayat_transaksi/'.$id_pesanan);
        $response = json_decode($request->getBody()->getContents());
        #dd($response->data);
        $data=$response->data;

        //return collection of posts as a resource
        return view('admin.transaksi.struk', ['data' => $data]);
    }
}