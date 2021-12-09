@extends('layouts.site')
@section('title', 'Imobiliária')
@section('content')
{{-- Meta tags dinâmicas --}}
@section('keywords', 'Teste')
@section('description', 'Teste')
{{-- End Meta tags dinâmicas --}}

<section class="slider-area">
    <div class="slider-search-area">
        <div class="container-full">
            <div class="container-static">
                <div class="slider-search-wrapper">
                    <form>
                        @csrf
                        <div class="subtitle-area">
                            <p>Escolha o estado e o bairro e localize o imóvel ideal para <strong>você</strong>!</p>
                        </div>
                        <div class="form-cidade">
                            <label for="cidade">Cidade</label>
                            <select name="cidade" id="estados" onchange="estadoAjax(this.value, '{{ route('home.estados.ajax') }}')">
                                <option value="" hidden disabled selected>Selecione a cidade</option>
                                @foreach($estados as $uf)
                                    <option value="{{ $uf['url_estado'] }}">{{ $uf['estados'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-bairro">
                            <label for="bairro">Bairro</label>
                            <select name="bairro" id="bairros" disabled>
                                <option value="" hidden disabled selected>Selecione a bairro</option>
                                @foreach($bairros as $bairro)
                                    <option value="{{ $bairro['url_bairro'] }}">{{ $bairro['bairros'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="btn-area">
                            <button title="Buscar" type="submit" id="searchImoveis" name="buscar">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="slider-primary">
        <div class="splide" id="slider-home">
            <div class="splide__track">
                <ul class="splide__list">
                    @if(count($banner) > 0)
                        @foreach($banner as $banners)
                            <li class="splide__slide">
                                <figure>
                                    <img src="{{ URL::to($banners['image']) }}" alt="{{ $banners['description'] }}">
                                </figure>
                            </li>
                        @endforeach
                    @else
                        <li class="splide__slide">
                            <figure>
                                <img src="{{ URL::to('img/home/slider-home-image.webp') }}" alt="Image slider">
                            </figure>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="splide__arrows arrows-wrapper">
                <div class="container-full">
                    <div class="container-static">
                        <div class="container-arrows">
                            <div class="arrows">
                                <button class="splide__arrow splide__arrow--prev your-class-prev">
                                </button>
                                <button class="splide__arrow splide__arrow--next your-class-next">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="slider-caption">
        <div class="container-full">
            <div class="container-static">
                <div class="caption-area">
                    <div class="caption">
                        <div class="splide" id="slider-caption">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @if(count($banner) > 0)
                                        @foreach($banner as $banners)
                                            <li class="splide__slide">
                                                <p>{{ $banners['description'] }}</p>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="splide__slide">
                                            <p>O melhor investimento<br><strong>para você</strong>!</p>
                                        </li>
                                        <li class="splide__slide">
                                            <p>O melhor investimento<br><strong>para você</strong>!(2)</p>
                                        </li>
                                        <li class="splide__slide">
                                            <p>O melhor investimento<br><strong>para você</strong>!(3)</p>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="destaque-area">
    <div class="container-full">
        <div class="container-static">
            @include('components.title-section')
            <div class="destaque-wrapper">
                @if(count($imoveis) > 0)
                    @foreach($imoveis as $imovel)
                        <a href="{{ url('/comprar/')."/".$imovel['url_imovel'] }}" title="Ver mais">
                            <div class="destaque-items">
                                <span class="line-1"></span>
                                <span class="line-2"></span>
                                <div class="image-area">
                                    <figure>
                                        @if(count($imovel->getImages()->get()) > 0)
                                            <img src="{{ URL::to($imovel->getImages()->first()->image) }}" alt="Em destaques"/>
                                        @else
                                            <img src="{{ URL::to('img/home/imobiliaria-home-destaques.webp') }}" alt="Em destaques"/>
                                        @endif
                                    </figure>
                                </div>
                                <div class="destaques-description">
                                    <div class="price">
                                        <h2>{{ "R$ ".str_replace(',', '.', $imovel['valor']) }}</h2>
                                    </div>
                                    <div class="rooms-metters">
                                        <p>{{ $imovel['qtd_quartos'] }} Quartos • {{ $imovel['metros_quadrados'] }}m2</p>
                                    </div>
                                    <div class="localization">
                                        <p>{{ $imovel->getBairro()->first()->bairros }} • {{ $imovel->getEstado()->first()->estados }}</p>
                                    </div>
                                </div>
                                <span>Ver +</span>
                            </div>
                        </a>
                    @endforeach
                @else
                    <h1 style="margin: 20px 0; font-size: 25px; text-align: center; text-transform: uppercase; display: flex; justify-content: center; width: 100%; align-items: center;">Sem imóveis em destaque</h1>
                @endif
            </div>
            <div class="btn-area">
                <a href="{{ url('/comprar') }}" title="Ver todos">Ver todos</a>
            </div>
        </div>
    </div>
</section>
<section class="conheca-area">
    <div class="container-full">
        <div class="container-static">
            <div class="title-area">
                <div class="title">
                    <h2>Conheça nossos principais diferenciais</h2>
                </div>
            </div>
            <div class="conheca-wrapper">
                <div class="conheca-items">
                    <i class="icon-map-signs"></i>
                    <div class="content">
                        <p>Temos os melhores preços disponíveis no mercado para variar suas opções de compra.</p>
                    </div>
                </div>
                <div class="conheca-items">
                    <i class="icon-dollar"></i>
                    <div class="content">
                        <p>Somos a melhor referência da região, pois nosso maior objetivo é te proporcionar a melhor experiência na sua compra.</p>
                    </div>
                </div>
                <div class="conheca-items">
                    <i class="icon-user-tie"></i>
                    <div class="content">
                        <p>Temos uma equipe de assessoria especializada e dedicada sempre a <strong>VOCÊ</strong>!</p>
                    </div>
                </div>
                <div class="conheca-items">
                    <i class="icon-truck"></i>
                    <div class="content">
                        <p>Nós auxiliamos você à deixar seu <strong>apê</strong> do seu jeito, temos um time especialista em reformas residenciais.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bannerMiddle-area">
    <div class="container-full">
        <div class="container-static">
            <div class="bannerMiddle-content">
                <div class="title-area">
                    <div class="title">
                        <h2>Quer vender seu imóvel de maneira rentável e segura?</h2>
                    </div>
                </div>
            </div>
            <div class="btn-orcamento">
                <a href="#" title="Faça o orçamento">Venda agora</a>
            </div>
        </div>
    </div>
</section>
<script>
    const destaques = new setTitleSection(".destaque-area", "Em destaque")
    const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

    function sendvalue(route)
    {
        let data = {
            estado: document.querySelector("#estados"),
            bairros: document.querySelector("#bairros"),
            urlEstado: '',
        }

        data.estado.addEventListener("change", ()=>{
            data.urlEstado = data.estado.value;
        })

        this.buttonSubmit = document.querySelector("#searchImoveis");
        buttonSubmit.addEventListener("click", function(e){
            e.preventDefault();
            if(data.urlEstado !== '')
            {
                window.location.href = `{{ url('/comprar/') }}/${data.urlEstado}/${data.bairros.value}`
            }
            else
            {
                window.location.href = `{{ route('goComprar') }}`
            }
        })
    }
    sendvalue()

    async function estadoAjax(el, route)
    {
        this.estado = document.querySelector("#estados");
        this.bairros = document.querySelector("#bairros");
        await fetch(route, {
            method: 'POST',
            headers:{
                'content-type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify({estado: el})
        })
            .then((response)=>response.json())
            .then((responseJson)=>{
                if(bairros.value !== 0)
                {
                    bairros.disabled = false;
                    bairros.innerHTML = ``;
                    Object.values(responseJson).map((data)=>(
                        bairros.options.add(new Option(data.bairros, data.url_bairro))
                    ))
                }
            })
    }
</script>
@endsection
