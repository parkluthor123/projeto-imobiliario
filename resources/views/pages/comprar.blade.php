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
                            <span class="btn-swicth" id="switch" data-stats="comprar">Comprar</span>
                        </div>
                        <div class="comprar-field-search">
                            <input type="text" id="getSearchData" placeholder="Busque por cidade">
                        </div>
                        <span class="comprar-filter-area" onclick="getFilter()">
                        <p>Filtro</p>
                        <i class="icon-equalizer"></i>
                    </span>
                        <div class="btn-search">
                            <button type="button" onclick="searchValues()"><i class="icon-search"></i>Buscar</button>
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
                <div class="comprar-content-title">
                    <h1>Escolha seu novo lar conosco</h1>
                </div>
                <div class="comprar-content-wrapper">
                    @foreach($imovel as $imoveis)
                        <!--Início da box-->
                        <a href="{{ url('/comprar/')."/".$imoveis['url_imovel'] }}"  title="Ver mais">
                            <div class="comprar-content-items">
                                <span class="line-1"></span>
                                <span class="line-2"></span>
                                <div class="image-area">
                                    <figure>
                                        @if(count($imoveis->getImages()->get()) > 0)
                                            <img draggable="false"  src="{{ URL::to($imoveis->getImages()->first()->image) }}" alt="Em destaques"/>
                                        @else
                                            <img draggable="false" src="{{ URL::to('img/home/imobiliaria-home-destaques.webp') }}" alt="Em destaques"/>
                                        @endif
                                    </figure>
                                </div>
                                <div class="comprar-description">
                                    <div class="price">
                                        <h2>{{ "R$ ".str_replace(',', '.', $imoveis['valor']) }}</h2>
                                    </div>
                                    <div class="rooms-metters">
                                        <p>{{ $imoveis['qtd_quartos'] === 0 ? 'Tamanho •' : $imoveis['qtd_quartos'].' Quartos •' }} {{ $imoveis['metros_quadrados'] }}m2</p>
                                    </div>
                                    <div class="localization">
                                        <p>{{ $imoveis->getBairro()->first()->bairros }} • {{ $imoveis->getEstado()->first()->estados }}</p>
                                    </div>
                                </div>
                                <span>Ver +</span>
                            </div>
                        </a>
                        <!--final da box-->
                    @endforeach
                </div>
                @if(count($imovel) > 0)
                    <div class="pagination-area">
                        <ul class="list-items">
                            <li>
                                <a href="{{ $imovel->currentPage() === 1 ? route('goComprar').'?page=1' : route('goComprar').'?page='.($imovel->currentPage() - 1) }}"><i class="icon-chevron-left"></i></a>
                            </li>
                            @for($i = 1; $i <= ($imovel->lastPage() > 3 ? 3 : $imovel->lastPage()); $i++)
                                <li>
                                    <a href="{{ route('goComprar').'?page='.$i }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li>
                                <a href="javascript:;">...</a>
                            </li>
                            <li>
                                <a href="{{ route('goComprar').'?page='.$imovel->lastPage()  }}">{{ $imovel->lastPage() }}</a>
                            </li>
                            <li>
                                <a href="{{ $imovel->currentPage() === $imovel->lastPage() ? route('goComprar').'?page='.$imovel->currentPage() : route('goComprar').'?page='.($imovel->currentPage() + 1)}}"><i class="icon-chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                @endif
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
                            <div class="form-qtd">
                                <label for="filtro-num-quartos">Quantidade de quartos:</label>
                                <input type="number" placeholder="Qtd quartos" name="qtd-quartos" id="filtro-num-quartos">
                            </div>
                        </div>
                        <div class="filter-items">
                            <div class="form-tipo">
                                <label for="filtro-num-quartos">Tipo de Imóvel:</label>
                                <select name="tipo_imovel" id="tipo_imovel">
                                    @foreach($tipo as $tipos)
                                        <option value="{{ $tipos['id'] }}">{{ $tipos['tipo'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  End Filtro  --}}
    <script src="{{ URL::to('libs/cleaverjs/cleave.min.js') }}"></script>
    <script>
        const bannerTop = new setBannerTop("Garanta agora seu apê favorito e<br> agende sua visita","Comprar");
        const comprar = new setTitleSection(".title-page-area", "Quero comprar meu apê");
        const swicthBtn = document.querySelector("#switch");
        const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");


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

        async function searchValues()
        {
            let dados = {
                switch: swicthBtn.getAttribute("data-stats"),
                local: document.querySelector("#getSearchData").value,
                qtd: document.querySelector("#filtro-num-quartos").value,
                tipoImovel: document.querySelector("#tipo_imovel").value,
            }
            this.imovelWrapper = document.querySelector(".comprar-content-wrapper");
            this.pagination = document.querySelector(".pagination-area");

            await fetch("{{ route('comprar.searchImoveis') }}", {
                method: 'POST',
                headers:{
                    'content-type':'application/json',
                    'Accept':'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify(dados)
            })
            .then((response)=>response.json())
            .then((responseJson)=>{
                imovelWrapper.innerHTML = '';
                pagination.style.cssText = "display: none";
                Object.values(responseJson).map((data)=>(
                    imovelWrapper.innerHTML += `
                        <a href="{{ url('/comprar/') }}/${data.url_imovel}"  title="Ver mais">
                            <div class="comprar-content-items">
                                <span class="line-1"></span>
                                <span class="line-2"></span>
                                <div class="image-area">
                                    <figure>
                                        <img draggable="false"  src="${(data.get_images).length > 0 ? data.get_images[0].image : '{{ URL::to('img/home/imobiliaria-home-destaques.webp') }}'}" alt="Em destaques"/>
                                    </figure>
                                </div>
                                <div class="comprar-description">
                                    <div class="price">
                                        <h2>R$ ${(data.valor).replace(",", ".")}</h2>
                                    </div>
                                    <div class="rooms-metters">
                                        <p>${data.qtd_quartos !== 0 ? data.qtd_quartos+' Quartos •' : 'Tamanho •'} ${data.metros_quadrados}m2</p>
                                    </div>
                                    <div class="localization">
                                        <p>${data.get_bairro.bairros} • ${ data.get_estado.estados }</p>
                                    </div>
                                </div>
                                <span>Ver +</span>
                            </div>
                        </a>

                    `
                ))
            })
        }
    </script>
@endsection
