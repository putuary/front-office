<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\MenuDipesan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PesananResource;
use GuzzleHttp\Client;


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
         #dd($request->all());
         #$c=array( $request->all());
         #unset($c['_token']);
         #dd($c);
         $array=array('no_meja' => $request->no_meja);
         $array['id_menu']=$request->id_menu;
         $array['jumlah']=$request->jumlah;
         #dd($array);


         $client = new Client();
         $response=$client->post(env('URL').'/api/pesanan',
                 array(
                     'form_params' => $array
                 )
             );
        
        $data=json_decode($response->getBody()->getContents())->data;


        for($i=0; $i<count($request->id_menu);$i++) {
            $response=$client->request('DELETE',env('URL').'/api/keranjang',
             array(
                 'form_params' => array(
                    'no_meja' => $request->no_meja,
                    'id_menu' => $request->id_menu[$i],
                 )
             )
         );
        }
        #dd($data);
         
         return view('user.rincian', ['data' => $data]);
    }
    
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show()
    {
       
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