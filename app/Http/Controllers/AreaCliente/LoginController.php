<?php

namespace App\Http\Controllers\AreaCliente;

use App\Http\Controllers\Controller;
use App\Models\Ajuste;
use App\Models\Cliente;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        $ajustes = Ajuste::get()->first();
        return view("pages.area-restrita.login", array(
            'ajustes' => $ajustes,
        ));
    }

    public function login(Request $request)
    {
        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        if(Auth::guard('clientes')->attempt($credentials))
        {
            return redirect()->route('area-restrita.home');
        }
        else{
            return redirect()->route('area-restrita.login');
        }
    }

    public function criar()
    {
        return view('pages.area-restrita.criar-conta');
    }

    public function criarConta(Request $request)
    {
        $messages = [
            'privacidade.accepted' => 'Os termos de uso e privacidade precisam ser aceitos',
            'password.required' => 'O campo senha é obrigatório',
            'conf_senha.required' => 'O campo confirmar senha é obrigatório',
            'conf_senha.same' => 'Os campos senha precisam ser idênticos',
        ];

        $validated = $request->validate([
            'privacidade' => 'accepted',
            'password' => 'required',
            'conf_senha' => 'required | same:password',
        ], $messages);

        $cliente = new Cliente();
        $cliente['name'] = $request->get('nome');
        $cliente['email'] = $request->get('email');
        $cliente['password'] = Hash::make($request->get('password'));

        if($cliente->save())
        {
            event(new Registered($cliente));
            return redirect()->route('area-restrita.login')->with('verify', "Parabéns! Sua conta foi criada com sucesso, verifique seu e-mail e confirme sua conta através do link");
        }
    }

    public function sair()
    {
        Auth::guard('clientes')->logout();
        return redirect()->route('goHome');
    }
}
