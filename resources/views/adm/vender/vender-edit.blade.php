@extends('adm.layouts.site')
@section('content')
    @include('components.messageCallback')
    @include('components.message')
    <section class="container-admin">
        @include('components.adm.sidebar')
        <section class="form-content-area">
            @include('components.adm.topbar')
            @include('components.adm.titlePage')
            @include('components.adm.backBtn')
            <div class="form-content-wrapper">
                <form action="{{ url('/admin/vender/update/')."/".$vender['id'] }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="nome">Nome completo</label>
                        <input type="text" value="{{ $vender['nome'] }}" required placeholder="Digite o nome completo" id="nome" name="nome">
                    </div>
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input type="text" value="{{ $vender['email'] }}" required placeholder="Digite seu e-mail" id="email" name="email">
                    </div>
                    <div class="form-item">
                        <label for="phone">Telefone</label>
                        <input type="text" required value="{{ $vender['phone'] }}" maxlength="15" placeholder="Digite seu telefone" id="phone" name="phone">
                    </div>
                    <div class="form-item">
                        <label for="tipo_imovel">Tipo de imóvel</label>
                        <select name="tipo_imovel" id="tipo_imovel">
                            <option value="apto" {{ $vender['tipo_imovel'] == 'apto' ? "selected" : "" }}>Apartamento</option>
                            <option value="casa" {{ $vender['tipo_imovel'] == 'casa' ? "selected" : "" }}>Casa</option>
                            <option value="comercial" {{ $vender['tipo_imovel'] == 'comercial' ? "selected" : "" }}>Comercial</option>
                            <option value="hotel" {{ $vender['tipo_imovel'] == 'hotel' ? "selected" : "" }}>Hotel</option>
                            <option value="galpao" {{ $vender['tipo_imovel'] == 'galpao' ? "selected" : "" }}>Galpão</option>
                            <option value="loteamento" {{ $vender['tipo_imovel'] == 'loteamento' ? "selected" : "" }}>Loteamento</option>
                            <option value="terreno" {{ $vender['tipo_imovel'] == 'terreno' ? "selected" : "" }}>Terreno</option>
                        </select>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="endereco">Endereço</label>
                            <input type="text" value="{{ $vender['endereco'] }}" required placeholder="Digite o endereço" id="endereco" name="endereco">
                        </div>
                        <div class="form-item">
                            <label for="cep">CEP</label>
                            <input type="text" value="{{ $vender['cep'] }}" required placeholder="CEP" maxlength="8" id="cep" name="cep">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="bairro">Bairro</label>
                            <input type="text" value="{{ $vender['bairro'] }}" required placeholder="Digite o bairro" id="bairro" name="bairro">
                        </div>
                        <div class="form-item">
                            <label for="num">Número</label>
                            <input type="text" value="{{ $vender['num'] }}" required placeholder="N°" id="num" name="num">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="cidade">Cidade</label>
                            <input type="text" value="{{ $vender['cidade'] }}" required placeholder="Digite a cidade" id="cidade" name="cidade">
                        </div>
                        <div class="form-item" style="max-width: none;">
                            <label for="estado">Estado</label>
                            <input type="text" value="{{ $vender['uf'] }}" required placeholder="Digite o estado" id="estado" name="estado">
                        </div>
                    </div>
                    <div class="btn-area">
                        <button type="submit" title="Salvar">Salvar</button>
                    </div>
                </form>
            </div>
            @include('components.adm.footerAdm')
        </section>
    </section>
    <script>
        const titlePage = new admTitlePage("Vender", "Você pode editar uma solicitação de venda existente. Insira os dados no formulário abaixo e clique em salvar.")
        const back = new setBackLink("{{ route('adm.vender.show') }}");
    </script>
    <script>
        const phone = document.querySelector("#phone");
        const cepValue = document.querySelector("#cep");
        const frmPassword = document.querySelector("#formPassword");
        const frmSubmit = document.querySelector("#frmPassSubmit");
        const cancelButton = document.querySelector("#closePasswordChange");
        const modal = document.querySelector(".modal-change-password");
        const openModal = document.querySelector("#changeBtn");
        const boxMessage = document.querySelector(".successMessagePassword");
        const boxMessageInside = document.querySelector(".messagePassword");

        const data = {
            endereco: document.querySelector("#endereco"),
            cidade: document.querySelector("#cidade"),
            estado: document.querySelector("#estado"),
            bairro: document.querySelector("#bairro"),
        }

        function formatTel(v){
            v = v.replace(/[^\d]/g, "");
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
