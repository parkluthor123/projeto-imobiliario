<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\TipoImovel;
use Illuminate\Http\Request;

class TipoImovelController extends Controller
{
    //
    public function create()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.tipo-imovel.tipo-imovel-create', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function show()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.tipo-imovel.tipo-imovel-show', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function store(Request $request)
    {
        $tipo = new TipoImovel();
        $tipo['tipo'] = $request->tipo_imovel;

        if($tipo->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }

    public function edit($id)
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        $tipoImovel = TipoImovel::find($id);

        return view('adm.tipo-imovel.tipo-imovel-edit', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'tipo' => $tipoImovel,
        ));
    }

    public function update(Request $request, $id)
    {
        $tipo = TipoImovel::find($id);
        $tipo['tipo'] = $request->tipo_imovel;

        if($tipo->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }

    public function delete(Request $request,$id)
    {
        $tipoImovel = TipoImovel::find($id);

        if($tipoImovel->delete())
        {
            $message = "Item excluído com sucesso!";
            return response()->json($message);
        }
        else
        {
            $message = "Erro ao excluir este ítem!";
            return response()->json($message);
        }
    }

    public function ajaxDataTipoImovel(Request $request)
    {
        $tipoImovel = TipoImovel::where("tipo", "like", "%".$request->input."%")->get();
        if(count($tipoImovel) < 1)
        {
            $tipoImovel = TipoImovel::all();
        }
        return response()->json($tipoImovel);
    }

    public function getTipo()
    {
        $tipoImovel = TipoImovel::all();
        return response()->json($tipoImovel);
    }
}
