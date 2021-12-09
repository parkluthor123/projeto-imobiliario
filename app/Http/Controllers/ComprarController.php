<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Bairro;
use App\Models\Estado;
use App\Models\Imovel;
use App\Models\TipoImovel;
use Illuminate\Http\Request;

class ComprarController extends Controller
{
    public function index()
    {
        $imovel = Imovel::with('getImages')->where('status', '=', 'comprar')->paginate(6);

        $tipo = TipoImovel::get();
        return view('pages.comprar', array(
            'imovel' => $imovel,
            'tipo' => $tipo,
        ));
    }

    public function searchUf($uf, $bairro)
    {
        $estado = Estado::where('url_estado', '=', $uf)->first();
        $bairro = Bairro::where('url_bairro', '=', $bairro)->first();

        $imoveis = Imovel::with('getImages')
            ->where('id_estados', '=', $estado->id)
            ->where('id_bairros', '=', $bairro->id)
            ->get();

        return view('pages.comprar-pesquisa.comprar-pesquisa', array(
            'imoveis' => $imoveis,
            'estado' => $estado,
        ));
    }

    public function imovelOverview($url)
    {
        $imovel = Imovel::where('url_imovel', '=', $url)->with('getImages')->first();
        $qtdImages = count($imovel->getImages()->get());
        return view('pages.comprar-overview.comprar-overview', array(
            'imoveis' => $imovel,
            'qtdImages' => $qtdImages,
        ));
    }

    public function sendAgendamento(Request $request)
    {
        $agendamento = new Agendamento();

        $validated = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'tipo_contato' => 'required',
        ]);

        $agendamento['nome'] = $request->nome;
        $agendamento['email'] = $request->email;
        $agendamento['phone'] = $request->phone;
        $agendamento['tipo_contato'] = $request->tipo_contato;
        $agendamento['status'] = 0;

        if($agendamento->save())
        {
            return redirect()->back()->with("success", "Mensagem Enviada com sucesso");
        }
        else
        {
            return redirect()->back()->with("success", "Erro ao enviar o agendamento");
        }
    }

    public function searchImoveis(Request $request)
    {

        $imovel = Imovel::with('getImages', 'getBairro', 'getEstado')
            ->where('status', '=', $request->switch)
            ->where('id_tipo_imovel', '=', $request->tipoImovel)
            ->where('cidade', 'like', "%".$request->local."%")
            ->orWhere('qtd_quartos', '=', $request->qtd)
            ->get();

        return response()->json($imovel);
    }
}
