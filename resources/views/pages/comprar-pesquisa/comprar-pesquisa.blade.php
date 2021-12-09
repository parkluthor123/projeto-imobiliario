@extends('layouts.site')
@section('title', 'Imobiliária')
@section('nav-comprar', 'navbar-active')
@section('content')
    <link rel="stylesheet" href="{{ URL::to('css/comprar/comprar.css') }}">
    @include('components.bannerTop')
    <div class="title-page-area">
        <div class="container-full">
            <div class="container-static">
                @include('components.title-section')
            </div>
        </div>
    </div>
    <section class="comprar-area">
        <div class="container-full">
            <div class="container-static">
                <div class="comprar-wrapper">
                    <div class="title-area">
                        <div class="title">
                            <h1>Compre seu imóvel que combine com você</h1>
                        </div>
                    </div>
                    <div class="ball-wrapper">
                        <span>Quer anunciar?</span>
                        <div class="btn-area">
                            <a href="{{ url('/vender') }}" title="Quero anunciar">Clique aqui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="comprar-search-area">
        <div class="comprar-search-wrapper">
            <div class="container-full">
                <div class="container-static">
                    <div class="comprar-search">
                        <div class="switch-sell-area">
                            <span class="btn-swicth" id="switch" data-stats="compra">Comprar</span>
                        </div>
                        <div class="comprar-field-search">
                            <input type="text" placeholder="Busque por cidade, bairro estado">
                        </div>
                        <span class="comprar-filter-area" onclick="getFilter()">
                        <p>Filtro</p>
                        <i class="icon-equalizer"></i>
                    </span>
                        <div class="btn-search">
                            <button type="button"><i class="icon-search"></i>Buscar</button>
                        </div>
                        <span class="line-1"></span>
                        <span class="line-2"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="comprar-content-area">
        <div class="container-full">
            <div class="container-static">
                @if(count($imoveis) > 0)
                    <div class="comprar-content-title">
                        <h1>{{ count($imoveis) < 2 ? count($imoveis)." Imovel encontrado" : count($imoveis)." Imoveis encontrados"}} - {{ $estado->estados }}</h1>
                    </div>
                @else
                    <div class="comprar-content-title">
                        <h1>Nenhum imóvel encontrado</h1>
                    </div>
                @endif
                <div class="comprar-content-wrapper">
                @foreach($imoveis as $busca)
                    <!--Início da box-->
                        <a href="#" title="Ver mais">
                            <div class="comprar-content-items">
                                <span class="line-1"></span>
                                <span class="line-2"></span>
                                <div class="image-area">
                                    <figure>
                                        @if(count($busca->getImages()->get()) > 0)
                                            <img src="{{ URL::to($busca->getImages()->first()->image) }}" alt="Em destaques"/>
                                        @else
                                            <img src="{{ URL::to('img/home/imobiliaria-home-destaques.webp') }}" alt="Em destaques"/>
                                        @endif
                                    </figure>
                                </div>
                                <div class="comprar-description">
                                    <div class="price">
                                        <h2>{{ "R$ ".str_replace(',', '.', $busca['valor']) }}</h2>
                                    </div>
                                    <div class="rooms-metters">
                                        <p>{{ $busca['qtd_quartos'] }} Quartos • {{ $busca['metros_quadrados'] }}m2</p>
                                    </div>
                                    <div class="localization">
                                        <p>{{ $busca->getBairro()->first()->bairros }} • {{ $busca->getEstado()->first()->estados }}</p>
                                    </div>
                                </div>
                                <span>Ver +</span>
                            </div>
                        </a>
                        <!--final da box-->
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{--  Filtro  --}}
    <div class="filter-area" id="filter">
        <div class="container-full">
            <div class="container-static">
                <div class="filter">
                    <div class="filter-wrapper">
                        <span class="closeFilter" onclick="closeFilter()"></span>
                        <div class="filter-items">
                            <div class="wrapp">
                                <div class="form-preco">
                                    <label for="filtro-preco-inicial">Preço inicial:</label>
                                    <input type="text" placeholder="R$" id="filtro-preco-inicial" name="filtro-preco-inicial">
                                </div>
                                <div class="form-preco">
                                    <label for="form-preco-final">Preço final:</label>
                                    <input type="text" placeholder="R$" id="form-preco-final" name="form-preco-final">
                                </div>
                            </div>
                        </div>
                        <div class="filter-items">
                            <div class="form-qtd">
                                <label for="filtro-num-quartos">Quantidade de quartos:</label>
                                <input type="text" placeholder="Qtd quartos" name="qtd-quartos" id="filtro-num-quartos">
                            </div>
                        </div>
                        <div class="filter-items">
                            <div class="form-tipo">
                                <label for="filtro-num-quartos">Tipo de Imóvel:</label>
                                <select name="tipo_imovel" id="tipo_imovel">
                                    <option value="apto">Apartamento</option>
                                    <option value="casa">Casa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  End Filtro  --}}

    <script>
        const bannerTop = new setBannerTop("Garanta agora seu apê favorito e<br> agende sua visita","Comprar");
        const comprar = new setTitleSection(".title-page-area", "Quero comprar meu apê");
        const swicthBtn = document.querySelector("#switch");

        function getFilter()
        {
            const filter = document.querySelector("#filter");
            filter.classList.toggle("filter-active");
        }

        function closeFilter()
        {
            const filter = document.querySelector("#filter");
            filter.classList.remove("filter-active");
        }

        function getSwicthValue(el)
        {
            return new Promise((resolve, reject)=>{
                resolve(el.classList.toggle('btn-swicth-rent'));
            })
        }

        swicthBtn.addEventListener("click",()=>{
            getSwicthValue(swicthBtn)
                .then(boolean=>{
                    if(boolean == true)
                    {
                        swicthBtn.setAttribute("data-stats", "alugar");
                        swicthBtn.innerHTML = "Alugar";
                    }
                    else{
                        swicthBtn.setAttribute("data-stats", "comprar");
                        swicthBtn.innerHTML = "Comprar";
                    }
                    console.log(swicthBtn.getAttribute("data-stats"));
                })
        })
    </script>
@endsection
