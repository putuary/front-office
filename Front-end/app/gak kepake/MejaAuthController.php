<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MejaAuthController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function login()
    {
        return view('user.login');
    }

    public function handleLogin(Request $request)
    {
        if(Auth::attempt(
            $request->only(['email', 'password'])
        ))
        {
            return redirect()->intended('/');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('user.login');
    }
}