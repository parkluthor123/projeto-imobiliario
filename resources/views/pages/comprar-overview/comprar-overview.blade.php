@extends('layouts.site')
@section('title', 'Imobiliária')
@section('nav-contato', 'navbar-active')
@section('content')
<link rel="stylesheet" href="{{ URL::to('libs/fancybox/fancybox.css') }}">
<link rel="stylesheet" href="{{ URL::to('css/comprar/overview.css') }}">
@include('components.message')
@include('components.messageCallback')
<section class="overview-imoveis-area">
    <div class="container-full">
        <div class="container-static">
            <div class="overview-imoveis-wrapper">
                <div class="overview-images-wrapper
                    @switch($qtdImages)
                        @case(5)
                            layout-5
                            @break
                        @case(4)
                            layout-4
                            @break
                        @case(3)
                            layout-3
                            @break
                        @case(2)
                            layout-2
                            @break
                        @case(1)
                            layout-1
                            @break
                        @case(0)
                            @break
                        @default
                            layout-5
                        @endswitch
                ">

                    @if(count($imoveis->getImages()->get()) > 0)
                        @php
                            $i = 0;
                        @endphp
                        @foreach($imoveis->getImages()->take(5)->get() as $image)
                            @php
                                $i++
                            @endphp
                            <a href="{{ URL::to($image->image_original) }}" class="grid-layout-image-{{$i}}" style="grid-area: img{{$i}};" data-fancybox="gallery">
                                <figure>
                                    <img src="{{ URL::to($image->image_original) }}" alt="" />
                                </figure>
                            </a>
                        @endforeach
                    @else
                        <h1 style="text-transform:uppercase; font-size: 20px; text-align: center; margin: 100px 0;">Sem imagens disponíveis</h1>
                    @endif
                    @if($qtdImages > 5)
                        <span class="seeMoreImages">
                            <a href="#">Ver todas as {{ $qtdImages }} imagens</a>
                        </span>
                    @endif
                </div>

                <div class="overview-imoveis-content">
                    <div class="imoveis-descricao">
                        <div class="title-area">
                            <div class="title">
                                <h1>{{ $imoveis['descricao'] }}</h1>
                            </div>
                            <div class="subtitle">
                                <p>{{ $imoveis['endereco'] }} - {{ $imoveis['cidade'] }}</p>
                            </div>
                        </div>
                        @if($imoveis['status'] == 'comprar')
                            <span class="imovel-status">Á venda</span>
                        @else
                            <span class="imovel-status">Aluguel</span>
                        @endif
                        <span class="imovel-valor">{{ $imoveis['status'] === 'comprar' ? "R$ ".str_replace(",",".",$imoveis['valor']) : "R$ ".str_replace(",",".", $imoveis['valor'])."/mês" }}</span>
                        <div class="subtotal-area">
                            <div class="subtotal-items">
                                <span><i class="icon-road"></i> Àrea</span>
                                <p>{{ $imoveis['metros_quadrados'] }}m2</p>
                            </div>
                            <div class="subtotal-items">
                                <span><i class="icon-bed"></i> Quartos</span>
                                <p>{{ $imoveis['qtd_quartos'] }}</p>
                            </div>
                        </div>
                        <div class="sobre-area">
                            <h1>Sobre o imóvel</h1>
                            <p>{{ $imoveis['sobre'] }}</p>
                        </div>
                    </div>
                    <div class="form-agendar">
                        <form action="{{ route('comprar.overview.send') }}" method="POST">
                            @csrf
                            <div class="form-item">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" placeholder="Digite o nome">
                            </div>
                            <div class="form-item">
                                <label for="email">E-mail</label>
                                <input type="text" id="email" name="email" placeholder="Digite o email">
                            </div>
                            <div class="form-item">
                                <label for="phone">Celular</label>
                                <input type="text" id="phone" name="phone" placeholder="(xx) xxxxx-xxxx" maxlength="15">
                            </div>
                            <div class="form-item">
                                <label for="tipo_contato">Tipo de contato</label>
                                <select name="tipo_contato" id="tipo_contato">
                                    <option value="" hidden disabled selected>Escolha o tipo de contato</option>
                                    <option value="1">Telefone</option>
                                    <option value="2">E-mail</option>
                                    <option value="3">WhatsApp</option>
                                </select>
                            </div>
                            <div class="btn-area">
                                <button type="submit" disabled id="btnSubmit">Entrar em contato</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ URL::to('libs/fancybox/fancybox.umd.js') }}"></script>
<script>
    Fancybox.bind("[data-fancybox='gallery']");
    const phone = document.querySelector("#phone");

    function formatTel(v){
        v = v.replace(/[^\d]/g, "");
        v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
        v = v.replace(/(\d)(\d{4})$/, "$1-$2");
        return v;
    }

    phone.addEventListener("keyup",()=>{
        phone.value = formatTel(phone.value);
    });

    function enableButton()
    {
        const btnSubmit = document.querySelector("#btnSubmit");
        this.nome = document.querySelector("#nome");
        this.email = document.querySelector("#email");
        this.phone = document.querySelector("#phone");
        this.tipo = document.querySelector("#tipo_contato");

        nome.addEventListener("keyup", ()=>{
            if(nome.value !== '' && email.value !== '' && phone.value !== '' && tipo.value !== '')
            {
                btnSubmit.disabled = false;
            }
            else
            {
                btnSubmit.disabled = true;
            }
        })

        email.addEventListener("keyup", ()=>{
            if(nome.value !== '' && email.value !== '' && phone.value !== '' && tipo.value !== '')
            {
                btnSubmit.disabled = false;
            }
            else
            {
                btnSubmit.disabled = true;
            }
        })

        phone.addEventListener("keyup", ()=>{
            if(nome.value !== '' && email.value !== '' && phone.value !== '' && tipo.value !== '')
            {
                btnSubmit.disabled = false;
            }
            else
            {
                btnSubmit.disabled = true;
            }
        })

        tipo.addEventListener("change", ()=>{
            if(nome.value !== '' && email.value !== '' && phone.value !== '' && tipo.value !== '')
            {
                btnSubmit.disabled = false;
            }
            else
            {
                btnSubmit.disabled = true;
            }
        })
    }

    enableButton()
</script>
@endsection
