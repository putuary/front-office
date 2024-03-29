<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;


class PesananController extends Controller
{ 
    public function show($id_pesanan) {
        $client = new Client();
        $request = $client->get(env('URL').'/api/pesanan/'.$id_pesanan);
        $response = json_decode($request->getBody()->getContents());
        #dd($response);
        $data=$response->data;
        return view('user.rincian', ['data' => $data]);
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

        return redirect('/pesanan/'.$data->id_pesanan);
    }

    public function riwayat($no_meja)
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/pesanan/showpesananmeja/'.$no_meja);
        $response = json_decode($request->getBody()->getContents());
        #dd($response);
        $data=$response->data;
        return view('user.riwayat', ['data' => $data]);
    }
    
}