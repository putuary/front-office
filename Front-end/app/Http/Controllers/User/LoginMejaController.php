<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;


class LoginMejaController extends Controller
{    
    public function index()
    {
        return view('user.meja.login');
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */

     public function store(Request $request)
    {
        // cek form validation
        $validator = Validator::make($request->all(), [
            'password'    => 'required',
        ]);

        // cek apakah email dan password benar
        if ($request->password == env('PASSWORD')) {
            return redirect()->route('login_meja');
        }

        // jika salah, kembali ke halaman login
        return redirect()->back()->with('error', 'Password salah');
    }

    public function login_as()
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/meja');
        $response = json_decode($request->getBody()->getContents());
        $data=$response->data;
        return view('user.meja.meja', ['data' => $data]);
    }

    public function save_meja(Request $request){
        $request->session()->put('no_meja', $request['meja']);
    }    
}