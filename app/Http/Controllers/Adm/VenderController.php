<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VenderController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        return view('adm.vender.vender-create', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function store(Request $request)
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

        if ($vender->save()) {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }

    public function show()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        return view('adm.vender.vender-show', array(
            'clienteCount' => count($clientes),
            'clientes' => $clientes,
            'contatoCount' => count($contato),
        ));
    }

    public function edit($id)
    {
        $vender = Venda::find($id);
        $clientesAll = Cliente::all();
        $contato = Contato::all();

        return view('adm.vender.vender-edit', array(
            'clienteCount' => count($clientesAll),
            'contatoCount' => count($contato),
            'vender' => $vender,
        ));
    }

    public function update(Request $request, $id)
    {
        $vender = Venda::find($id);
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

        if ($vender->save()) {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }

    }

    public function getData()
    {
        $vender = Venda::all();
        return response()->json($vender);
    }

    public function delete(Request $request, $id)
    {
        $vender = Venda::find($id);
        if ($vender->delete()) {
            $message = "Item excluído com sucesso!";
            return response()->json($message);
        } else {
            $message = "Erro ao excluir este ítem!";
            return response()->json($message);
        }
    }

    public function ajaxDataVender(Request $request)
    {
        $vender = Venda::where("nome", "like", "%" . $request->input . "%")
            ->orWhere("email", "like", "%" . $request->input . "%")->get();

        if (count($vender) < 1) {
            $vender = Venda::all();
        }
        return response()->json($vender);

    }
}
