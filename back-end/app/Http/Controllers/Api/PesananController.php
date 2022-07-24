<?php

namespace App\Http\Controllers\Api;

use App\Models\Pesanan;
use App\Models\Meja;
use App\Models\MenuDipesan;
use App\Models\Menu;
use App\Models\RiwayatTransaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PesananResource;
use Illuminate\Support\Facades\Validator;


class PesananController extends Controller
{    
    private function ubahArray($result) {
        $array=array('id_pesanan'=>$result[0]->id_pesanan,
                    'no_meja'=>$result[0]->no_meja,
        );
        for($i=0;$i<count($result);$i++) {
            $array["menu_dipesan"][$i]=(object)[
                "nama_menu"     => $result[$i]->nama_menu,
                "gambar"        => $result[$i]->gambar,
                "harga_jual"    => $result[$i]->harga_jual,
                "jumlah"        => $result[$i]->jumlah,
                "harga_peritem" => $result[$i]->harga_peritem,
            ];  
        }
        $array['total_harga']=$result[0]->total_harga;
        $array['status']=$result[0]->status;
        $array['waktu_pesan']=$result[0]->waktu_pesan;
        return $array;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get pesanan
        $daftar_pesanan=Pesanan::get();
        $data=array();
        for($i=0;$i<count($daftar_pesanan);$i++) {
            array_push($data, $this->show($daftar_pesanan[$i]->id_pesanan)->resource);
        }

        //return collection of posts as a resource
        return new PesananResource(true, 'List Data Pesanan', $data);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        #dd($request->all());
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
            #dd($menu[0]->harga_jual);
            
            $harga_peritem = $menu[0]->harga_jual * (int)$request->jumlah[$i];

            // create pesanan
            $menu_dipesan = MenuDipesan::create([
                'id_pesanan'    => $pesan->id_pesanan,
                'id_menu'       => $request->id_menu[$i],
                'jumlah'        => $request->jumlah[$i],
                'harga_peritem'   => $harga_peritem,
            ]);
            
            $total_harga+=$harga_peritem;

            $affected = Menu::where('id_menu', $request->id_menu[$i])
                        ->update(['stok' => ($menu[0]->stok - $request->jumlah[$i])]);
                 
        }
        $affected = Pesanan::where('id_pesanan', $pesan->id_pesanan)
                        ->update(['total_harga' => $total_harga]);
        
        $riwayat = RiwayatTransaksi::create([
                'id_pesanan'    => $pesan->id_pesanan,
                'status'        => 'belum_dibayar',
            ]);


        $pesanan=$this->show($pesan->id_pesanan)->resource;
        
        //return response
        return new PesananResource(true, 'Data Pesanan Berhasil Ditambahkan!', $pesanan);
    }
    
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show($id_pesanan)
    {
        // $pesanan=Pesanan::where('id_pesanan', $id_pesanan)->get();
        // var_dump($pesanan);
        // dd($pesanan);
        $pesan=MenuDipesan::join('pesanan', 'menu_dipesan.id_pesanan', '=', 'pesanan.id_pesanan')
                ->join('menu', 'menu_dipesan.id_menu', '=', 'menu.id_menu')
                ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','gambar','harga_jual','jumlah','harga_peritem','waktu_pesan', 'status', 'total_harga')
                ->where('pesanan.id_pesanan', $id_pesanan)->get();
        //return single post as a resource
        #echo(count($pesan));
        #dd($pesan);
        if(count($pesan)==0) {
            $pesanan=Pesanan::where('id_pesanan', $id_pesanan)->get();
        }
        else {
            $pesanan=$this->ubahArray($pesan);
        }
        return new PesananResource(true, 'Data Pesanan Ditemukan!', $pesanan);
    }

    public function showstatus(Request $request)
    {
        $result =Pesanan::where('status', $request->status)->get();
        //return single post as a resource
        
        $data=array();
        for($i=0;$i<count($result);$i++) {
            array_push($data, $this->show($result[$i]->id_pesanan)->resource);
        }
        
        return new PesananResource(true, 'Data Menu Ditemukan!', $data);
    }

    public function showPesananMeja($no_meja)
    {
        $result=Pesanan::where('no_meja', $no_meja)
                ->where('status', '!=', 'selesai')->get();

        $data=array();
        for($i=0;$i<count($result);$i++) {
           array_push($data, $this->show($result[$i]->id_pesanan)->resource);
        }

        // return single post as a resource
        return new PesananResource(true, 'Data Pesanan Ditemukan!', $data);
    }
    public function daftarMeja() {
        $data=Meja::get();
        $result=array();
        foreach ($data as $meja) {
            if(!empty($this->showPesananMeja($meja->no_meja)->resource)) {
                array_push($result, $meja->no_meja);
            }
        }
        return response()->json([
            'message' => 'Daftar Meja yang memesan',
            'data'    => $result,
        ]);
       
    }
}