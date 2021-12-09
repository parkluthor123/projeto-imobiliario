<?php

namespace App\Http\Controllers\Adm;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Bairro;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Estado;
use App\Models\ImagemImovel;
use App\Models\Imovel;
use App\Models\TipoImovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImoveisController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        $estados = Estado::get();
        $bairro = Bairro::get();
        $tipoimovel = TipoImovel::get();

        return view('adm.imoveis.imoveis-create', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'estados' => $estados,
            'bairro' => $bairro,
            'tipoImovel' => $tipoimovel,
        ));
    }

    public function show()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.imoveis.imoveis-show', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function store(Request $request)
    {
        $imoveis = new Imovel();
        $tipoImovel = TipoImovel::where('id', '=', $request->categoria)->first();
        $estado = Estado::where('id', '=', $request->estado)->first();
        $bairro = Bairro::where('id', '=', $request->bairro)->first();

        $messages = [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'phone.required' => 'O telefone é obrigatório',
            'cpf.required' => 'O cpf é obrigatório',
            'descricao.required' => 'A descrição é obrigatório',
            'endereco.required' => 'O endereço é obrigatório',
            'cidade.required' => 'A cidade é obrigatória',
            'estado.required' => 'O estado é obrigatória',
            'valor.required' => 'É obrigatório ter um valor',
            'm_quadrados.required' => 'Os metros quadrados são obrigatórios',
            'qtd_quartos.required' => 'A quantidade de quarto é obrigatória',
            'cep.required' => 'O CEP é obrigatório',
            'bairro.required' => 'O bairro é obrigatório',
            'sendImage[].required' => 'As imagens do imóvel são obrigatórias',
            'sendImage[].mimes' => 'As imagens precisam estar no formato .jpeg, .png ou .webp',
        ];

        $validated = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'valor' => 'required',
            'descricao' => 'required',
            'm_quadrados' => 'required',
            'qtd_quartos' => 'required',
            'estado' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
        ], $messages);

        $imoveis['nome'] = $request->nome;
        $imoveis['email'] = $request->email;
        $imoveis['phone'] = $request->phone;
        $imoveis['cpf'] = $request->cpf;
        $imoveis['num'] = $request->num;
        $imoveis['endereco'] = $request->endereco;
        $imoveis['cep'] = $request->cep;
        $imoveis['id_bairros'] = $request->bairro;
        $imoveis['cidade'] = $request->cidade;
        $imoveis['valor'] = Helper::formatCurrency($request->valor);
        $imoveis['sobre'] = $request->sobre;
        $imoveis['id_tipo_imovel'] = $request->categoria;
        $imoveis['status'] = $request->options_imovel;
        $imoveis['descricao'] = $request->descricao;
        $imoveis['url_imovel'] = Helper::getUrl("imovel-{$request->num}-{$tipoImovel->tipo}-{$request->endereco}-{$estado->estados}-{$bairro->bairros}-{$request->options_imovel}-{$request->cep}-{$request->qtd_quartos}m2");
        $imoveis['metros_quadrados'] = $request->m_quadrados;
        $imoveis['qtd_quartos'] = $request->qtd_quartos;
        $imoveis['id_estados'] = $request->estado;
        $imoveis['link_map'] = $request->mapLink;

        if($imoveis->save()) {
//            if ($request->hasFile('sendImage')) {
//
//                for ($i = 0; $i < count($request->allFiles()['sendImage']); $i++) {
//                    $image = new ImagemImovel();
//                    $image['id_imoveis'] = $imoveis->id;
//                    $filename = time(). "-" . $request->allFiles()['sendImage'][$i]->getClientOriginalName();
//                    $filePath = $request->allFiles()['sendImage'][$i]->storeAs('images_imoveis', $filename, 'public');
//                    $image['image'] = "/storage/" . $filePath;
//                    $image->save();
//                    unset($image);
//                }
//            }
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }


    public function getData()
    {
        $imoveis = Imovel::all();
        return response()->json($imoveis);
    }


    public function edit($id)
    {
        $imoveis = Imovel::find($id);
        $clientesAll = Cliente::all();
        $contato = Contato::all();
        $estados = Estado::get();
        $bairro = Bairro::get();
        $tipoimovel = TipoImovel::get();
        $tipoImovelSelected = TipoImovel::where('id', '=', $imoveis->id_tipo_imovel)->first();

        $ufSelected = DB::table('estados')
            ->join("imovels", "estados.id", "=", "imovels.id_estados")->first();

        $bairroSelected = DB::table('bairros')
            ->join("imovels", "bairros.id", "=", "imovels.id_bairros")->first();

        return view('adm.imoveis.imoveis-edit', array(
            'clienteCount' => count($clientesAll),
            'contatoCount' => count($contato),
            'imoveis' => $imoveis,
            'estados' => $estados,
            'bairro' => $bairro,
            'ufSelected' => $ufSelected,
            'bairroSelected' => $bairroSelected,
            'tipoImovelSelected' => $tipoImovelSelected,
            'tipoImovel' => $tipoimovel,
        ));
    }

    public function update(Request $request, $id)
    {
        $imoveis = Imovel::find($id);
        $tipoImovel = TipoImovel::where('id', '=', $request->categoria)->first();
        $estado = Estado::where('id', '=', $request->estado)->first();
        $bairro = Bairro::where('id', '=', $request->bairro)->first();


        $messages = [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'phone.required' => 'O telefone é obrigatório',
            'cpf.required' => 'O cpf é obrigatório',
            'descricao.required' => 'A descricao é obrigatória',
            'endereco.required' => 'O endereço é obrigatório',
            'cidade.required' => 'A cidade é obrigatória',
            'valor.required' => 'É obrigatório ter um valor',
            'm_quadrados.required' => 'Os metros quadrados são obrigatórios',
            'qtd_quartos.required' => 'A quantidade de quarto é obrigatória',
            'cep.required' => 'O CEP é obrigatório',
            'sendImage[].required' => 'As imagens do imóvel são obrigatórias',
            'sendImage[].mimes' => 'As imagens precisam estar no formato .jpeg, .png ou .webp',
//            'sendImage[].max' => 'As imagens precisam ter o tamanho máximo 10000 MB',
        ];

        $validated = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'valor' => 'required',
            'descricao' => 'required',
            'm_quadrados' => 'required',
            'qtd_quartos' => 'required',
            'cep' => 'required',
        ], $messages);

        $imoveis['nome'] = $request->nome;
        $imoveis['email'] = $request->email;
        $imoveis['phone'] = $request->phone;
        $imoveis['cpf'] = $request->cpf;
        $imoveis['num'] = $request->num;
        $imoveis['endereco'] = $request->endereco;
        $imoveis['cep'] = $request->cep;
        $imoveis['id_bairros'] = $request->bairro;
        $imoveis['cidade'] = $request->cidade;
        $imoveis['valor'] = Helper::formatCurrency($request->valor);
        $imoveis['sobre'] = $request->sobre;
        $imoveis['id_tipo_imovel'] = $request->categoria;
        $imoveis['status'] = $request->options_imovel;
        $imoveis['descricao'] = $request->descricao;
        $imoveis['url_imovel'] = Helper::getUrl("imovel-{$request->num}-{$tipoImovel->tipo}-{$request->endereco}-{$estado->estados}-{$bairro->bairros}-{$request->options_imovel}-{$request->cep}-{$request->qtd_quartos}m2");
        $imoveis['metros_quadrados'] = $request->m_quadrados;
        $imoveis['qtd_quartos'] = $request->qtd_quartos;
        $imoveis['id_estados'] = $request->estado;
        $imoveis['link_map'] = $request->mapLink;

        if($imoveis->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }


    public function delete(Request $request, $id)
    {

        $imoveis = DB::table('imovels')
            ->join("imagem_imovels", "imovels.id", "=", "imagem_imovels.id_imoveis")
            ->where("imagem_imovels.id_imoveis", $id)->get();

        if(count($imoveis) > 0)
        {
            $imoveis = DB::table('imovels')
                ->join("imagem_imovels", "imovels.id", "=", "imagem_imovels.id_imoveis")
                ->where("imagem_imovels.id_imoveis", $id);

            foreach ($imoveis->get() as $data)
            {
                if(File::exists(public_path().$data->image))
                {
                    File::delete(public_path().$data->image);
                }

                if(File::exists(public_path().$data->image_original))
                {
                    File::delete(public_path().$data->image_original);
                }
            }

            if($imoveis->delete())
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
            $imoveis = DB::table('imovels')->where('id', $id);
            if($imoveis->delete())
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


    public function images($id)
    {
        $imoveis = Imovel::find($id);
        $clientesAll = Cliente::all();
        $contato = Contato::all();
        $images = ImagemImovel::where("id_imoveis", "=", $id)->get();

        return view('adm.imoveis.images', array(
            'clienteCount' => count($clientesAll),
            'contatoCount' => count($contato),
            'imoveis' => $imoveis,
            'images' => $images,
        ));
    }

    public function getImages($id)
    {
        $images = ImagemImovel::where('id_imoveis', '=', $id)->get();
        return response()->json($images);
    }


    public function getEstados(Request $request)
    {
        $bairros = Bairro::where("id_estados", "=", $request->estado)->get();
        return response()->json($bairros);
    }


    public function imagesStore(Request $request, $id)
    {
        $image = new ImagemImovel();


        $croppedImage = preg_replace('#^data:image/[^;]+;base64,#', '', $request->data);
        $data = base64_decode($croppedImage, true);
        $imgCropped = imagecreatefromstring($data);
        $path = '/storage/imageUploaded/cropped/'.time().$request->fullName.rand(5, 15)."-cropped.webp";
        imagewebp($imgCropped, public_path().$path, 50);
        $image['image'] = $path;

        if($image['image'] != '')
        {
            $originalImage = preg_replace('#^data:image/[^;]+;base64,#', '', $request->originalImage);
            $originalImageBase64 = base64_decode($originalImage, true);
            $originalClientImage = imagecreatefromstring($originalImageBase64);
            $pathOriginal = '/storage/imageUploaded/'.time().$request->fullName.rand(5, 15)."-fullscreen.png";
            imagepng($originalClientImage, public_path().$pathOriginal, 0);
            $image['image_original'] = $pathOriginal;
            $image['id_imoveis'] = $id;

            if($image->save())
            {
                $message = "Informações salvas com sucesso";
                return response()->json($message);
            }
            else
            {
                $message = "Erro ao salvar as informações";
                return response()->json($message);
            }
        }
    }

    public function imageDelete(Request $request,$id)
    {
        $images = DB::table("imagem_imovels")->where("id", $id);

        if(File::exists(public_path().$images->first()->image) && File::exists(public_path().$images->first()->image_original))
        {
            File::delete(public_path().$images->first()->image);
            File::delete(public_path().$images->first()->image_original);
        }
        if($images->delete())
        {
            $message = "Item excluído com sucesso!";
            return response()->json($message);
        }
    }

    //    Campo de busca por ajax
    public function ajaxDataImoveis(Request $request)
    {
        $imoveis = Imovel::where("nome", 'like', "%".$request->input."%")
            ->orWhere("cpf", 'like', "%".$request->input."%")->get();
        if(count($imoveis) < 1)
        {
            $imoveis = Imovel::all();
        }
        return response()->json($imoveis);
    }

}
