<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use App\Models\Banner;
use App\Models\Estado;
use App\Models\ImagemImovel;
use App\Models\Imovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        $imoveis = Imovel::where('status', '=', 'comprar')->with('getImages')->take(3)->get();

        $estados = Estado::get();
        $bairros = Bairro::get();

        return view("pages.home", array(
            'banner' => $banner,
            'imoveis' => $imoveis,
            'estados' => $estados,
            'bairros' => $bairros,
        ));
    }

    public function getEstados(Request $request)
    {
        if($request->estado !== null)
        {
            $estadoId = Estado::where('url_estado', '=', $request->estado)->first();
            $bairros = Bairro::where("id_estados", "=", $estadoId['id'])->get();
        }
        else
        {
            $bairros = "disabled";
        }
        return response()->json($bairros);
    }
}
