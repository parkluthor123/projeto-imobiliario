<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Contato;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        return view('adm.home', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }
}
