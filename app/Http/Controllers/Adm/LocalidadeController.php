<?php

namespace App\Http\Controllers\Adm;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Bairro;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocalidadeController extends Controller
{
    //
    public function estadoIndex()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.localidades.estados-show', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function estadoCreate()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();


        return view('adm.localidades.estados-create', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function estadoStore(Request $request)
    {
        $estado = new Estado();

        $validated = $request->validate([
            'estado' => 'required',
        ]);

        $estado['estados'] = $request->estado;
        $estado['url_estado'] = Helper::getUrl($request->estado);

        if($estado->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }


    public function estadosUpdate(Request $request, $id)
    {
        $estados = Estado::find($id);

        $validated = $request->validate([
            'estado' => 'required',
        ]);

        $estados['estados'] = $request->estado;
        $estado['url_estado'] = Helper::getUrl($request->estado);

        if($estados->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }

    }


    public function estadoDelete(Request $request, $id)
    {
        $estados = Estado::find($id);

        if($estados->delete())
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

    public function estadoEdit($id)
    {
        $estados = Estado::find($id);
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.localidades.estados-edit', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'estados' => $estados,
        ));
    }

    public function getEstados()
    {
        $estados = Estado::all();
        return response()->json($estados);
    }


    public function ajaxDataEstados(Request $request)
    {
        $estados = Estado::where("estados", "like", "%".$request->input."%")->get();
        if(count($estados) < 1)
        {
            $estados = Estado::all();
        }
        return response()->json($estados);
    }


    public function bairroIndex()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.localidades.bairro-show', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function bairroCreate()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        $estados = Estado::get();

        return view('adm.localidades.bairro-create', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'estados' => $estados,
        ));
    }

    public function bairroStore(Request $request)
    {
        $bairros = new Bairro();

        $validated = $request->validate([
            'bairros' => 'required',
            'estados' => 'required',
        ]);

        $bairros['bairros'] = $request->bairros;
        $bairros['id_estados'] = $request->estados;
        $bairros['url_bairro'] = Helper::getUrl($request->bairros);

        if($bairros->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }


    public function getBairros()
    {
        $bairros = Bairro::all();
        return response()->json($bairros);
    }


    public function bairroDelete(Request $request, $id)
    {
        $bairros = Bairro::find($id);

        if($bairros->delete())
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


    public function bairroEdit($id)
    {
        $bairros = Bairro::find($id);
        $clientes = Cliente::all();
        $contato = Contato::all();
        $estados = Estado::get();

        $estadoSelected = DB::table('estados')
            ->join("bairros", "estados.id", "=", "bairros.id_estados")
            ->where("bairros.id", $id)->first();

        return view('adm.localidades.bairro-edit', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'bairros' => $bairros,
            'estados' => $estados,
            'estadoSelected' => $estadoSelected,
        ));
    }

    public function bairroUpdate(Request $request, $id)
    {
        $bairro = Bairro::find($id);
        $validated = $request->validate([
            'bairros' => 'required',
            'estados' => 'required',
        ]);

        $bairro['bairros'] = $request->bairros;
        $bairro['id_estados'] = $request->estados;
        $bairro['url_bairro'] = Helper::getUrl($request->bairros);

        if($bairro->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }

    }

    public function ajaxDataBairros(Request $request)
    {
        $bairros = Bairro::where("bairros", "like", "%".$request->input."%")->get();
        if(count($bairros) < 1)
        {
            $bairros = Bairro::all();
        }
        return response()->json($bairros);
    }

}
