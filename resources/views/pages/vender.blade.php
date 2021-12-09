@extends('layouts.site')
@section('title', 'Imobiliária')
@section('nav-vender', 'navbar-active')
@section('content')
    {{-- Meta tags dinâmicas --}}
@section('keywords', 'Teste')
@section('description', 'Teste')
<link rel="stylesheet" href="{{ URL::to('css/vender/vender.css') }}">
@include('components.bannerTop')
@include('components.message')
@include('components.messageCallback')
<section class="vender-area">
    @include('components.title-section')
    <div class="container-full">
        <div class="container-static">
            <div class="vender-wrapper">
                <div class="vender-items">
                    <div class="title-area">
                        <div class="title">
                            <h1>Venda seu imóvel conosco com<br>facilidade e agilidade</h1>
                        </div>
                    </div>
                    <div class="content">
                        <p>Vender seu imóvel nunca foi tão fácil, sabemos o quanto isso pode ser cansativo, porém temos todo o suporte e agilidade para auxiliar você neste processo. Temos toda a experiência necessária para te ajudar a vender seu imóvel com segurança e rentabilidade.</p>
                    </div>
                    <div class="image-area">
                        <figure>
                            <img src="{{ URL::to('img/vender/imobiliaria-vender-image.webp') }}" alt="Imobiliária">
                        </figure>
                    </div>
                </div>
                <div class="vender-items">
                    <form action="{{ route('vender.send') }}" method="POST">
                        @csrf
                        <div class="title-area">
                            <div class="title">
                                <p>Preencha os campos abaixo com suas informações:</p>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="nome">Nome completo</label>
                            <input type="text" required placeholder="Digite o nome completo" id="nome" name="nome">
                        </div>
                        <div class="form-item">
                            <label for="email">E-mail</label>
                            <input type="text" required placeholder="Digite seu e-mail" id="email" name="email">
                        </div>
                        <div class="form-item">
                            <label for="phone">Telefone</label>
                            <input type="text" required maxlength="15" placeholder="Digite seu telefone" id="phone" name="phone">
                        </div>
                        <div class="form-item">
                            <label for="tipo_imovel">Tipo de imóvel</label>
                            <select name="tipo_imovel" id="tipo_imovel">
                                <option value="apto">Apartamento</option>
                                <option value="casa">Casa</option>
                                <option value="comercial">Comercial</option>
                                <option value="hotel">Hotel</option>
                                <option value="galpao">Galpão</option>
                                <option value="loteamento">Loteamento</option>
                                <option value="terreno">Terreno</option>
                            </select>
                        </div>
                        <div class="form-wrapp">
                            <div class="form-item">
                                <label for="endereco">Endereço</label>
                                <input type="text" required placeholder="Digite o endereço" id="endereco" name="endereco">
                            </div>
                            <div class="form-item">
                                <label for="cep">CEP</label>
                                <input type="text" required placeholder="CEP" maxlength="8" id="cep" name="cep">
                            </div>
                        </div>
                        <div class="form-wrapp">
                            <div class="form-item">
                                <label for="bairro">Bairro</label>
                                <input type="text" required placeholder="Digite o bairro" id="bairro" name="bairro">
                            </div>
                            <div class="form-item">
                                <label for="num">Número</label>
                                <input type="text" required placeholder="N°" id="num" name="num">
                            </div>
                        </div>
                        <div class="form-wrapp">
                            <div class="form-item">
                                <label for="cidade">Cidade</label>
                                <input type="text" required placeholder="Digite a cidade" id="cidade" name="cidade">
                            </div>
                            <div class="form-item" style="max-width: none;">
                                <label for="estado">Estado</label>
                                <input type="text" required placeholder="Digite o estado" id="estado" name="estado">
                            </div>
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
<section class="vantagens-area">
    <div class="container-full">
        <div class="container-static">
            <div class="title-area">
                <div class="title">
                    <h1>Principais vantagens de<br>vender com a gente</h1>
                </div>
            </div>
            <div class="vantagens-wrapper">
                <div class="vantagens-items">
                    <div class="box-vantatgens">
                        <i class="icon-handshake-o"></i>
                        <div class="content">
                            <h1>Confiança</h1>
                            <p>Acreditamos que a confiança é a base de tudo, pois é para ela que entregamos nossos sonhos e acreditamos que possamos realiza-los.</p>
                        </div>
                    </div>
                </div>
                <div class="vantagens-items">
                    <div class="box-vantatgens">
                        <i class="icon-hand-holding-heart"></i>
                        <div class="content">
                            <h1>Responsabilidade</h1>
                            <p>Temos a responsabilidade de te entregar o melhor serviço, o melhor resultado, pois o seu sonho é nosso sonho.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="consultores-area">
    <div class="container-full">
        <div class="container-static">
            <div class="title-area">
                <div class="title">
                    <h1>Ou se preferir, converse com<br>nossos corretores</h1>
                </div>
            </div>
            <div class="consultores-wrapper">
                <div class="consultores-items">
                    <div class="content">
                        <p>Você pode optar por conversar diretamente com nossos corretores. Tenha um atendimento rápido e prático, tire suas dúvidas à respeito de locação ou até mesmo venda de imóveis, estamos sempre à sua disposição. Nosso objetivo é sempre ajudar você a realizar seu sonho.</p>
                        <div class="btn-area">
                            <p>Entre em contato pelo Whatsapp</p>
                            <a {{ $ajustes['topbar_num'] !== null ? 'target="_blank"' : '' }} href="{{ $ajustes['topbar_num'] !== null ? 'https://api.whatsapp.com/send?phone='.str_replace(["(", ")", "-", " "], "", $ajustes['topbar_num']) : 'javascript:;' }}" title="Conversar com corretor"><i class="icon-whatsapp"></i> Conversar com corretor</a>
                        </div>
                    </div>
                </div>
                <div class="consultores-items">
                    <div class="image-area">
                        <figure>
                            <img src="{{ URL::to('img/vender/imobiliaria-corretores-image.webp') }}" alt="Conheça corretores">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const bannerTop = new setBannerTop("Anuncie e venda seu imóvel de<br> maneira rápida e segura", "Vender");
    const title = new setTitleSection(".vender-area", "Vender");
    const phone = document.querySelector("#phone");
    const cepValue = document.querySelector("#cep");

    const data = {
        endereco: document.querySelector("#endereco"),
        cidade: document.querySelector("#cidade"),
        estado: document.querySelector("#estado"),
        bairro: document.querySelector("#bairro"),
    }

    function formatTel(v){
        v = v.replace(/\D/g, "");
        v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
        v = v.replace(/(\d)(\d{4})$/, "$1-$2");
        return v;
    }

    phone.addEventListener("keyup",()=>{
        this.phone.value = formatTel(this.phone.value);
    });

    function getCep(cep, obj)
    {
        let cepValue = cep;
        this.endereco = obj.endereco || '';
        this.cidade = obj.cidade || '';
        this.estado = obj.estado || '';
        this.bairro = obj.bairro || '';

        if(cepValue.value !== null || cepValue != '')
        {
            cepValue.addEventListener("keyup",()=>{
                if((cepValue.value).toString().length < 9 && (cepValue.value).toString().length > 7) {
                    setTimeout(async () => {
                        await fetch(`https://viacep.com.br/ws/${cepValue.value}/json/`, {
                            method: 'GET',
                            headers: {
                                'content-type': 'application/json',
                                'Accept': 'application/json',
                            }
                        })
                            .then((response) => response.json())
                            .then((responseCep) => {
                                if(responseCep.erro == true)
                                {
                                    return false;
                                }
                                else
                                {
                                    endereco.value = responseCep.logradouro;
                                    cidade.value = responseCep.localidade;
                                    estado.value = responseCep.uf;
                                    bairro.value = responseCep.bairro;
                                }
                            })
                    }, 100)
                }

            })
        }
        else
        {
            console.error("Insira o CEP corretamente");
        }

    }

    getCep(cepValue, {...data});

</script>
@endsection
