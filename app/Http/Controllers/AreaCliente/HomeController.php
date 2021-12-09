<?php

namespace App\Http\Controllers\AreaCliente;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function index()
    {
        $user = Auth::guard('clientes')->user();
        return view('pages.area-restrita.home', array(
            'users' => $user,
        ));
    }

    public function info()
    {
        $user = Auth::guard('clientes')->user();
        return view('pages.area-restrita.info', array(
            'user' => $user,
        ));
    }

    public function infoChangePassword(Request $request)
    {
        $user = Auth::guard('clientes')->user();
        $cliente = Cliente::find($user->id);

        if(!Hash::check($request->atualSenha, $user['password']))
        {
            return response()->json([
                'senha_incorreta' => 'A senha atual está incorreta',
            ]);
        }
        else
        {
            $messages = [
                'confSenha.same' => 'Os campos senha precisam ser idênticos',
            ];

            $validator = Validator::make($request->all(), [
                'confSenha' => 'same:novaSenha',
            ], $messages);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 200);
            }
            else
            {
                $cliente['password'] = Hash::make($request->novaSenha);
                if($cliente->save())
                {
                    $message = [
                        "success" => "Senha atualizada com sucesso",
                    ];
                    return response()->json($message);
                }
            }
        }

    }

    public function infoSaveData(Request $request)
    {
        $user = Auth::guard('clientes')->user();
        $cliente = Cliente::find($user->id);
        $messages = [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'phone.required' => 'O telefone é obrigatório',
            'cpf.required' => 'O cpf é obrigatório',
            'renda.required' => 'A renda é obrigatória',
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
            'cpf' => 'required',
            'renda' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
        ], $messages);

        $cliente['name'] = $request->nome;
        $cliente['cpf'] = $request->cpf;
        $cliente['email'] = $request->email;
        $cliente['renda'] = $request->renda;
        $cliente['phone'] = $request->phone;
        $cliente['endereco'] = $request->endereco;
        $cliente['bairro'] = $request->bairro;
        $cliente['cep'] = $request->cep;
        $cliente['cidade'] = $request->cidade;
        $cliente['uf'] = $request->estado;
        $cliente['num'] = $request->num;

        if($cliente->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }

//  Response que está trazendo os dados do banco relacionado aos boletos
    public function faturas()
    {
        $id = Auth::guard('clientes')->id();
        $mensalidade = DB::table("boletos")
            ->select(DB::raw("*, DATE_FORMAT(data_boleto,'%d/%m/%Y') AS dateFinal"))
            ->where("id_cliente", $id)->get();

        return view('pages.area-restrita.faturas', array(
            'mensalidade' => $mensalidade,
        ));
    }


    public function contratos()
    {
        $id = Auth::guard('clientes')->id();

        $contratos = DB::table("contratos")
            ->select(DB::raw("*, DATE_FORMAT(data_contrato,'%d/%m/%Y') AS dateFinal"))
            ->where("id_cliente", $id)->get();

        return view('pages.area-restrita.contratos', array(
            'contratos' => $contratos
        ));
    }

}
