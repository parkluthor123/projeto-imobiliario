<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cliente;
use App\Models\Contato;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.banners.banner-create', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function bannerStore(Request $request)
    {
        $banner = new Banner();

        $image = preg_replace('#^data:image/[^;]+;base64,#', '', $request->imagem);
        $decodedImage = base64_decode($image, true);
        $newImage = imagecreatefromstring($decodedImage);
        $path = '/storage/banners/'.time().str_replace(" ", "-", $request->descricao).rand(5, 15)."-cropped.webp";
        imagewebp($newImage, public_path().$path, 100);

        $banner['image'] = $path;
        $banner['description'] = $request->descricao;
        $banner['link'] = $request->link;

        if($banner->save())
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

    public function bannerShow()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.banners.banner-show', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function bannerEdit($id)
    {
        $banner = Banner::find($id);
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.banners.banner-edit', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'banner' => $banner
        ));
    }

    function bannerUpdate(Request $request, $id)
    {
        $banner = Banner::find($id);

        if($request->imagem !== '')
        {
            if(File::exists(public_path().$banner->image))
            {
                File::delete(public_path().$banner->image);
            }

            $image = preg_replace('#^data:image/[^;]+;base64,#', '', $request->imagem);
            $decodedImage = base64_decode($image, true);
            $newImage = imagecreatefromstring($decodedImage);
            $path = '/storage/banners/'.time().str_replace(" ", "-", $request->descricao).rand(5, 15)."-cropped.webp";
            imagewebp($newImage, public_path().$path, 100);
            $banner['image'] = $path;
        }

        $banner['description'] = $request->descricao;
        $banner['link'] = $request->link;

        if($banner->save())
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

    public function bannerDelete(Request $request, $id)
    {
        $banner = Banner::find($id);

        if($banner->delete())
        {
            if(File::exists(public_path().$banner->image))
            {
                File::delete(public_path().$banner->image);
            }
            $message = "Item excluído com sucesso!";
            return response()->json($message);
        }
        else
        {
            $message = "Erro ao excluir este ítem!";
            return response()->json($message);
        }
    }



    public function getBanner()
    {
        $banner = Banner::all();
        return response()->json($banner);
    }
}
