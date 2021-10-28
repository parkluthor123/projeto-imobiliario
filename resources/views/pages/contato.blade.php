@extends('layouts.site')
@section('title', 'Imobiliária')
@section('nav-contato', 'navbar-active')
@section('content')
<link rel="stylesheet" href="{{ URL::to('css/contato/contato.css') }}">
@include('components.bannerTop')

<section class="contato-area">
    @include('components.title-section')
    <div class="container-full">
        <div class="container-static">
            <div class="contato-wrapper">
                <div class="contato-items">
                    <div class="image-area">
                        <span></span>
                        <figure>
                            <img id="img-contato" src="{{ URL::to('img/contato/window-image.webp') }}" alt="Entre em contato">
                        </figure>
                    </div>
                    <div class="description-area">
                        <h2>"Se há foco, há esforço. Se há esforço, <br>há resultado"</h2>
                        <p>Douglas Liandi</p>
                    </div>
                </div>
                <div class="contato-items">
                    <form action="#" method="POST">
                        @csrf
                        <div class="title-area">
                            <p>Entre em contato conosco preenchendo o formulário abaixo. Teremos todo o prazer em tirar todas as dúvidas a respeito de locação, termos burocráticos, entre outros.</p>
                        </div>
                        <div class="form-items">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" value="{{ old('nome') }}" name="nome" placeholder="Digite o seu nome">
                        </div>
                        <div class="form-items">
                            <label for="email">E-mail</label>
                            <input type="text" id="email" value="{{ old('email') }}" name="email" placeholder="Digite o seu e-mail">
                        </div>
                        <div class="form-items">
                            <label for="phone">Telefone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Digite o seu telefone/whatsapp">
                        </div>
                        <div class="form-items">
                            <label for="assunto">Assunto</label>
                            <input type="text" id="assunto" name="assunto" value="{{ old('assunto') }}" placeholder="Digite o seu assunto">
                        </div>
                        <div class="form-items">
                            <label for="mensagem">Mensagem</label>
                            <textarea name="mensagem" id="mensagem" placeholder="Digite sua mensagem">{{ old('assunto') }}</textarea>
                        </div>
                        <div class="btn-area">
                            <button type="submit" name="enviar">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="box-contact-area">
    <div class="container-full">
        <div class="container-static">
            <div class="box-contact-wrapper">
                <div class="box-contact-items">
                    <i class="icon-instagram"></i>
                    <h2>Instagram</h2>
                </div>
                <div class="box-contact-items">
                    <i class="icon-facebook-square"></i>
                    <h2>Facebook</h2>
                </div>
                <div class="box-contact-items">
                    <i class="icon-linkedin-square"></i>
                    <h2>LinkedIn</h2>
                </div>
                <div class="box-contact-items">
                    <i class="icon-whatsapp"></i>
                    <h2>WhatsApp</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="map-area">
    <div class="title-area">
        <div class="title">
            <h1>Nosso endereço</h1>
        </div>
    </div>
    <div class="container-full">
        <div class="container-static">
            <div class="map-wrapper">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3659.4073660435483!2d-46.69439178502367!3d-23.481832284722405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cef9b82d191b8d%3A0x98b2f36a71a7795a!2sR.%20Parapu%C3%A3%2C%20309%20-%20Freguesia%20do%20%C3%93%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2002831-000!5e0!3m2!1spt-BR!2sbr!4v1634091077447!5m2!1spt-BR!2sbr" width="100%" height="579" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>
<script>
    const bannerTop = new setBannerTop("Entre em contato conosco<br> e alcance seus objetivos", "Contato");
    const title = new setTitleSection(".contato-area", "Contato");

    const getImageHeight = document.querySelector("#img-contato").clientHeight;
    const imageWrapper = document.querySelector(".image-area");
    imageWrapper.style.cssText = "max-height: "+getImageHeight+"px";

</script>
@endsection
