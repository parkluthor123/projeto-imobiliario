@extends('layouts.site')
@section('title', 'Imobiliária')
@section('content')
{{-- Meta tags dinâmicas --}}
@section('keywords', 'Teste')
@section('description', 'Teste')
{{-- End Meta tags dinâmicas --}}
<link rel="stylesheet" href="{{ URL::to('/css/area-restrita/style.css') }}">
@include('components.bannerTop')
<section class="restrict-area">
    <div class="container-full">
        <div class="container-static">
            <div class="restrict-welcome">
                <h1>Bem vindo, {{ $users['name'] }}</h1>
                <p>Olá, essa é sua área administrativa, nela você encontrará<br>informações sobre a 2° via da sua fatura e muito mais.</p>
            </div>
            <div class="restrict-wrapper">
                <a href="{{ route('area-restrita.info') }}" title="Informações pessoais">
                    <div class="restrict-items">
                        <i class="icon-drivers-license"></i>
                        <div class="title-area">
                            <div class="title">
                                <h1>Informações<br>pessoais</h1>
                            </div>
                        </div>
                        <div class="subtitle">
                            <p>Edite suas informações pessoais, como nome, CEP, endereço entre outros.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('area-restrita.faturas') }}" title="Ver minhas faturas">
                    <div class="restrict-items">
                        <i class="icon-file-text"></i>
                        <div class="title-area">
                            <div class="title">
                                <h1>Ver minhas faturas</h1>
                            </div>
                        </div>
                        <div class="subtitle">
                            <p>Visualize suas faturas e faça o download delas quando quiser.</p>
                        </div>
                    </div>
                </a>

            </div>
            <div class="restrict-wrapper">
                <a href="{{ route('area-restrita.contratos') }}" title="Ver meus contratos">
                    <div class="restrict-items">
                        <i class="icon-copy"></i>
                        <div class="title-area">
                            <div class="title">
                                <h1>Visualizar meus<br>contratos</h1>
                            </div>
                        </div>
                        <div class="subtitle">
                            <p>Edite suas informações pessoais, como nome, CEP, endereço entre outros.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<script>
    const bannerTop = new setBannerTop("Área do cliente", "Área do cliente");
</script>
@endsection
