<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KeranjangResource;
use GuzzleHttp\Client;


class KeranjangController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $keranjang = Keranjang::latest()->paginate(5);

        //return collection of posts as a resource
        return new KeranjangResource(true, 'List Data Keranjang', $keranjang);
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
        $client = new Client();
        $response=$client->post(env('URL').'/api/keranjang',
                array(
                    'form_params' => array(
                        'no_meja' => $request->no_meja,
                        'id_menu' => $request->id_menu,
                    )
                )
            );
        
        $data=json_decode($response->getBody()->getContents())->message;
        
        return redirect()->route('katalog');
    }
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show($no_meja)
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/keranjang/'.$no_meja);
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;

        return view('user.keranjang', ['data' => $data]);
    }
    
    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Request $request)
    {

        //delete menu dari keranjang
        $delete = Keranjang::where('no_meja', $request->no_meja)
                ->where('id_menu', $request->id_menu)->delete();

        //return response
        return new KeranjangResource(true, 'Menu Berhasil Dihapus dari keranjang!', $delete);
    }
}