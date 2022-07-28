<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;


class LoginController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/meja');
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        return view('user.meja.meja', ['data' => $data]);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */

     public function store(Request $request)
    {
        dd($request->all());
        return redirect()->route('katalog');
    }
        
   
}