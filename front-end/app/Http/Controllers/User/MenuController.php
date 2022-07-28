<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class MenuController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $client = new Client();
        $request = $client->get(env('URL').'/api/menu/');
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;

        //return collection of posts as a resource
        return view('user.katalog', ['data' => $data]);   
    }

    public function promo() {
        $client = new Client();
        $request = $client->get(env('URL').'/api/menu/showtype?tipe_produk=promo');
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        return view('user.katalog', ['data' => $data]);
    }
        
    
    public function makanan()
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/menu/showtype?tipe_produk=makanan');
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        return view('user.katalog', ['data' => $data]);
    }

    public function minuman() 
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/menu/showtype?tipe_produk=minuman');
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        return view('user.katalog', ['data' => $data]);
    }

    public function dessert()
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/menu/showtype?tipe_produk=dessert');
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        return view('user.katalog', ['data' => $data]);
    }
}