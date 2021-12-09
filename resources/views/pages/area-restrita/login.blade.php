@extends("layouts.site")
@section('title', 'Imobiliária')
@section('content')
<link rel="stylesheet" href="{{ URL::to('css/area-restrita/style.css') }}">
{{-- Meta tags dinâmicas --}}
@section('keywords', 'Teste')
@section('description', 'Teste')
{{-- End Meta tags dinâmicas --}}

@include('components.bannerTop')
<div class="entrar-title">
    @include('components.title-section')
</div>
@if(\Illuminate\Support\Facades\Auth::guard('clientes')->check())
    <meta http-equiv="refresh" content="0; URL='{{ route('area-restrita.home') }}'"/>
@endif

@if($verify = Session::get('verify'))
   <div class="verifyModal-area">
       <div class="container-full">
           <div class="container-static">
               <div class="verifyModal-wrapper">
                   <span id="closeVerify" onclick="closeVerify()">
                   </span>
                   <p>{{$verify}}</p>
                   <div class="btn-area">
                       <a href="#">Reenviar email de verificação</a>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endif
<section class="entrar-area">
    <div class="container-full">
        <div class="container-static">
            <div class="entrar-wrapper">
                <div class="entrar-items">
                    <div class="title-area">
                        <h1>Conheça nossa<br>
                            Área do Cliente</h1>
                    </div>
                    <div class="subtitle-area">
                        <p>Aproveite o benefício de ser nosso cliente,<br> tenha todas as informações na palma da mão</p>
                    </div>
                    <div class="content">
                        <ul>
                            <li>2° via do seu boleto</li>
                            <li>Extrato de repasse de Aluguel</li>
                            <li>Contratos de locação</li>
                        </ul>
                        <p>Se precisar de alguma ajuda, entre em contato com nossos<br> corretores, tiraremos todas as suas dúvidas.</p>
                    </div>
                    <div class="btn-area">
                        <a {{ $ajustes['topbar_num'] !== null ? 'target="_blank"' : '' }} href="{{ $ajustes['topbar_num'] !== null ? 'https://api.whatsapp.com/send?phone='.str_replace(["(", ")", "-", " "], "", $ajustes['topbar_num']) : 'javascript:;' }}" title="Conversar com corretor"><i class="icon-whatsapp"></i> Nosso whatsapp</a>
                    </div>
                </div>
                <div class="entrar-items">
                    <form action="{{route('area-restrita.do')}}" method="POST">
                        @csrf
                        <div class="title-area">
                            <div class="title">
                                <h1>Fazer login</h1>
                            </div>
                            <div class="subtitle">
                                <p>Insira seu usuário e senha nos campos abaixo</p>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="email">Email</label>
                            <input type="text" id="email" placeholder="Digite seu e-mail" name="email">
                        </div>
                        <div class="form-item">
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" placeholder="Digite sua senha" name="password">
                        </div>
                        <div class="btn-area">
                            <button type="submit">Fazer Login</button>
                        </div>
                        <div class="criar-conta">
                            <p>Ainda não tem uma conta? <a href="{{ route('area-restrita.register') }}" title="Criar uma conta">Criar uma agora</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const bannerTop = new setBannerTop("Entre agora na sua<br> Área do Aluno", "Entrar");
    const title = new setTitleSection(".entrar-title", "Entrar");

    function closeVerify()
    {
        const verifWrapper = document.querySelector('.verifyModal-area');
        verifWrapper.style.cssText = "display: none";
    }
</script>
@endsection
