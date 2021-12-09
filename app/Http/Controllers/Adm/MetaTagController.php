<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\MetaTag;
use Illuminate\Http\Request;

class MetaTagController extends Controller
{
    public function show()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        $metatags = MetaTag::get();
        return view('adm.meta-tags.meta-tags-show', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'metatags' => $metatags,
        ));
    }

    public function edit($id)
    {
        $metatags = MetaTag::find($id);
        $clientes = Cliente::all();
        $contato = Contato::all();
        return view('adm.meta-tags.meta-tags-edit', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'metatags' => $metatags,
        ));
    }

    public function update(Request $request, $id)
    {
        $metatags = MetaTag::find($id);
        $metatags['keywords'] = $request->keywords;
        $metatags['description'] = $request->descricao;
        $metatags['codes'] = $request->code;

        if($metatags->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }
}
