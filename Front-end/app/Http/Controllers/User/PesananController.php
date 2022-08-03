<?php

namespace App\Http\Controllers\User;

use App\Models\Pesanan;
use App\Models\MenuDipesan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PesananResource;
use GuzzleHttp\Client;


class PesananController extends Controller
{ 
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
    
}