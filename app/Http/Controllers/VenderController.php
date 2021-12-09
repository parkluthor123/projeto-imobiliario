<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\Venda;
use Illuminate\Http\Request;

class VenderController extends Controller
{
    public function index()
    {
        $ajustes = Ajuste::first();
        return view("pages.vender", array(
            'ajustes' => $ajustes,
        ));
    }

    public function sendData(Request $request)
    {
        $vender = new Venda();
        $messages = [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'phone.required' => 'O telefone é obrigatório',
            'tipo_imovel.required' => 'O tipo de imóvel é obrigatória',
            'endereco.required' => 'O endereço é obrigatório',
            'cidade.required' => 'A cidade é obrigatória',
            'estado.required' => 'O estado é obrigatória',
            'cep.required' => 'O CEP é obrigatório',
            'bairro.required' => 'O bairro é obrigatório',
            'num.required' => 'O número é obrigatório',
        ];

        $validated = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'tipo_imovel' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
            'num' => 'required',
        ], $messages);

        $vender['nome'] = $request->nome;
        $vender['email'] = $request->email;
        $vender['tipo_imovel'] = $request->tipo_imovel;
        $vender['phone'] = $request->phone;
        $vender['endereco'] = $request->endereco;
        $vender['bairro'] = $request->bairro;
        $vender['cep'] = $request->cep;
        $vender['cidade'] = $request->cidade;
        $vender['uf'] = $request->estado;
        $vender['num'] = $request->num;

        if($vender->save())
        {
            return redirect()->back()->with("success", "Mensagem Enviada com sucesso");
        }
        else
        {
            return redirect()->back()->with("success", "Erro ao enviar o agendamento");
        }
    }
}
