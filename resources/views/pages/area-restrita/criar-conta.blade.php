@extends("layouts.site")
@section('title', 'Imobiliária')
@section('content')
<link rel="stylesheet" href="{{ URL::to('css/area-restrita/style.css') }}">

{{-- Meta tags dinâmicas --}}
@section('keywords', 'Teste')
@section('description', 'Teste')
{{-- End Meta tags dinâmicas --}}
@include('components.bannerTop')
@include('components.message')
<section class="criar-conta-area">
    @include('components.title-section')
    <div class="container-full">
        <div class="container-static">
            <div class="criar-conta-wrapper">
                <form action="{{ route('area-restrita.register.do') }}" method="POST">
                    @csrf
                    <div class="form-title-area">
                        <div class="title">
                            <h1>Crie sua conta e faça parte da nossa história</h1>
                        </div>
                        <div class="subtitle">
                            <p>Preencha os dados nos campos abaixo:</p>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="nome">Nome completo</label>
                        <input type="text" name="nome" value="{{ old('nome') }}" id="nome" required placeholder="Nome completo">
                    </div>
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" value="{{ old('email') }}" id="email" required placeholder="Digite seu e-mail">
                    </div>
                    <div class="form-item">
                        <label for="senha">Senha</label>
                        <input type="password" name="password" value="{{ old('password') }}" id="senha" required placeholder="Digite sua senha">
                    </div>
                    <div class="form-item">
                        <label for="conf_senha">Confirmar senha</label>
                        <input type="password"  name="conf_senha" value="{{ old('conf_senha') }}" required id="conf_senha" placeholder="Confirme a senha">
                    </div>
                    <div class="privacy-area">
                        <input type="checkbox" name="privacidade" id="privacidade">
                        <p>Aceito os <a href="{{ url('/termos') }}" title="Termos de uso e privacidade">termos de uso e privacidade</a> da <strong>Imobiliária</strong></p>
                    </div>
                    <div class="btn-area">
                        <button type="submit">Criar conta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    const bannerTop = new setBannerTop("Crie sua conta <br> conosco", "Criar conta")
    const title = new setTitleSection(".criar-conta-area","Crie sua conta")
</script>
@endsection
