<?php

namespace App\Http\Controllers\Api;

use App\Models\Pesanan;
use App\Models\MenuDipesan;
use App\Models\Menu;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PesananResource;
use Illuminate\Support\Facades\Redis;
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
        $daftar_pesanan=MenuDipesan::join('pesanan', 'menu_dipesan.id_pesanan', '=', 'pesanan.id_pesanan')
                        ->join('menu', 'menu_dipesan.id_menu', '=', 'menu.id_menu')
                        ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','total_harga', 'status')->get();
        #var_dump($daftar_pesanan);

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
        // dd($request->jumlah);
        //define validation rules
        $validator = Validator::make($request->all(), [
            'no_meja'       => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        date_default_timezone_set('Asia/Jakarta');
        //create pesanan
        $pesan = Pesanan::create([
            'no_meja'       => $request->no_meja,
            'waktu_pesan'   => date("Y-m-d h:i:s"),
            'status'        => 'di pesan',
        ]);

        //define validation rules
        $validator = Validator::make($request->all(), [
            'jumlah'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        for($i=0; $i<count($request->id_menu); $i++) {
            echo $i;
            $menu=Menu::where('id_menu', $request->id_menu[$i])->get();
            
            $total_harga[$i] = $menu[0]->harga_jual * (int)$request->jumlah[$i];

            // create pesanan
            $menu_dipesan = MenuDipesan::create([
                'id_pesanan'    => $pesan->id_pesanan,
                'id_menu'       => $request->id_menu[$i],
                'jumlah'        => $request->jumlah[$i],
                'total_harga'   => $total_harga[$i],
            ]);
            
            $affected = Menu::where('id_menu', $request['id_menu'][$i])
                        ->update(['stok' => ($menu[0]->stok - $request['jumlah'][$i])]);
                 
        }
        $pesanan=MenuDipesan::join('pesanan', 'menu_dipesan.id_pesanan', '=', 'pesanan.id_pesanan')
                ->join('menu', 'menu_dipesan.id_menu', '=', 'menu.id_menu')
                ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','total_harga', 'status')
                ->where('menu_dipesan.id_pesanan', $pesan->id_pesanan,)->get();
       
        //return response
        return new PesananResource(true, 'Data Pesanan Berhasil Ditambahkan!', $pesanan);
    }
    
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Pesanan $pesanan)
    {
        $pesan=MenuDipesan::join('pesanan', 'menu_dipesan.id_pesanan', '=', 'pesanan.id_pesanan')
                ->join('menu', 'menu_dipesan.id_menu', '=', 'menu.id_menu')
                ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','total_harga', 'status')
                ->where('pesanan.id_pesanan', $pesanan->id_pesanan)->get();
        //return single post as a resource
        return new PesananResource(true, 'Data Pesanan Ditemukan!', $pesan);
    }

    public function showPesananMeja(Request $request)
    {
        $pesan=MenuDipesan::join('pesanan', 'menu_dipesan.id_pesanan', '=', 'pesanan.id_pesanan')
                ->join('menu', 'menu_dipesan.id_menu', '=', 'menu.id_menu')
                ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','total_harga', 'status')
                ->where('no_meja', $request->no_meja)->get();
        // return single post as a resource
        return new PesananResource(true, 'Data Pesanan Ditemukan!', $pesan);
    }
   
    
}