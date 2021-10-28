@extends('layouts.site')
@section('title', 'Imobiliária')
@section('nav-quem-somos', 'navbar-active')
@section('content')
<link rel="stylesheet" href="{{ URL::to('css/quem-somos/quem-somos.css') }}">
{{-- Meta tags dinâmicas --}}
@section('keywords', 'Teste')
@section('description', 'Teste')
{{-- End Meta tags dinâmicas --}}

@include('components.bannerTop')
<section class="quem-somos-area titleSection">
    @include('components.title-section')
    <div class="container-full missao">
        <div class="container-static">
            <div class="quem-somos-wrapper">
                <div class="quem-somos-items">
                    <div class="image-area">
                        <figure>
                            <img src="{{ URL::to('img/quem-somos/quem-somos-missao-image.webp') }}" alt="Nossa Missão">
                        </figure>
                    </div>
                </div>
                <div class="quem-somos-items">
                    <div class="quem-somos-text">
                        <div class="title-area">
                            <div class="title">
                                <h1>Missão</h1>
                            </div>
                        </div>
                        <div class="content">
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="quem-somos-area" style="background-color: var(--quem-somos-middle);">
    <div class="container-full">
        <div class="container-static">
            <div class="quem-somos-middle">
                <div class="title-area">
                    <div class="title">
                        <h1>Visão</h1>
                    </div>
                </div>
                <div class="content">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="quem-somos-area quem-somos-valores">
    <div class="container-full valores">
        <div class="container-static">
            <div class="quem-somos-wrapper">
                <div class="quem-somos-items">
                    <div class="quem-somos-text">
                        <div class="title-area">
                            <div class="title">
                                <h1>Valores</h1>
                            </div>
                        </div>
                        <div class="content">
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
                        </div>
                    </div>
                </div>
                <div class="quem-somos-items">
                    <div class="image-area">
                        <figure>
                            <img src="{{ URL::to('img/quem-somos/quem-somos-valores-image.webp') }}" alt="Nossos Valores">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="corretor-btn">
    <div class="container-full">
        <div class="container-static">
            <div class="btn-area">
                <a href="{{ url('/comprar') }}" title="Comprar agora">Comprar agora</a>
            </div>
        </div>
    </div>
</section>
<script>
    const title = new setTitleSection(".titleSection", "Quem Somos")
    const bannerTop = new setBannerTop("Conheça um pouco sobre nós", "Quem Somos");
</script>
@endsection
