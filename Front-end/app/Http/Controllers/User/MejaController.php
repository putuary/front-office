<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class MejaController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
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
            return redirect()->route('login.index');
        }

        // jika salah, kembali ke halaman login
        return redirect()->back()->with('error', 'Password salah');
    }
        
   
}