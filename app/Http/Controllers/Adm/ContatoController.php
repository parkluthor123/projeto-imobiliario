<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContatoController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        return view('adm.contato.contato-create', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function store(Request $request)
    {

        $messages = [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'phone.required' => 'O telefone é obrigatório',
            'assunto.required' => 'O assunto é obrigatório',
            'mensagem.required' => 'A mensagem é obrigatória',
        ];

        $validated = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'assunto' => 'required',
            'mensagem' => 'required',
        ], $messages);

        $contato = new Contato();
        $contato['nome'] = $request->nome;
        $contato['email'] = $request->email;
        $contato['phone'] = $request->phone;
        $contato['assunto'] = $request->assunto;
        $contato['mensagem'] = $request->mensagem;
        $contato['status'] = true;

        if($contato->save())
        {
            return redirect()->back()->with("success", "Contato salvo com sucesso");
        }
        else
        {
            return redirect()->back()->with("success", "Erro ao salvar o contato");
        }
    }

    public function show()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        return view('adm.contato.contato-show', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function getData()
    {
        $contato = Contato::all();
        return response()->json($contato);
    }

    public function edit($id)
    {
        $contato = Contato::find($id);
        $clientesAll = Cliente::all();
        $contatoAll = Contato::all();

        return view('adm.contato.contato-edit', array(
            'clienteCount' => count($clientesAll),
            'contatoCount' => count($contatoAll),
            'contato' => $contato,
        ));
    }

    public function update(Request $request, $id)
    {
        $contato = Contato::find($id);

        $messages = [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'phone.required' => 'O telefone é obrigatório',
            'assunto.required' => 'O assunto é obrigatório',
            'mensagem.required' => 'A mensagem é obrigatória',
        ];

        $contato['nome'] = $request->nome;
        $contato['email'] = $request->email;
        $contato['phone'] = $request->phone;
        $contato['assunto'] = $request->assunto;
        $contato['mensagem'] = $request->mensagem;

        if($contato->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }

    public function delete(Request $request, $id)
    {
        $contato = Contato::find($id);
        if($contato->delete())
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


    public function ajaxDataContato(Request $request)
    {
        $contato = Contato::where("nome", "like", "%".$request->input."%")
            ->orWhere("email", "like", "%".$request->input."%")->get();

        if(count($contato) < 1)
        {
            $contato = Contato::all();
        }
        return response()->json($contato);
    }

    public function updateNotification(Request $request)
    {
        $contato = Contato::find($request->id);
        $contato['status'] = true;

        if($contato->save())
        {
            return response()->json(200);
        }
    }
}
