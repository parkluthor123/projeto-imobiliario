<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('adm.login');
    }

    public function login(Request $request)
    {
        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        if(Auth::guard('web')->attempt($credentials))
        {
            return redirect()->route('adm.home');
        }
        else{
            return redirect()->route('adm.login')->with('verify', "Email ou senha incorreta");
        }
    }
}
