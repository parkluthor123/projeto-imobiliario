@extends('layouts.site')
@section('title', 'Imobiliária')
@section('nav-contato', 'navbar-active')
@section('content')
<link rel="stylesheet" href="{{ URL::to('css/contato/contato.css') }}">
@include('components.bannerTop')
@include('components.message')
@include('components.messageCallback')
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
                    <form action="{{ route('contato.sendData') }}" method="POST">
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
                            <input type="text" id="phone" name="phone" maxlength="15" value="{{ old('phone') }}" placeholder="Digite o seu telefone/whatsapp">
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

                <a {{ $ajustes['instagram'] !== null ? 'target="_blank"' : '' }} href="{{ $ajustes['instagram'] !== null ? $ajustes['instagram'] : 'javascript:;' }}">
                    <div class="{{ $ajustes['instagram'] !== null ? 'box-contact-items' : 'box-contact-items box-disabled' }}">
                        <i class="icon-instagram"></i>
                        <h2>Instagram</h2>
                    </div>
                </a>

                <a {{ $ajustes['facebook'] !== null ? 'target="_blank"' : '' }}  href="{{ $ajustes['facebook'] !== null ? $ajustes['facebook'] : 'javascript:;' }}">
                    <div class="{{ $ajustes['facebook'] !== null ? 'box-contact-items' : 'box-contact-items box-disabled' }}">
                        <i class="icon-facebook-square"></i>
                        <h2>Facebook</h2>
                    </div>
                </a>

                <a {{ $ajustes['linkedin'] !== null ? 'target="_blank"' : '' }}  href="{{ $ajustes['linkedin'] !== null ? $ajustes['linkedin'] : 'javascript:;' }}">
                    <div class="{{ $ajustes['linkedin'] !== null ? 'box-contact-items' : 'box-contact-items box-disabled' }}">
                        <i class="icon-linkedin-square"></i>
                        <h2>LinkedIn</h2>
                    </div>
                </a>

                <a {{ $ajustes['topbar_num'] !== null ? 'target="_blank"' : '' }} href="{{ $ajustes['topbar_num'] !== null ? 'https://api.whatsapp.com/send?phone='.str_replace(["(", ")", "-", " "], "", $ajustes['topbar_num'] ) : 'javascript:;' }}">
                    <div class="{{ $ajustes['topbar_num'] !== null ? 'box-contact-items' : 'box-contact-items box-disabled' }}">
                        <i class="icon-whatsapp"></i>
                        <h2>WhatsApp</h2>
                    </div>
                </a>
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
                @if($ajustes['iframe'] !== null)
                    {!! $ajustes['iframe'] !!}
                @else
                    <h1 style="text-transform:uppercase;
                        text-align: center;
                        margin: 60px 0;
                        font-size: 24px"><i style="font-size: 22px; padding-right: 15px" class="icon-map-marker"></i>{{ $ajustes['endereco'] }}</h1>
                @endif
            </div>
        </div>
    </div>
</section>
<script>
    const bannerTop = new setBannerTop("Entre em contato conosco<br> e alcance seus objetivos", "Contato");
    const title = new setTitleSection(".contato-area", "Contato");
    const phone = document.querySelector("#phone");
    function formatTel(v){
        v = v.replace(/[^\d]/g, "");
        v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
        v = v.replace(/(\d)(\d{4})$/, "$1-$2");
        return v;
    }

    phone.addEventListener("keyup",()=>{
        this.phone.value = formatTel(this.phone.value);
    });

    const getImageHeight = document.querySelector("#img-contato").clientHeight;
    const imageWrapper = document.querySelector(".image-area");
    imageWrapper.style.cssText = "max-height: "+getImageHeight+"px";

</script>
@endsection
