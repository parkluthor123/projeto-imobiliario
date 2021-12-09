<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Contato;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    //
    public function index()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.agendamento.agendamento-show', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.agendamento.agendamento-create', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function store(Request $request)
    {
        $agendamento = new Agendamento();

        $validated = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'tipo' => 'required',
        ]);

        $agendamento['nome'] = $request->nome;
        $agendamento['email'] = $request->email;
        $agendamento['phone'] = $request->phone;
        $agendamento['tipo_contato'] = $request->tipo;
        $agendamento['status'] = 1;

        if($agendamento->save())
        {
            return redirect()->back()->with("success", "Agendamento salvo com sucesso");
        }
        else
        {
            return redirect()->back()->with("success", "Erro ao salvar o agendamento");
        }
    }

    public function getAgendamento()
    {
        $agendamento = Agendamento::all();
        return response()->json($agendamento);
    }

    public function edit($id)
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        $agendamento = Agendamento::find($id);

        return view('adm.agendamento.agendamento-edit', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'agendamento' => $agendamento,
        ));
    }

    public function update(Request $request, $id)
    {
        $agendamento = Agendamento::find($id);

        $validated = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'tipo' => 'required',
        ]);

        $agendamento['nome'] = $request->nome;
        $agendamento['email'] = $request->email;
        $agendamento['phone'] = $request->phone;
        $agendamento['tipo_contato'] = $request->tipo;

        if($agendamento->save())
        {
            return redirect()->back()->with("success", "Agendamento salvo com sucesso");
        }
        else
        {
            return redirect()->back()->with("success", "Erro ao salvar o agendamento");
        }
    }

    public function delete(Request $request, $id)
    {
        $agendamento = Agendamento::find($id);

        if($agendamento->delete())
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

    public function ajaxDataAgendamentos(Request $request)
    {
        $agendamento = Agendamento::where("nome", 'like', "%".$request->input."%")
            ->orWhere("email", 'like', "%".$request->input."%")->get();
        if(count($agendamento) < 1)
        {
            $agendamento = Agendamento::all();
        }
        return response()->json($agendamento);
    }

    public function agendamentosStatus(Request $request)
    {
        $agendamento = Agendamento::find($request->id);
        $agendamento['status'] = 1;

        if($agendamento->save())
        {
            return response()->json(200);
        }
    }
}
