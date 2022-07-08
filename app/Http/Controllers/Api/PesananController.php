<?php

namespace App\Http\Controllers\Api;

use App\Models\Pesanan;
use App\Models\MenuDipesan;
use App\Models\Menu;
use App\Models\RiwayatTransaksi;
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
                        ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','harga_peritem', 'status')->get();
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
            'id_menu'       => 'required',
            'jumlah'        => 'required',
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
            'total_harga'   => 0,
        ]);

        $total_harga=0;

        for($i=0; $i<count($request->id_menu); $i++) {
            $menu=Menu::where('id_menu', $request->id_menu[$i])->get();
            
            $harga_peritem = $menu[0]->harga_jual * (int)$request->jumlah[$i];

            // create pesanan
            $menu_dipesan = MenuDipesan::create([
                'id_pesanan'    => $pesan->id_pesanan,
                'id_menu'       => $request->id_menu[$i],
                'jumlah'        => $request->jumlah[$i],
                'harga_peritem'   => $harga_peritem,
            ]);
            
            $total_harga+=$harga_peritem;

            $affected = Menu::where('id_menu', $request['id_menu'][$i])
                        ->update(['stok' => ($menu[0]->stok - $request['jumlah'][$i])]);
                 
        }
        $affected = Pesanan::where('id_pesanan', $pesan->id_pesanan)
                        ->update(['total_harga' => $total_harga]);
        
        $riwayat = RiwayatTransaksi::create([
                'id_pesanan'    => $pesan->id_pesanan,
                'status'        => 'belum dibayar',
            ]);


        $pesanan=MenuDipesan::join('pesanan', 'menu_dipesan.id_pesanan', '=', 'pesanan.id_pesanan')
                ->join('menu', 'menu_dipesan.id_menu', '=', 'menu.id_menu')
                ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','harga_peritem', 'status', 'total_harga')
                ->where('menu_dipesan.id_pesanan', $pesan->id_pesanan)->get();
       
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
                ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','harga_peritem', 'status')
                ->where('pesanan.id_pesanan', $pesanan->id_pesanan)->get();
        //return single post as a resource
        return new PesananResource(true, 'Data Pesanan Ditemukan!', $pesan);
    }

    public function showPesananMeja(Request $request)
    {
        $pesan=MenuDipesan::join('pesanan', 'menu_dipesan.id_pesanan', '=', 'pesanan.id_pesanan')
                ->join('menu', 'menu_dipesan.id_menu', '=', 'menu.id_menu')
                ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','harga_peritem', 'status')
                ->where('no_meja', $request->no_meja)->get();
        // return single post as a resource
        return new PesananResource(true, 'Data Pesanan Ditemukan!', $pesan);
    }
   
    
}