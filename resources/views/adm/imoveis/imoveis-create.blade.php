@extends('adm.layouts.site')
@section('content')
    <style>
        fieldset
        {
            max-width: none;
        }
        fieldset a
        {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: var(--full);
            background-color: var(--marrom-25);
            color: #fff;
            min-height: 40px;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
            border: 2px solid var(--marrom-75);
            text-transform: uppercase;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        fieldset a:hover
        {
            transition: all 0.3s ease-in-out;
            letter-spacing: 2px;
        }
    </style>
    @include('components.messageCallback')
    @include('components.message')
    <section class="container-admin">
        @include('components.adm.sidebar')
        <section class="form-content-area">
            @include('components.adm.topbar')
            @include('components.adm.titlePage')
            @include('components.adm.backBtn')
            <div class="form-content-wrapper">
                <form action="{{ route('adm.imoveis.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset data-fieldset="Cadastrar localidades">
                        <a href="{{ route('adm.localidades.estados.show') }}" title="Estados">Estados</a>
                        <a href="{{ route('adm.localidades.bairros.show') }}" title="Bairros">Bairros</a>
                    </fieldset>
                    <br>
                    <br>
                    <fieldset data-fieldset="Cadastrar tipos de imóveis">
                        <a href="{{ route('adm.tipo-imovel.show') }}" title="Tipos de imóveis">Tipos de Imóveis</a>
                    </fieldset>
                    <div class="form-item">
                        <label for="descricao">Descrição</label>
                        <textarea name="descricao" id="descricao" required style="resize: none" placeholder="Digite a decrição"></textarea>
                    </div>
                    <div class="form-item">
                        <label for="nome">Nome completo</label>
                        <input type="text" value="{{ old('nome') }}" required placeholder="Digite o nome completo" id="nome" name="nome">
                    </div>
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input type="text" value="{{ old('email') }}" required placeholder="Digite seu e-mail" id="email" name="email">
                    </div>
                    <div class="form-item">
                        <label for="phone">Telefone</label>
                        <input type="text" required value="{{ old('phone') }}" maxlength="15" placeholder="Digite seu telefone" id="phone" name="phone">
                    </div>
                    <div class="form-item">
                        <label for="cpf">CPF</label>
                        <input type="text" required value="{{ old('cpf') }}" maxlength="14" placeholder="Digite seu CPF" id="cpf" name="cpf">
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="qtd_quartos">Quantidade de quartos</label>
                            <input type="number" value="{{ old('qtd_quartos') }}" required placeholder="Digite a quantidade de quartos" id="qtd_quartos" name="qtd_quartos">
                        </div>
                        <div class="form-item">
                            <label for="m_quadrados">Metros quadrados</label>
                            <input type="number" value="{{ old('m_quadrados') }}" required placeholder="Metros quadrados" id="m_quadrados" name="m_quadrados">
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="valor">Valor do imóvel</label>
                        <input type="text" required value="{{ old('valor') }}" maxlength="16" placeholder="Digite o valor do imóvel" id="valor" name="valor">
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="endereco">Endereço</label>
                            <input type="text" value="{{ old('endereco') }}" required placeholder="Digite o endereço" id="endereco" name="endereco">
                        </div>
                        <div class="form-item">
                            <label for="cep">CEP </label>
                            <input type="text" value="{{ old('cep') }}" required placeholder="CEP" maxlength="8" id="cep" name="cep">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="num">Número </label>
                            <input type="text" value="{{ old('num') }}" required placeholder="N°" id="num" name="num">
                        </div>
                        <div class="form-item">
                            <label for="estados">Estado </label>
                            <select name="estado" id="estados" onchange="estadoAjax(this.value, '{{ route('adm.imoveis.estados.ajax') }}')" required>
                                <option value="" selected disabled hidden>Selecione algum estado</option>
                                @foreach($estados as $uf)
                                    <option value="{{ $uf['id'] }}">{{ $uf['estados'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="cidade">Cidade </label>
                            <input type="text" value="{{ old('cidade') }}" required placeholder="Digite a cidade" id="cidade" name="cidade">
                        </div>
                        <div class="form-item">
                            <label for="bairros">Bairro </label>
                            <select name="bairro" id="bairros" disabled required>
                                <option selected disabled hidden>Selecione algum bairro</option>
                                @foreach($bairro as $bairros)
                                    <option value="{{ $bairros['id'] }}">{{ $bairros['bairros'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="categoria">Categoria</label>
                        <select name="categoria" id="categoria" required>
                            <option selected disabled hidden>Selecione alguma categoria de imóvel</option>
                            @foreach($tipoImovel as $tipo)
                                <option value="{{ $tipo['id'] }}">{{ $tipo['tipo'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="map-link" style="display: flex;">Link google Maps&nbsp; <i class="icon-question-circle map-link-helper" data-text="No Google Maps. Clique em Compartilhar e pegue o link de compartilhamento, e cole aqui!"></i></label>
                        <input type="text" value="{{ old('mapLink') }}" placeholder="Cole o link do Google Maps" id="mapLink" name="mapLink">
                    </div>
                    <br>
                    <br>
                    <fieldset data-fieldset="O que você deseja fazer?">
                        <div class="form-wrapp">
                            <div class="form-radio">
                                <label for="comprar">Vender</label>
                                <input type="radio" value="comprar" id="comprar" name="options_imovel">
                            </div>
                            <div class="form-radio">
                                <label for="alugar">Alugar</label>
                                <input type="radio" value="alugar" id="alugar" name="options_imovel">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-item">
                        <label for="sobre">Sobre o imóvel</label>
                        <textarea name="sobre" id="sobre" placeholder="Digite o texto sobre o imóvel (opcional)"></textarea>
                    </div>
                    <div class="btn-area">
                        <button type="submit" title="Salvar">Salvar</button>
                    </div>
                </form>
            </div>
            @include('components.adm.footerAdm')
        </section>
    </section>

    <script src="{{ URL::to('libs/cleaverjs/cleave.min.js') }}"></script>
    <script>
        const titlePage = new admTitlePage("Imóveis", "Você pode cadastrar um novo imóvel. Insira os dados no formulário abaixo e clique em salvar.")
        const back = new setBackLink("{{ route('adm.imoveis.show') }}");
    </script>
    <script>
        const phone = document.querySelector("#phone");
        const cpf = document.querySelector("#cpf");
        const cepValue = document.querySelector("#cep");
        const valor = document.querySelector("#valor");
        const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        const data = {
            endereco: document.querySelector("#endereco"),
            cidade: document.querySelector("#cidade"),
            cpf: document.querySelector("#cpf"),
        }

        function formatTel(v){
            v = v.replace(/[^\d]/g, "");
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
            v = v.replace(/(\d)(\d{4})$/, "$1-$2");
            return v;
        }

        let cleave = new Cleave(valor, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

        function formatCPF(el)
        {
            el = el.replace(/[^\d]/g, "");
            el = el.replace(/^(\d{3})(\d{3})/g, "$1.$2.");
            el = el.replace(/(\d{3})(\d{2})$/, "$1-$2");
            return el;
        }

        phone.addEventListener("keyup",()=>{
            this.phone.value = formatTel(this.phone.value);
        });

        cpf.addEventListener("keyup", ()=>{
            this.cpf.value = formatCPF(this.cpf.value);
        });

        valor.addEventListener("keyup", ()=>{
            valor.value = setMoney(valor.value);
        })

        function getCep(cep, obj)
        {
            let cepValue = cep;
            this.endereco = obj.endereco || '';
            this.cidade = obj.cidade || '';

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
                bairros.disabled = false;
                console.log(responseJson)
                bairros.innerHTML = ``;
                Object.values(responseJson).map((data)=>(
                    bairros.options.add(new Option(data.bairros, data.id))
                ))
            })
        }

        getCep(cepValue, {...data});
    </script>
@endsection
