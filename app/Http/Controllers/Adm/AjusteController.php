<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Ajuste;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\MetaTag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AjusteController extends Controller
{
    //
    public function show()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        $metatags = MetaTag::get();
        $ajustes = Ajuste::get()->first();

        return view('adm.ajustes.ajustes', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'metatags' => $metatags,
            'ajustes' => $ajustes,
        ));
    }

    public function showContato()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        $data = Ajuste::find(Auth::guard('web')->id())->first();

        return view('adm.ajustes.ajustes-contato', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'numero' => $data,
        ));
    }

    public function contatoStore(Request $request)
    {
        $data = Ajuste::find(Auth::guard('web')->id());
        $data['topbar_num'] = $request->topbarNum;
        $data['footer_num1'] = $request->num1;
        $data['footer_num2'] = $request->num2;

        if($data->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }

    public function showSocialMedia()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        $data = Ajuste::find(Auth::guard('web')->id())->first();

        return view('adm.ajustes.ajustes-redes-sociais', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'links' => $data,
        ));
    }

    public function socialMediaStore(Request $request)
    {
        $data = Ajuste::find(Auth::guard('web')->id());
        $data['facebook'] = $request->link_facebook;
        $data['facebook_title'] = $request->facebook;
        $data['linkedin'] = $request->link_linkedin;
        $data['linkedin_title'] = $request->linkedin;
        $data['instagram'] = $request->link_instagram;
        $data['instagram_title'] = $request->instagram;
        if($data->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }

    public function enderecoStore(Request $request)
    {
        $ajustes = Ajuste::find(1);
        $ajustes['endereco'] = $request->endereco;
        $ajustes['link_endereco'] = $request->link_endereco;
        $ajustes['iframe'] = $request->iframe;

        if($ajustes->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
        else
        {
            return redirect()->back()->with("success", "Erro ao salvar informações");
        }
    }

    public function userConf()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.ajustes.user-conf-create', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
        ));
    }

    public function showUserConf()
    {
        $clientes = Cliente::all();
        $contato = Contato::all();
        $users = User::all();

        return view('adm.ajustes.user-conf-show', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'users' => $users,
        ));
    }


    public function getUsers()
    {
        $users = User::get();
        return response()->json($users);
    }

    public function userConfStore(Request $request)
    {
        $user = new User();

        $messages = [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'conf_senha.same' => 'Os campos senha precisam ser idênticos',
            'password.required' => 'O campo senha é obrigatório'
        ];

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'conf_senha' => 'same:password',
        ], $messages);

        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['password'] = Hash::make($request->password);

        if($user->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }


    public function editUserConf($id)
    {
        $users = User::find($id);
        $clientes = Cliente::all();
        $contato = Contato::all();

        return view('adm.ajustes.user-conf-edit', array(
            'clienteCount' => count($clientes),
            'contatoCount' => count($contato),
            'users' => $users,
        ));
    }

    public function userConfUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $messages = [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'conf_senha.same' => 'Os campos senha precisam ser idênticos',
        ];

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'conf_senha' => 'same:password',
        ], $messages);

        $user['name'] = $request->name;
        $user['email'] = $request->email;
        if(strlen($request->password) > 1)
        {
            $user['password'] = Hash::make($request->password);
        }

        if($user->save())
        {
            return redirect()->back()->with("success", "Informações salvas com sucesso");
        }
    }


    public function userConfDelete(Request $request, $id)
    {
        $user = User::find($id);

        if($user->delete())
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

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('adm.login');
    }
}
