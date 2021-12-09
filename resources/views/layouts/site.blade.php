<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>@yield('title')</title>
    <meta name="title" content="Imobiliária - Title">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://metatags.io/">
    <meta property="og:title" content="Meta Tags — Preview, Edit and Generate">
    <meta property="og:description" content="With Meta Tags you can edit and experiment with your content then preview how your webpage will look on Google, Facebook, Twitter and more!">
    <meta property="og:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://metatags.io/">
    <meta property="twitter:title" content="Meta Tags — Preview, Edit and Generate">
    <meta property="twitter:description" content="With Meta Tags you can edit and experiment with your content then preview how your webpage will look on Google, Facebook, Twitter and more!">
    <meta property="twitter:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">
    <link rel="stylesheet" href="{{ URL::to('css/global.css') }}">
</head>
<body>
@php
    $ajustesLinks = \App\Models\Ajuste::first();
@endphp
    <div class="sticky-top">
        <nav class="navbar-area">
            <div class="navbar-top">
                <div class="container-full">
                    <div class="container-static">
                        <div class="navbar-top-wrapper">
                            <div class="list-social-media">
                                <ul>
                                    <li><a {{ $ajustesLinks['instagram'] !== null ? 'target="_blank"' : '' }} href="{{ $ajustesLinks['instagram'] !== null ? $ajustesLinks['instagram'] : 'javascript:;'}}" title="Instagram"><i class="icon-instagram"></i></a></li>
                                    <li><a {{ $ajustesLinks['facebook'] !== null ? 'target="_blank"' : '' }} href="{{ $ajustesLinks['facebook'] !== null ? $ajustesLinks['facebook'] : 'javascript:;'}}" title="Facebook"><i class="icon-facebook-square"></i></a></li>
                                    <li><a href="{{ $ajustesLinks['email'] !== null ? $ajustesLinks['email'] : 'javascript:;'}}" title="E-mail"><i class="icon-envelope-o"></i></a></li>
                                </ul>
                            </div>

                            <div class="list-number">
                                <ul>
                                    <li><a {{ $ajustesLinks['topbar_num'] !== null ? 'target="_blank"' : '' }} href="{{ $ajustesLinks['topbar_num'] !== null ? 'https://api.whatsapp.com/send?phone='.str_replace(["(", ")", "-", " "], "", $ajustesLinks['topbar_num'] ) : 'javascript:;' }}" title="WhatsApp"><i class="icon-whatsapp"></i>{{ $ajustesLinks['topbar_num'] !== null ? $ajustesLinks['topbar_num'] : 'Sem WhatsApp' }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-bottom">
                <div class="container-full">
                    <div class="container-static">
                        <div class="navbar-bottom-wrapper">
                            <div class="logo-area">
                                <a href="{{ url('/') }}" title="Página inicial">
                                    <figure>
                                        <img src="{{ URL::to('img/logo-navbar.webp') }}" alt="Logo">
                                    </figure>
                                </a>
                            </div>
                            <div class="list-navbar">
                                @include('components.navbar')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="navbar-mobile">
                <div class="navbar-mobile-wrapper">
                    <div class="logo-mobile">
                        <a href="{{ url('/') }}">
                            <figure>
                                <img src="{{ URL::to('img/logo-navbar.webp') }}" alt="Logo">
                            </figure>
                        </a>
                    </div>
                    <span id="menuMobile">
                        <i class="icon-list"></i>
                    </span>
                </div>
                <div class="navbar-content">
                    @include('components.navbar-no-switch')
                </div>
            </section>
        </nav>
    </div>
    @yield("content")
    <footer class="footer-area">
        <div class="container-full">
            <div class="container-static">
                <div class="footer-wrapper">
                    <div class="footer-items">
                        <div class="title-area">
                            <div class="title">
                                <h1>Sobre nós</h1>
                            </div>
                        </div>
                        <div class="footer-content">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <ul>
                                <li><a {{ $ajustesLinks['instagram'] !== null ? 'target="_blank"' : '' }} href="{{ $ajustesLinks['instagram'] !== null ? $ajustesLinks['instagram'] : 'javascript:;'}}" title="Instagram"><i class="icon-instagram"></i></a></li>
                                <li><a {{ $ajustesLinks['facebook'] !== null ? 'target="_blank"' : '' }} href="{{ $ajustesLinks['facebook'] !== null ? $ajustesLinks['facebook'] : 'javascript:;'}}" title="Facebook"><i class="icon-facebook-square"></i></a></li>
                                <li><a {{ $ajustesLinks['linkedin'] !== null ? 'target="_blank"' : '' }} href="{{ $ajustesLinks['linkedin'] !== null ? $ajustesLinks['linkedin'] : 'javascript:;'}}" title="LinkedIn"><i class="icon-linkedin-square"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-items">
                        <div class="title-area">
                            <div class="title">
                                <h1>Páginas</h1>
                            </div>
                        </div>
                        <div class="footer-content">
                            @include('components.navbar-no-switch')
                        </div>
                    </div>
                    <div class="footer-items">
                        <div class="title-area">
                            <div class="title">
                                <h1>Informações</h1>
                            </div>
                        </div>
                        <div class="footer-content">
                            <ul>
                                @if($ajustesLinks['email'] !== null)
                                    <li><a href="mailto:{{$ajustesLinks['email']}}" title="E-mail"><i class="icon-envelope-o"></i> {{ $ajustesLinks['email'] }}</a></li>
                                @endif
                                @if($ajustesLinks['enderecos'] !== null)
                                    <li><a href="{{ $ajustesLinks['link_endereco'] }}" title="Endereço"><i class="icon-map-pin"></i> {{ $ajustesLinks['enderecos'] }}</a></li>
                                @endif
                                @if($ajustesLinks['footer_num1'] !== null)
                                    <li><a href="{{ strlen($ajustesLinks['footer_num1']) >= 15 ? 'https://api.whatsapp.com/send?phone='.str_replace(["(", ")", "-", " "], "", $ajustesLinks['footer_num1']) : 'tel:'.str_replace(["(", ")", "-", " "], "", $ajustesLinks['footer_num1']) }}" title="Número de contato">{!! strlen($ajustesLinks['footer_num1']) >= 15 ? '<i class="icon-whatsapp"></i> '.$ajustesLinks['footer_num1'] : '<i class="icon-phone"></i> '.$ajustesLinks['footer_num1'] !!}</a></li>
                                @endif
                                @if($ajustesLinks['footer_num2'] !== null)
                                    <li><a href="{{ strlen($ajustesLinks['footer_num2']) >= 15 ? 'https://api.whatsapp.com/send?phone='.str_replace(["(", ")", "-", " "], "", $ajustesLinks['footer_num2']) : 'tel:'.str_replace(["(", ")", "-", " "], "", $ajustesLinks['footer_num2']) }}" title="Número de contato">{!! strlen($ajustesLinks['footer_num2']) >= 15 ? '<i class="icon-whatsapp"></i> '.$ajustesLinks['footer_num2'] : '<i class="icon-phone"></i> '.$ajustesLinks['footer_num2'] !!}</a></li>
                                @endif
                                @if($ajustesLinks['endereco'] !== null)
                                        <li><a href="{{ $ajustesLinks['link_endereco'] }}" title="Número de contato">{!! '<i class="icon-map-marker"></i>'.$ajustesLinks['endereco'] !!}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="footer-items">
                        <div class="logo-area">
                            <figure>
                                <img src="{{ URL::to('img/logo-navbar.webp') }}" alt="Logo">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container-full">
                <div class="container-static">
                    <div class="copyright-wrapper">
                        <h1>&copy; Desenvolvido por Azura soluções digitais</h1>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @include('includes.splideCss')
    <script src="{{ URL::to('libs/splide-2.4.21/dist/js/splide.min.js') }}"></script>
    <script src="{{ URL::to('js/util.js') }}"></script>
</body>
</html>
