<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuemSomosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\ComprarController;
use App\Http\Controllers\VenderController;
use Illuminate\Support\Facades\Auth;
//Area Restrita Models
use App\Http\Controllers\AreaCliente\LoginController;
use App\Http\Controllers\AreaCliente\HomeController as HomeAreaCliente;
use \App\Http\Middleware\clienteAuth;
use \App\Http\Middleware\verifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AreaCliente\EmailVerificationController;
//Área ADM Models
use App\Http\Controllers\Adm\LoginController as AdmLogin;
use App\Http\Controllers\Adm\HomeController as AdmHome;
use App\Http\Controllers\Adm\ClienteController;
use App\Http\Controllers\Adm\ContatoController as AdmContatoController;
use App\Http\Controllers\Adm\VenderController as AdmVenderController;
use App\Http\Controllers\Adm\ImoveisController;
use App\Http\Controllers\Adm\MetaTagController;
use App\Http\Controllers\Adm\AjusteController;
use App\Http\Controllers\Adm\BannerController;
use App\Http\Controllers\Adm\LocalidadeController;
use App\Http\Controllers\Adm\TipoImovelController;
use App\Http\Controllers\Adm\AgendamentoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//---- Site Routes------

//HOME
Route::get("/", [HomeController::class, 'index'])->name("goHome");
Route::post('/home/ajax-estados', [HomeController::class, 'getEstados'])->name('home.estados.ajax');

//QUEM SOMOS
Route::get("/quem-somos", [QuemSomosController::class, 'index'])->name("goQuemSomos");

//COMPRAR - OVERVIEW
Route::get('/comprar', [ComprarController::class, 'index'])->name('goComprar');
Route::get('/comprar/{uf}/{bairro}', [ComprarController::class, 'searchUf'])->name('comprar.pesquisa.estado');
Route::get('/comprar/{url}', [ComprarController::class, 'imovelOverview'])->name('comprar.overview');
Route::post('/comprar/entrar-em-contato', [ComprarController::class, 'sendAgendamento'])->name('comprar.overview.send');
Route::post('/imoveis-search', [ComprarController::class, 'searchImoveis'])->name('comprar.searchImoveis');

//CONTATO
Route::get("/contato", [ContatoController::class, 'index'])->name('goContato');
Route::post("/contato/send-data", [ContatoController::class, 'sendData'])->name('contato.sendData');

//VENDER
Route::get("/vender", [VenderController::class, 'index'])->name('goVender');
Route::post("/vender/send-data", [VenderController::class, 'sendData'])->name('vender.send');

//Area restrita Routes
Route::get("/entrar", [LoginController::class, 'index'])->name("area-restrita.login")->middleware('redirect-logged');
Route::post('/entrar/do', [LoginController::class, 'login'])->name('area-restrita.do')->middleware('redirect-logged');
Route::get('/criar-conta', [LoginController::class, 'criar'])->name('area-restrita.register')->middleware('redirect-logged');
Route::post('/criar-conta/criar', [LoginController::class, 'criarConta'])->name('area-restrita.register.do')->middleware('redirect-logged');

//Middleware pra autenticação da área restrita
Route::middleware([clienteAuth::class, 'middleware' => 'prevent-back-history'])->group(function (){
    Route::get('/area-restrita/contratos', [HomeAreaCliente::class, 'contratos'])->name('area-restrita.contratos');
    Route::get('/area-restrita/faturas', [HomeAreaCliente::class, 'faturas'])->name('area-restrita.faturas');
    Route::post('/area-restrita/informacoes-pessoais/trocar-senha', [HomeAreaCliente::class, 'infoChangePassword'])->name('area-restrita.info.trocarSenha');
    Route::get('/area-restrita/informacoes-pessoais', [HomeAreaCliente::class, 'info'])->name('area-restrita.info');
    Route::post('/area-restrita/informacoes-pessoais', [HomeAreaCliente::class, 'infoSaveData'])->name('area-restrita.info.do');
    Route::get("/area-restrita", [HomeAreaCliente::class, 'index'])->name("area-restrita.home");
    Route::get("/sair", [LoginController::class, 'sair'])->name("area-restrita.sair");
});

Route::get('/criar-conta/confirmar-email', [EmailVerificationController::class, 'show'])
    ->name('verification.notice')
    ->middleware(verifyEmail::class);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware([verifyEmail::class, 'signed'])->name('verification.verify');

//Área ADM routes

Route::middleware(['middleware' => 'adm-redirect-logged','prevent-back-history'])->group(function(){
    Route::get('/admin', [AdmLogin::class, 'index'])->name('adm.login');
    Route::post('/admin/login', [AdmLogin::class, 'login'])->name('adm.login.do');
});

Route::middleware('auth')->group(function(){
    Route::get('/admin/sair', [AjusteController::class, 'logout'])->name('adm.logout');
    Route::get('/admin/home', [AdmHome::class, 'index'])->name('adm.home');
    Route::post('/admin/clientes/busca-cliente', [ClienteController::class, 'buscaCliente'])->name('adm.clientes.busca');
    Route::get('/admin/clientes/novo-cliente', [ClienteController::class, 'index'])->name('adm.clientes.create');
    Route::post('/admin/clientes/criar', [ClienteController::class, 'store'])->name('adm.clientes.new');
    Route::get('/admin/clientes/visualizar', [ClienteController::class, 'show'])->name('adm.clientes.show');
    Route::get('/admin/clientes/visualizar/all', [ClienteController::class, 'getData'])->name('adm.clientes.all');
    Route::get('/admin/clientes/editar/{id}', [ClienteController::class, 'edit'])->name('adm.clientes.edit');
    Route::post('/admin/clientes/mensalidades/store', [ClienteController::class, 'mensalidadeStore'])->name('adm.clientes.mensalidades.store');
    Route::get('/admin/clientes/editar/{id}/mensalidades', [ClienteController::class, 'mensalidadeIndex'])->name('adm.clientes.mensalidades');
    Route::get('/admin/clientes/editar/{id}/mensalidades/all', [ClienteController::class, 'getMensalidades'])->name('adm.clientes.mensalidades.endpoint');
    Route::post('/admin/clientes/update/{id}', [ClienteController::class, 'update'])->name('adm.clientes.update');
    Route::post('/admin/clientes/apagar/{id}', [ClienteController::class, 'delete'])->name('adm.clientes.delete');
    Route::post('/admin/clientes/apagar/mensalidade/{id}', [ClienteController::class, 'deleteMensalidade'])->name('adm.clientes.delete.mensalidade');
    Route::post('/admin/clientes/{id}/mensalidades/store', [ClienteController::class, 'cadastrarBoletoModal'])->name('adm.clientes.mensalidades.modalStore');

    Route::get('/admin/clientes/editar/{id}/contratos', [ClienteController::class, 'contratosIndex'])->name('adm.clientes.contratos');
    Route::get('/admin/clientes/editar/{id}/contratos/all', [ClienteController::class, 'getContrato'])->name('adm.clientes.contratos.endpoint');
    Route::post('/admin/clientes/{id}/contrato/store', [ClienteController::class, 'cadastrarContratoModal'])->name('adm.clientes.contratos.modalStore');
    Route::post('/admin/clientes/apagar/contrato/{id}', [ClienteController::class, 'deleteContrato'])->name('adm.clientes.delete.contrato');

    Route::post("/admin/clientes/ajax", [ClienteController::class, 'ajaxDataClientes'])->name('adm.clientes.ajax');
    Route::post("/admin/clientes/ajax/mensalidades/{id}", [ClienteController::class, 'ajaxDataBoletos'])->name('adm.clientes.mensalidades.ajax');

    //Contato
    Route::get('/admin/contato/novo-contato', [AdmContatoController::class, 'index'])->name('adm.contato.create');
    Route::post('/admin/contato/store', [AdmContatoController::class, 'store'])->name('adm.contato.store');
    Route::get('/admin/contato/visualizar', [AdmContatoController::class, 'show'])->name('adm.contato.show');
    Route::get('/admin/contato/visualizar/all', [AdmContatoController::class, 'getData'])->name('adm.contato.all');
    Route::get('/admin/contato/editar/{id}', [AdmContatoController::class, 'edit'])->name('adm.contato.edit');
    Route::post('/admin/contato/update/{id}', [AdmContatoController::class, 'update'])->name('adm.contato.update');
    Route::post('/admin/contato/apagar/{id}', [AdmContatoController::class, 'delete'])->name('adm.contato.delete');
    Route::post("/admin/contato/ajax", [AdmContatoController::class, 'ajaxDataContato'])->name('adm.contato.ajax');
    Route::post("/admin/contato/update-notification", [AdmContatoController::class, 'updateNotification'])->name('adm.contato.notification');

    //Vender
    Route::get('/admin/vender/nova-venda', [AdmVenderController::class, 'index'])->name('adm.vender.create');
    Route::post('/admin/vender/store', [AdmVenderController::class, 'store'])->name('adm.vender.store');
    Route::get('/admin/vender/visualizar', [AdmVenderController::class, 'show'])->name('adm.vender.show');
    Route::post("/admin/vender/ajax", [AdmVenderController::class, 'ajaxDataVender'])->name('adm.vender.ajax');
    Route::get('/admin/vender/visualizar/all', [AdmVenderController::class, 'getData'])->name('adm.vender.all');
    Route::get('/admin/vender/editar/{id}', [AdmVenderController::class, 'edit'])->name('adm.vender.edit');
    Route::post('/admin/vender/update/{id}', [AdmVenderController::class, 'update'])->name('adm.vender.update');
    Route::post('/admin/vender/apagar/{id}', [AdmVenderController::class, 'delete'])->name('adm.vender.delete');

    // Imóveis
    Route::get('/admin/imoveis/novo-imovel', [ImoveisController::class, 'index'])->name('adm.imoveis.create');
    Route::get('/admin/imoveis/visualizar', [ImoveisController::class, 'show'])->name('adm.imoveis.show');
    Route::post("/admin/imoveis/ajax", [ImoveisController::class, 'ajaxDataImoveis'])->name('adm.imoveis.ajax');
    Route::post('/admin/imoveis/store', [ImoveisController::class, 'store'])->name('adm.imoveis.store');
    Route::get('/admin/imoveis/visualizar/all', [ImoveisController::class, 'getData'])->name('adm.imoveis.all');
    Route::get('/admin/imoveis/editar/{id}', [ImoveisController::class, 'edit'])->name('adm.imoveis.edit');
    Route::post('/admin/imoveis/update/{id}', [ImoveisController::class, 'update'])->name('adm.imoveis.update');
    Route::post('/admin/imoveis/apagar/{id}', [ImoveisController::class, 'delete'])->name('adm.imoveis.delete');
    Route::get('/admin/imoveis/images/all/{id}', [ImoveisController::class, 'getImages'])->name('adm.imoveis.images.all');
    Route::get('/admin/imoveis/images/{id}', [ImoveisController::class, 'images'])->name('adm.imoveis.images');
    Route::post('/admin/imoveis/images/store/{id}', [ImoveisController::class, 'imagesStore'])->name('adm.imoveis.images.store');
    Route::post('/admin/imoveis/images/apagar/{id}', [ImoveisController::class, 'imageDelete'])->name('adm.imoveis.images.store');
    Route::post('/admin/imoveis/ajax-estados', [ImoveisController::class, 'getEstados'])->name('adm.imoveis.estados.ajax');

    // Meta Tags
    Route::get('/admin/meta-tags/editar/{id}', [MetaTagController::class, 'edit'])->name('adm.meta.edit');
    Route::get('/admin/meta-tags/visualizar', [MetaTagController::class, 'show'])->name('adm.meta.show');
    Route::post('/admin/meta-tags/update/{id}', [MetaTagController::class, 'update'])->name('adm.meta.update');

    //  Ajustes
    Route::get('/admin/ajustes', [AjusteController::class, 'show'])->name('adm.ajuste.show');
    Route::get('/admin/ajustes/numeros-contato', [AjusteController::class, 'showContato'])->name('adm.ajuste.contato');
    Route::post('/admin/ajustes/numeros-contato/save', [AjusteController::class, 'contatoStore'])->name('adm.ajuste.contato.save');
    Route::get('/admin/ajustes/links-redes-sociais', [AjusteController::class, 'showSocialMedia'])->name('adm.ajuste.social');
    Route::get('/admin/ajustes/configuracoes-usuarios/novo', [AjusteController::class, 'userConf'])->name('adm.ajuste.userconf');
    Route::get('/admin/ajustes/configuracoes-usuarios', [AjusteController::class, 'showUserConf'])->name('adm.ajuste.userconf.show');
    Route::get('/admin/ajustes/configuracoes-usuarios/editar/{id}', [AjusteController::class, 'editUserConf'])->name('adm.ajuste.userconf.edit');
    Route::post('/admin/ajustes/configuracoes-usuarios/save', [AjusteController::class, 'userConfStore'])->name('adm.ajuste.userconf.save');
    Route::get('/admin/ajustes/configuracoes-usuarios/all', [AjusteController::class, 'getUsers'])->name('adm.ajuste.userconf.all');
    Route::post('/admin/ajustes/configuracoes-usuarios/update/{id}', [AjusteController::class, 'userConfUpdate'])->name('adm.ajuste.userconf.update');
    Route::post('/admin/ajustes/configuracoes-usuarios/delete/{id}', [AjusteController::class, 'userConfDelete'])->name('adm.ajuste.userconf.delete');
    Route::post('/admin/ajustes/links-redes-sociais/save', [AjusteController::class, 'socialMediaStore'])->name('adm.ajuste.social.save');
    Route::post('/admin/ajustes/endereco/save', [AjusteController::class, 'enderecoStore'])->name('adm.ajuste.endereco.save');

    // Banners
    Route::get('/admin/banner/novo', [BannerController::class, 'index'])->name('adm.bannner.create');
    Route::post('/admin/banner/store', [BannerController::class, 'bannerStore'])->name('adm.bannner.store');
    Route::get('/admin/banner/edit/{id}', [BannerController::class, 'bannerEdit'])->name('adm.bannner.edit');
    Route::post('/admin/banner/update/{id}', [BannerController::class, 'bannerUpdate'])->name('adm.bannner.update');
    Route::post('/admin/banner/delete/{id}', [BannerController::class, 'bannerDelete'])->name('adm.bannner.delete');
    Route::get('/admin/banner/show', [BannerController::class, 'bannerShow'])->name('adm.bannner.show');
    Route::get('/admin/banner/all', [BannerController::class, 'getBanner'])->name('adm.bannner.all');

    // Localidades - Estado
    Route::get('/admin/localidades/estados/visualizar', [LocalidadeController::class, 'estadoIndex'])->name('adm.localidades.estados.show');
    Route::get('/admin/localidades/estados/novo', [LocalidadeController::class, 'estadoCreate'])->name('adm.localidades.estados.create');
    Route::get('/admin/localidades/estados/edit/{id}', [LocalidadeController::class, 'estadoEdit'])->name('adm.localidades.estados.edit');
    Route::post('/admin/localidades/estados/store', [LocalidadeController::class, 'estadoStore'])->name('adm.localidades.estados.store');
    Route::post('/admin/localidades/estados/update/{id}', [LocalidadeController::class, 'estadosUpdate'])->name('adm.localidades.estados.update');
    Route::get('/admin/localidades/estados/all', [LocalidadeController::class, 'getEstados'])->name('adm.localidades.estados.all');
    Route::post("/admin/localidades/estados/ajax", [LocalidadeController::class, 'ajaxDataEstados'])->name('adm.localidades.estados.ajax');
    Route::post('/admin/localidades/estados/delete/{id}', [LocalidadeController::class, 'estadoDelete'])->name('adm.localidades.estados.delete');


    // Localidades - Bairro
    Route::get('/admin/localidades/bairro/visualizar', [LocalidadeController::class, 'bairroIndex'])->name('adm.localidades.bairros.show');
    Route::get('/admin/localidades/bairro/edit/{id}', [LocalidadeController::class, 'bairroEdit'])->name('adm.localidades.bairros.edit');
    Route::get('/admin/localidades/bairro/novo', [LocalidadeController::class, 'bairroCreate'])->name('adm.localidades.bairros.create');
    Route::post('/admin/localidades/bairro/store', [LocalidadeController::class, 'bairroStore'])->name('adm.localidades.bairros.store');
    Route::post('/admin/localidades/bairro/update/{id}', [LocalidadeController::class, 'bairroUpdate'])->name('adm.localidades.bairros.update');
    Route::get('/admin/localidades/bairro/all', [LocalidadeController::class, 'getBairros'])->name('adm.localidades.bairros.all');
    Route::post("/admin/localidades/bairro/ajax", [LocalidadeController::class, 'ajaxDataBairros'])->name('adm.localidades.bairros.ajax');
    Route::post('/admin/localidades/bairro/delete/{id}', [LocalidadeController::class, 'bairroDelete'])->name('adm.localidades.bairros.delete');

    // Tipo Imóvel
    Route::get('/admin/tipo-imovel/visualizar', [TipoImovelController::class, 'show'])->name('adm.tipo-imovel.show');
    Route::get('/admin/tipo-imovel/novo', [TipoImovelController::class, 'create'])->name('adm.tipo-imovel.create');
    Route::post('/admin/tipo-imovel/store', [TipoImovelController::class, 'store'])->name('adm.tipo-imovel.store');
    Route::get('/admin/tipo-imovel/edit/{id}', [TipoImovelController::class, 'edit'])->name('adm.tipo-imovel.edit');
    Route::post('/admin/tipo-imovel/update/{id}', [TipoImovelController::class, 'update'])->name('adm.tipo-imovel.update');
    Route::post('/admin/tipo-imovel/delete/{id}', [TipoImovelController::class, 'delete'])->name('adm.tipo-imovel.delete');
    Route::get('/admin/tipo-imovel/all', [TipoImovelController::class, 'getTipo'])->name('adm.tipo-imovel.all');
    Route::post('/admin/tipo-imovel/ajax', [TipoImovelController::class, 'ajaxDataTipoImovel'])->name('adm.tipo-imovel.ajax');

    // Agendamento
    Route::get('/admin/agendamentos/visualizar', [AgendamentoController::class, 'index'])->name('adm.agendamento.show');
    Route::get('/admin/agendamentos/novo', [AgendamentoController::class, 'create'])->name('adm.agendamento.create');
    Route::post('/admin/agendamentos/store', [AgendamentoController::class, 'store'])->name('adm.agendamento.store');
    Route::get('/admin/agendamentos/all', [AgendamentoController::class, 'getAgendamento'])->name('adm.agendamento.all');
    Route::get('/admin/agendamentos/edit/{id}', [AgendamentoController::class, 'edit'])->name('adm.agendamento.edit');
    Route::post('/admin/agendamentos/update/{id}', [AgendamentoController::class, 'update'])->name('adm.agendamento.update');
    Route::post('/admin/agendamentos/delete/{id}', [AgendamentoController::class, 'delete'])->name('adm.agendamento.delete');
    Route::post('/admin/agendamentos/ajax', [AgendamentoController::class, 'ajaxDataAgendamentos'])->name('adm.agendamentos.ajax');
    Route::post('/admin/agendamentos/status', [AgendamentoController::class, 'agendamentosStatus'])->name('adm.agendamentos.status');
});
