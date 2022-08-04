<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;


class PesananController extends Controller
{ 
    public function index() {

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

    public function riwayat(Request $request)
    {
        $client = new Client();
        $meja = $request->session()->get('no_meja');
        dd($meja);
        $request = $client->get(env('URL').'/api/pesanan/showpesananmeja/'.$meja);
        $response = json_decode($request->getBody()->getContents());
        #dd($response);
        $data=$response->data;
        return view('user.riwayat', ['data' => $data]);
    }
    
}