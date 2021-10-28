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
                    <form action="#" method="POST">
                        @csrf
                        <div class="subtitle-area">
                            <p>Escolha o estado e o bairro e localize o imóvel ideal para <strong>você</strong>!</p>
                        </div>
                        <div class="form-cidade">
                            <label for="cidade">Cidade</label>
                            <select name="cidade" id="cidade">
                                <option value="">Selecione a cidade</option>
                            </select>
                        </div>
                        <div class="form-bairro">
                            <label for="bairro">Bairro</label>
                            <select name="bairro" id="bairro">
                                <option value="">Selecione a bairro</option>
                            </select>
                        </div>
                        <div class="btn-area">
                            <button title="Buscar" type="submit" name="buscar">Buscar</button>
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
                    <li class="splide__slide">
                        <figure>
                            <img src="{{ URL::to('img/home/slider-home-image.webp') }}" alt="Image slider">
                        </figure>
                    </li>
                    <li class="splide__slide">
                        <figure>
                            <img src="{{ URL::to('img/home/slider-home-image.webp') }}" alt="Image slider">
                        </figure>
                    </li>
                    <li class="splide__slide">
                        <figure>
                            <img src="{{ URL::to('img/home/slider-home-image.webp') }}" alt="Image slider">
                        </figure>
                    </li>
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
                                    <li class="splide__slide">
                                        <p>O melhor investimento<br><strong>para você</strong>!</p>
                                    </li>
                                    <li class="splide__slide">
                                        <p>O melhor investimento<br><strong>para você</strong>!(2)</p>
                                    </li>
                                    <li class="splide__slide">
                                        <p>O melhor investimento<br><strong>para você</strong>!(3)</p>
                                    </li>
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

                <a href="#" title="Ver mais">
                    <div class="destaque-items">
                        <span class="line-1"></span>
                        <span class="line-2"></span>
                        <div class="image-area">
                            <figure>
                                <img src="{{ URL::to('img/home/imobiliaria-home-destaques.webp') }}" alt="Em destaques"/>
                            </figure>
                        </div>
                        <div class="destaques-description">
                            <div class="price">
                                <h2>R$ 1.200.000.00</h2>
                            </div>
                            <div class="rooms-metters">
                                <p>2 Quartos • 89m2</p>
                            </div>
                            <div class="localization">
                                <p>Av. Vila Gomes, 192 • São Paulo</p>
                            </div>
                        </div>
                        <span>Ver +</span>
                    </div>
                </a>

                <a href="#" title="Ver mais">
                    <div class="destaque-items">
                        <span class="line-1"></span>
                        <span class="line-2"></span>
                        <div class="image-area">
                            <figure>
                                <img src="{{ URL::to('img/home/imobiliaria-home-destaques.webp') }}" alt="Em destaques"/>
                            </figure>
                        </div>
                        <div class="destaques-description">
                            <div class="price">
                                <h2>R$ 1.200.000.00</h2>
                            </div>
                            <div class="rooms-metters">
                                <p>2 Quartos • 89m2</p>
                            </div>
                            <div class="localization">
                                <p>Av. Vila Gomes, 192 • São Paulo</p>
                            </div>
                        </div>
                        <span>Ver +</span>
                    </div>
                </a>

                <a href="#" title="Ver mais">
                    <div class="destaque-items">
                        <span class="line-1"></span>
                        <span class="line-2"></span>
                        <div class="image-area">
                            <figure>
                                <img src="{{ URL::to('img/home/imobiliaria-home-destaques.webp') }}" alt="Em destaques"/>
                            </figure>
                        </div>
                        <div class="destaques-description">
                            <div class="price">
                                <h2>R$ 1.200.000.00</h2>
                            </div>
                            <div class="rooms-metters">
                                <p>2 Quartos • 89m2</p>
                            </div>
                            <div class="localization">
                                <p>Av. Vila Gomes, 192 • São Paulo</p>
                            </div>
                        </div>
                        <span>Ver +</span>
                    </div>
                </a>
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
<section class="regioes-area">
    <div class="container-full">
        <div class="container-static">
            <div class="title-area">
                <div class="title">
                    <h1>Principais regiões de São Paulo</h1>
                </div>
            </div>
            <div class="regioes-wrapper">

                <a href="#" title="Principais regiões">
                    <div class="regioes-items">
                        <div class="image-area">
                            <figure>
                                <img src="{{ URL::to('img/home/imobiliaria-regioes-home-image.webp') }}" alt="Principais regiões">
                            </figure>
                        </div>
                        <div class="regiao-content">
                            <div class="title-area">
                                <h2>Centro</h2>
                            </div>
                            <div class="description">
                                <p>Região central de São Paulo</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#" title="Principais regiões">
                    <div class="regioes-items">
                        <div class="image-area">
                            <figure>
                                <img src="{{ URL::to('img/home/imobiliaria-regioes-home-image.webp') }}" alt="Principais regiões">
                            </figure>
                        </div>
                        <div class="regiao-content">
                            <div class="title-area">
                                <h2>Centro</h2>
                            </div>
                            <div class="description">
                                <p>Região central de São Paulo</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#" title="Principais regiões">
                    <div class="regioes-items">
                        <div class="image-area">
                            <figure>
                                <img src="{{ URL::to('img/home/imobiliaria-regioes-home-image.webp') }}" alt="Principais regiões">
                            </figure>
                        </div>
                        <div class="regiao-content">
                            <div class="title-area">
                                <h2>Centro</h2>
                            </div>
                            <div class="description">
                                <p>Região central de São Paulo</p>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</section>
<script>
    const destaques = new setTitleSection(".destaque-area", "Em destaque")
</script>
@endsection
