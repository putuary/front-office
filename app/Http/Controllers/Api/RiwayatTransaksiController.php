<?php

namespace App\Http\Controllers\Api;

use App\Models\RiwayatTransaksi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RiwayatTransaksiController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $transaksi = RiwayatTransaksi::join('pesanan', 'riwayat_transaksi.id_pesanan', '=', 'pesanan.id_pesanan')
        ->join('menu_dipesan', 'pesanan.id_pesanan', '=', 'menu_dipesan.id_peanan')
        ->join('menu', 'menu_dipesan.id_menu', '=', 'menu.id_menu')
        ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','harga_peritem', 'total_harga', 'riwayat_transaksi.status')
        ->latest()->paginate(5);

        //return collection of posts as a resource
        return response()->json([
            'message' => 'List daftar Riwayat Transaksi',
            'data'    => $transaksi,
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
        ->join('menu_dipesan', 'pesanan.id_pesanan', '=', 'menu_dipesan.id_peanan')
        ->join('menu', 'menu_dipesan.id_menu', '=', 'menu.id_menu')
        ->select('menu_dipesan.id_pesanan','no_meja','nama_menu','harga_jual','jumlah','harga_peritem', 'total_harga', 'riwayat_transaksi.status')
        ->where('menu_dipesan.id_pesanan', $id_pesanan)->get();

        //return single post as a resource
        return response()->json([
            'message' => 'Feedback dari id pesanan '. $id_pesanan,
            'data'    => $transaksi,
        ]);
    }
}