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

// Site Routes
Route::get("/", [HomeController::class, 'index'])->name("goHome");
Route::get("/quem-somos", [QuemSomosController::class, 'index'])->name("goQuemSomos");
Route::get('/comprar', [ComprarController::class, 'index'])->name('goComprar');
Route::get("/contato", [ContatoController::class, 'index'])->name('goContato');
Route::get("/vender", [VenderController::class, 'index'])->name('goVender');

//Area restrita Routes
Route::get("/entrar", [LoginController::class, 'index'])->name("area-restrita.login")->middleware('redirect-logged');
Route::post('/entrar/do', [LoginController::class, 'login'])->name('area-restrita.do')->middleware('redirect-logged');
Route::get('/criar-conta', [LoginController::class, 'criar'])->name('area-restrita.register')->middleware('redirect-logged');
Route::post('/criar-conta/criar', [LoginController::class, 'criarConta'])->name('area-restrita.register.do')->middleware('redirect-logged');

//Middleware pra autenticação da área restrita
Route::middleware([clienteAuth::class, 'middleware' => 'prevent-back-history'])->group(function (){
    Route::get('/area-restrita/agendamentos', [HomeAreaCliente::class, 'agendamentos'])->name('area-restrita.agendamentos');
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
    Route::get('/admin/home', [AdmHome::class, 'index'])->name('adm.home');
});
