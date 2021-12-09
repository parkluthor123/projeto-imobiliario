<?php

namespace App\Http\Controllers\Adm;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Boleto;
use App\Models\Contrato;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.clientes.clientes-create', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }


    public function store(Request $request)
    {
        $cliente = new Cliente();
        $boleto = new Boleto();
        $contrato = new Contrato();

        $messages = [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'phone.required' => 'O telefone é obrigatório',
            'conf_senha.same' => 'Os campos senha precisam ser idênticos',
            'password.required' => 'É necessário possuir uma senha',
            'cpf.required' => 'O cpf é obrigatório',
            'renda.required' => 'A renda é obrigatória',
            'endereco.required' => 'O endereço é obrigatório',
            'cidade.required' => 'A cidade é obrigatória',
            'estado.required' => 'O estado é obrigatória',
            'cep.required' => 'O CEP é obrigatório',
            'bairro.required' => 'O bairro é obrigatório',
            'cadBoleto.required' => 'O Arquivo de boleto precisa ser no formato PDF',
            'cadContrato.required' => 'O Arquivo de contrato precisa ser no formato PDF',
        ];

        $validated = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'conf_senha' => 'same:password',
            'cpf' => 'required',
            'renda' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
            'cadBoleto' => 'required|mimes:pdf',
            'cadContrato' => 'required|mimes:pdf',
        ], $messages);

        $cliente['name'] = $request->nome;
        $cliente['cpf'] = $request->cpf;
        $cliente['email'] = $request->email;
        $cliente['password'] = Hash::make($request->password);
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
            $boleto['data_boleto'] = Helper::getDate($request->dataBoleto);
            $boleto['descricao_boleto'] = $request->descBoleto;
            $boleto['id_cliente'] = $cliente->id;

            $contrato['data_contrato'] = Helper::getDate($request->dataContrato);
            $contrato['descricao_contrato'] = $request->descContrato;;
            $contrato['id_cliente'] = $cliente->id;

            if($request->file('cadBoleto'))
            {
                $filename = time()."-".$request->file('cadBoleto')->getClientOriginalName();
                $filePath = $request->file('cadBoleto')->storeAs('boletos', $filename, 'public');
                $boleto['mensalidade'] = "/storage/".$filePath;
            }

            if($request->file('cadContrato'))
            {
                $filename = time()."-".$request->file('cadContrato')->getClientOriginalName();
                $filePath = $request->file('cadContrato')->storeAs('contratos', $filename, 'public');
                $contrato['contrato'] = "/storage/".$filePath;
            }

           if($boleto->save() && $contrato->save())
           {
               return redirect()->back()->with("success", "Informações salvas com sucesso");
           }
        }
        else
        {
            return redirect()->back()->with("success", "Erro ao salvar as informações");
        }
    }


    public function show()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        return view('adm.clientes.clientes-show', array(
            'clienteCount' => count($clientes),
            'clientes' => $clientes,
            'contatoCount' => count($contato),
        ));
    }

    public function edit($id)
    {
        $clientes = Cliente::find($id);
        $clientesAll = Cliente::all();
        $contato = Contato::all();

        return view('adm.clientes.clientes-edit', array(
            'clienteCount' => count($clientesAll),
            'contatoCount' => count($contato),
            'clientes' => $clientes,
        ));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $messages = [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'phone.required' => 'O telefone é obrigatório',
            'conf_senha.same' => 'Os campos senha precisam ser idênticos',
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
            'conf_senha' => 'same:password',
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
        if(strlen($request->password) > 1)
        {
            $cliente['password'] = Hash::make($request->password);
        }
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

//    Pega os dados dos clientes no banco
    public function getData()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }


//    Apaga o cliente e o boleto
    public function delete(Request $request, $id)
    {

        $clientes = DB::table('clientes')
            ->join("boletos", "clientes.id", "=", "boletos.id_cliente")
            ->join("contratos", "clientes.id", "=", "contratos.id_cliente")
            ->where("boletos.id_cliente", $id)
            ->where("contratos.id_cliente", $id)->get();

        if(count($clientes) > 0)
        {
            $clientes = DB::table('clientes')
                ->join("boletos", "clientes.id", "=", "boletos.id_cliente")
                ->join("contratos", "clientes.id", "=", "contratos.id_cliente")
                ->where("boletos.id_cliente", $id)
                ->where("contratos.id_cliente", $id);

            foreach ($clientes->get() as $data)
            {
                if(File::exists(public_path().$data->mensalidade))
                {
                    File::delete(public_path().$data->mensalidade);
                }

                if(File::exists(public_path().$data->contrato))
                {
                    File::delete(public_path().$data->contrato);
                }
            }

            if($clientes->delete())
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
        else
        {
            $clientes = DB::table('clientes')
                ->join("boletos", "clientes.id", "=", "boletos.id_cliente")
                ->where("boletos.id_cliente", $id)->get();

            if(count($clientes) > 0)
            {
                $clientes = DB::table('clientes')
                    ->join("boletos", "clientes.id", "=", "boletos.id_cliente")
                    ->where("boletos.id_cliente", $id);

                foreach ($clientes->get() as $data)
                {
                    if(File::exists(public_path().$data->mensalidade))
                    {
                        File::delete(public_path().$data->mensalidade);
                    }
                }

                if($clientes->delete())
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
            else
            {
                $clientes = DB::table('clientes')
                    ->join("contratos", "clientes.id", "=", "contratos.id_cliente")
                    ->where("contratos.id_cliente", $id);

                foreach ($clientes->get() as $data)
                {
                    if(File::exists(public_path().$data->contrato))
                    {
                        File::delete(public_path().$data->contrato);
                    }
                }

                if($clientes->delete())
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
        }
    }

//  Página de mensalidades
    public function mensalidadeIndex($id)
    {
        $clientesId = Cliente::find($id);
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.clientes.mensalidade', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'clientes' => $clientesId,
        ));
    }

    public function cadastrarBoletoModal(Request $request, $id)
    {
        $clientes = Cliente::find($id);

        $messages = [
            'data.required' => 'A data é obrigatória',
            'descricao.required' => 'A descrição é obrigatória',
            'mensalidade.required' => 'O PDF do boleto é obrigatório',
        ];

        $validated = $request->validate([
            'data' => 'required',
            'descricao' => 'required',
            'mensalidade' => 'required|mimes:pdf',
        ], $messages);

        $boleto = new Boleto();
        $boleto['data_boleto'] = $request->data;
        $boleto['descricao_boleto'] = $request->descricao;
        $boleto['id_cliente'] = $clientes->id;

        if($request->file('mensalidade'))
        {
            $filename = time()."-".$request->file('mensalidade')->getClientOriginalName();
            $filePath = $request->file('mensalidade')->storeAs('boletos', $filename, 'public');
            $boleto['mensalidade'] = "/storage/".$filePath;
        }
        if($boleto->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }

//    Response que está trazendo os dados do banco relacionado aos boletos
    public function getMensalidades($id)
    {
        $mensalidade = DB::table("boletos")
            ->select(DB::raw("*, DATE_FORMAT(data_boleto,'%d/%m/%Y') AS dateFinal"))
            ->where("id_cliente", $id)->get();

        return response()->json($mensalidade);
    }

//    Função para deletar o boleto
    public function deleteMensalidade(Request $request, $id)
    {
        $boletos = DB::table("boletos")->where("id", $id);

        if(File::exists(public_path().$boletos->first()->mensalidade))
        {
            File::delete(public_path().$boletos->first()->mensalidade);
        }
        if($boletos->delete())
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

    public function contratosIndex($id)
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        $clientesId = Cliente::find($id);

        return view('adm.clientes.contratos', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'clientes' => $clientesId,
        ));
    }

    public function getContrato($id)
    {
        $contratos = DB::table("contratos")
            ->select(DB::raw("*, DATE_FORMAT(data_contrato,'%d/%m/%Y') AS dateFinal"))
            ->where("id_cliente", $id)->get();

        return response()->json($contratos);
    }

//    Cadastrar modal contrato
    public function cadastrarContratoModal(Request $request, $id)
    {
        $clientes = Cliente::find($id);

        $messages = [
            'data.required' => 'A data é obrigatória',
            'descricao.required' => 'A descrição é obrigatória',
            'contrato.required' => 'O PDF do contrato é obrigatório',
        ];

        $validated = $request->validate([
            'data' => 'required',
            'descricao' => 'required',
            'contrato' => 'required|mimes:pdf',
        ], $messages);

        $contratos = new Contrato();
        $contratos['data_contrato'] = $request->data;
        $contratos['descricao_contrato'] = $request->descricao;
        $contratos['id_cliente'] = $clientes->id;

        if($request->file('contrato'))
        {
            $filename = time()."-".$request->file('contrato')->getClientOriginalName();
            $filePath = $request->file('contrato')->storeAs('contratos', $filename, 'public');
            $contratos['contrato'] = "/storage/".$filePath;
        }
        if($contratos->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }

// Deleta o contrato existente
    public function deleteContrato(Request $request, $id)
    {
        $contratos = DB::table("contratos")->where("id", $id);

        if(File::exists(public_path().$contratos->first()->contrato))
        {
            File::delete(public_path().$contratos->first()->contrato);
        }
        if($contratos->delete())
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

//    Campo de busca por ajax
    public function ajaxDataClientes(Request $request)
    {
        $cliente = Cliente::where("name", 'like', "%".$request->input."%")
            ->orWhere("cpf", 'like', "%".$request->input."%")->get();
        if(count($cliente) < 1)
        {
            $cliente = Cliente::all();
        }
        return response()->json($cliente);
    }


    public function buscaCliente(Request $request)
    {
        $busca = Cliente::where('name', 'like', '%'.$request->buscar.'%')
            ->orWhere("cpf", 'like', '%'.$request->buscar.'%')->get();

        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.clientes.clientes-busca', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'busca' => $busca,
        ));
    }
}
