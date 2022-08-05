<?php

namespace App\Http\Controllers\Api;

use App\Models\RiwayatTransaksi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Expr\FuncCall;

class RiwayatTransaksiController extends Controller
{  
    private function ubahArray($result) {
        $array=array('id_pesanan'=>$result[0]->id_pesanan,
                    'no_meja'=>$result[0]->no_meja,
        );
        for($i=0;$i<count($result);$i++) {
            $array["menu_dipesan"][$i]=(object)[
                "nama_menu"     => $result[$i]->nama_menu,
                "harga_jual"    => $result[$i]->harga_jual,
                "jumlah"        => $result[$i]->jumlah,
                "harga_peritem" => $result[$i]->harga_peritem,
            ];  
        }
        $array['total_harga']=$result[0]->total_harga;
        $array['waktu_pesan']=$result[0]->waktu_pesan;
        $array['status_transaksi']=$result[0]->status_transaksi;
       
        return $array;
    }  
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $transaksi = RiwayatTransaksi::get();

        #dd();

        $data=array();
        for($i=0;$i<count($transaksi);$i++) {
            array_push($data, $this->show($transaksi[$i]->id_pesanan)->getData()->data);
        }
        //return collection of posts as a resource
        return response()->json([
            'message' => 'List daftar Riwayat Transaksi',
            'data'    => $data,
        ]);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show($id_pesanan)
    {
        $transaksi = RiwayatTransaksi::join('pesanan', 'riwayat_transaksi.id_pesanan', '=', 'pesanan.id_pesanan')
                    ->join('menu_dipesan', 'pesanan.id_pesanan', '=', 'menu_dipesan.id_pesanan')
                    ->join('menu', 'menu_dipesan.id_menu', '=', 'menu.id_menu')
                    ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','harga_peritem', 'total_harga','waktu_pesan', 'status_transaksi')
                    ->where('menu_dipesan.id_pesanan', $id_pesanan)->get();

        if(count($transaksi)==0) {
            $riwayat=RiwayatTransaksi::where('id_pesanan', $id_pesanan)->get();
        }
        else {
            $riwayat=$this->ubahArray($transaksi);
        }

        //return single post as a resource
        return response()->json([
            'message' => 'Data riwayat transaksi dari id pesanan '. $id_pesanan,
            'data'    => $riwayat,
        ]);
    }

    public function update($id_pesanan, Request $request)
    {
        $pesanan= Pesanan::where('id_pesanan', $id_pesanan)->get();
        $transaksi=RiwayatTransaksi::where('id_pesanan', $id_pesanan)
        ->update(['uang_bayar' => $request->uang_bayar,
                'uang_kembalian' => $request->uang_bayar - $pesanan[0]->total_harga,
                'status_transaksi' => 'Lunas']);
        
        return response()->json([
            'message' => 'Data berhasil Diubah',
       ]);
    }

    public function riwayat() {
        $transaksi = RiwayatTransaksi::where('status_transaksi','Lunas')->get();

        #dd($transaksi[0]->id_pesanan);

        $data=array();
        for($i=0;$i<count($transaksi);$i++) {
            array_push($data, $this->show($transaksi[$i]->id_pesanan)->getData()->data);
        }
        //return collection of posts as a resource
        return response()->json([
            'message' => 'List daftar Riwayat Transaksi',
            'data'    => $data,
        ]);
    }
}