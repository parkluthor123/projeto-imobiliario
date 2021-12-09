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
                <form action="{{ url('/admin/imoveis/update/')."/".$imoveis['id'] }}" method="POST" enctype="multipart/form-data">
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
                        <textarea name="descricao" id="descricao" required style="resize: none" placeholder="Digite a decrição (opcional)">{{ $imoveis['descricao'] }}</textarea>
                    </div>
                    <div class="form-item">
                        <label for="nome">Nome completo</label>
                        <input type="text" value="{{ $imoveis['nome'] }}" required placeholder="Digite o nome completo" id="nome" name="nome">
                    </div>
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input type="text" value="{{ $imoveis['email'] }}" required placeholder="Digite seu e-mail" id="email" name="email">
                    </div>
                    <div class="form-item">
                        <label for="phone">Telefone</label>
                        <input type="text" required value="{{ $imoveis['phone'] }}" maxlength="15" placeholder="Digite seu telefone" id="phone" name="phone">
                    </div>
                    <div class="form-item">
                        <label for="cpf">CPF</label>
                        <input type="text" required value="{{ $imoveis['cpf'] }}" maxlength="14" placeholder="Digite seu CPF" id="cpf" name="cpf">
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="qtd_quartos">Quantidade de quartos</label>
                            <input type="number" value="{{ $imoveis['qtd_quartos'] }}" required placeholder="Digite a quantidade de quartos" id="qtd_quartos" name="qtd_quartos">
                        </div>
                        <div class="form-item">
                            <label for="m_quadrados">Metros quadrados</label>
                            <input type="number" value="{{ $imoveis['metros_quadrados'] }}" required placeholder="Metros quadrados" id="m_quadrados" name="m_quadrados">
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="valor">Valor do imóvel</label>
                        <input type="text" required value="{{ $imoveis['valor'] }}" maxlength="16" placeholder="Digite o valor do imóvel" id="valor" name="valor">
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="endereco">Endereço</label>
                            <input type="text" value="{{ $imoveis['endereco'] }}" required placeholder="Digite o endereço" id="endereco" name="endereco">
                        </div>
                        <div class="form-item">
                            <label for="cep">CEP </label>
                            <input type="text" value="{{ $imoveis['cep'] }}" required placeholder="CEP" maxlength="8" id="cep" name="cep">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="num">Número </label>
                            <input type="text" value="{{ $imoveis['num'] }}" required placeholder="N°" id="num" name="num">
                        </div>
                        <div class="form-item">
                            <label for="estados">Estado </label>
                            <select name="estado" id="estados" onchange="estadoAjax(this.value, '{{ route('adm.imoveis.estados.ajax') }}')">
                                <option value="{{ $ufSelected->id_estados }}" selected hidden>{{ $ufSelected->estados }}</option>
                                @foreach($estados as $uf)
                                    <option value="{{ $uf['id'] }}">{{ $uf['estados'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="cidade">Cidade </label>
                            <input type="text" value="{{ $imoveis['cidade'] }}" placeholder="Digite a cidade" id="cidade" name="cidade">
                        </div>
                        <div class="form-item">
                            <label for="bairros">Bairro </label>
                            <select name="bairro" id="bairros" required>
                                <option value="{{ $bairroSelected->id_bairros }}" selected hidden>{{ $bairroSelected->bairros }}</option>
                                @foreach($bairro as $bairros)
                                    <option value="{{ $bairros['id'] }}">{{ $bairros['bairros'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="categoria">Categoria</label>
                        <select name="categoria" id="categoria" required>
                            <option value="{{ $tipoImovelSelected->id }}" selected hidden>{{ $tipoImovelSelected->tipo }}</option>
                            @foreach($tipoImovel as $tipo)
                                <option value="{{ $tipo['id'] }}">{{ $tipo['tipo'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="map-link" style="display: flex;">Link google Maps&nbsp; <i class="icon-question-circle map-link-helper" data-text="No Google Maps. Clique em Compartilhar e pegue o link de compartilhamento, e cole aqui!"></i></label>
                        <input type="text" value="{{ $imoveis['link_map'] }}" placeholder="Cole o link do Google Maps" id="mapLink" name="mapLink">
                    </div>
                    <br>
                    <br>
                    <fieldset data-fieldset="O que você deseja fazer?">
                        <div class="form-wrapp">
                            <div class="form-radio">
                                <label for="comprar">Vender</label>
                                <input type="radio" value="comprar" id="comprar" {{ $imoveis['status'] === 'comprar' ? 'checked' : '' }} name="options_imovel">
                            </div>
                            <div class="form-radio">
                                <label for="alugar">Alugar</label>
                                <input type="radio" value="alugar" id="alugar" {{ $imoveis['status'] === 'alugar' ? 'checked' : '' }} name="options_imovel">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-item">
                        <label for="sobre">Sobre o imóvel</label>
                        <textarea name="sobre" id="sobre" placeholder="Digite o texto sobre o imóvel (opcional)">{{ $imoveis['sobre'] }}</textarea>
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
        const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
    </script>
    <script>
        const phone = document.querySelector("#phone");
        const cpf = document.querySelector("#cpf");
        const cepValue = document.querySelector("#cep");
        const estados = document.querySelector("#estados");
        const valor = document.querySelector("#valor");

        estadoAjax(estados.value, '{{ route('adm.imoveis.estados.ajax') }}')

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

        let cleave = new Cleave(valor, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

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

        const dataFile = {
            input:(el)=>{
                if(el.files.length > 0)
                {
                    const label = el.parentNode.firstElementChild;
                    label.innerHTML = "";
                    label.innerHTML = `<p style="color: lawngreen">Adicionado&nbsp;<i style="color: lawngreen" class="icon-check"></i></p>`;
                }
            },
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
                bairros.innerHTML = ``;
                Object.values(responseJson).map((data)=>(
                    bairros.options.add(new Option(data.bairros, data.id))
                ))
                Array.from(bairros.options).map((select)=>{
                    select.value === '{{ $bairroSelected->id_bairros }}' ? select.selected = true : select.selected = false
                })
            })
        }

        getCep(cepValue, {...data});
    </script>
@endsection
