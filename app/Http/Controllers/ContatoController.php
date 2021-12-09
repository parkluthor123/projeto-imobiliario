<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index()
    {
        $ajustes = Ajuste::first();

        return view('pages.contato', array(
            'ajustes' => $ajustes,
        ));
    }

    public function sendData(Request $request)
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
        $contato['status'] = false;

        if($contato->save())
        {
            return redirect()->back()->with("success", "Mensagem Enviada com sucesso");
        }
        else
        {
            return redirect()->back()->with("success", "Erro ao enviar o agendamento");
        }
    }
}
