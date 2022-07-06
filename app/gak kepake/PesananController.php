<?php

namespace App\Http\Controllers\Api;

use App\Models\Pesanan;
use App\Models\MenuDipesan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PesananResource;
use Illuminate\Support\Facades\Validator;


class PesananController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get pesanan
        $daftar_pesanan=DB::table('pesanan')
                        ->join('menu', 'pesanan.id_menu', '=', 'menu.id_menu')
                        ->select('id_pesanan','no_meja','nama_menu','harga_jual','pesanan.jumlah','total_harga')->get();

        //return collection of posts as a resource
        return new PesananResource(true, 'List Data Pesanan', $daftar_pesanan);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'no_meja'       => 'required',
            'jumlah'        => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $produk=DB::table('menu')
        ->join('pesanan', 'menu.id_menu', '=', 'pesanan.id_menu')
        ->select('menu.jumlah', 'harga_jual')->where('menu.id_menu', $request->id_menu)->get();
        #var_dump($produk);

        if($request->jumlah <= $produk[0]->jumlah) {
            $total=$produk[0]->harga_jual * $request->jumlah;
            date_default_timezone_set('Asia/Jakarta');

            $affected = DB::table('menu')
              ->where('id_menu', $request->id_menu)
              ->update(['jumlah' => $produk[0]->jumlah - $request->jumlah]);
            
              #var_dump($affected);
    
            //create pesanan
            $pesanan = Pesanan::create([
                'id_pesanan'    => $request->id_pesanan,
                'no_meja'       => $request->no_meja,
                'id_menu'       => $request->id_menu,
                'jumlah'        => $request->jumlah,
                'total_harga'   => $total,
                'waktu_pesan'   => date("Y-m-d h:i:s"),
                
            ]);
    
            //return response
            return new PesananResource(true, 'Data Pesanan Berhasil Ditambahkan!', $pesanan);
        }
        else {
            return new PesananResource(false, 'Maaf, jumlah pesanan melebihi jumlah stok menu', null);
        }
       
    }
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Request $request)
    {
        $pesanan=DB::table('pesanan')
                ->join('menu', 'pesanan.id_menu', '=', 'menu.id_menu')
                ->select('id_pesanan','no_meja','nama_menu','harga_jual','pesanan.jumlah','total_harga')
                ->where('no_meja', $request->no_meja)->get();
        //return single post as a resource
        return new PesananResource(true, 'Data Pesanan Ditemukan!', $pesanan);
    }
}