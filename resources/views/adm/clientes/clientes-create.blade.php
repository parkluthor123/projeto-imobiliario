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
                <form action="{{ route('adm.clientes.new') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="btn-form">
                        <div class="boleto-area" style="padding: 10px; border-radius: 10px; border: 1px solid #ccc">
                            <div class="wrapp">
                                <label for="cadBoleto">
                                    <p>Adicionar boleto (pdf)</p>
                                </label>
                                <input type="file" onchange="dataFile.boleto(this)" id="cadBoleto" name="cadBoleto">
                            </div>
                            <div class="form-wrapp">
                                <div class="form-item">
                                    <label for="descBoleto">Descrição boleto</label>
                                    <input type="text" placeholder="Digite a descrição do boleto" id="descBoleto" name="descBoleto">
                                </div>
                                <div class="form-item">
                                    <label for="descBoleto">Data de vencimento</label>
                                    <input type="date" maxlength="10" id="dataBoleto" name="dataBoleto">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="contrato-area" style="padding: 10px; border-radius: 10px; border: 1px solid #ccc">
                            <div class="wrapp">
                                <label for="cadContrato">
                                    <p>Adicionar contrato (pdf)</p>
                                </label>
                                <input type="file" onchange="dataFile.contrato(this)" id="cadContrato" name="cadContrato">
                            </div>
                            <div class="form-wrapp">
                                <div class="form-item">
                                    <label for="descBoleto">Descrição contrato</label>
                                    <input type="text" placeholder="Digite a descrição do contrato" id="descContrato" name="descContrato">
                                </div>
                                <div class="form-item">
                                    <label for="descBoleto">Data de vencimento</label>
                                    <input type="date" maxlength="10" id="dataContrato" name="dataContrato">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="nome">Nome completo</label>
                        <input type="text" value="{{ old('name') }}" required placeholder="Digite o nome completo" id="nome" name="nome">
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
                    <div class="form-item">
                        <label for="tipo_imovel" value="{{ old('renda') }}">Renda</label>
                        <select name="renda" id="renda">
                            <option value="1">De R$ 1500 a R$ 2500</option>
                            <option value="2">De R$ 3000 a R$ 4500</option>
                            <option value="3">De R$ 5000 a R$ 10.000</option>
                            <option value="4">Acima de 10.000</option>
                        </select>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="endereco">Endereço</label>
                            <input type="text" value="{{ old('endereco') }}" required placeholder="Digite o endereço" id="endereco" name="endereco">
                        </div>
                        <div class="form-item">
                            <label for="cep">CEP</label>
                            <input type="text" value="{{ old('cep') }}" required placeholder="CEP" maxlength="8" id="cep" name="cep">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="bairro">Bairro</label>
                            <input type="text" value="{{ old('bairro') }}" required placeholder="Digite o bairro" id="bairro" name="bairro">
                        </div>
                        <div class="form-item">
                            <label for="num">Número</label>
                            <input type="text" value="{{ old('num') }}" required placeholder="N°" id="num" name="num">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="cidade">Cidade</label>
                            <input type="text" value="{{ old('cidade') }}" required placeholder="Digite a cidade" id="cidade" name="cidade">
                        </div>
                        <div class="form-item" style="max-width: none;">
                            <label for="estado">Estado</label>
                            <input type="text" value="{{ old('uf') }}" required placeholder="Digite o estado" id="estado" name="estado">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="cidade">Nova senha</label>
                            <input type="password" required placeholder="Digite a nova senha" id="password" name="password">
                        </div>
                        <div class="form-item" style="max-width: none;">
                            <label for="estado">Confirmar senha</label>
                            <input type="password" required placeholder="Confirme a nova senha" id="conf_senha" name="conf_senha">
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
        const titlePage = new admTitlePage("Clientes", "Você pode cadastrar um novo cliente. Insira os dados no formulário abaixo e clique em salvar.")
    </script>
    <script>
        const dataBoleto = document.querySelector("#dataBoleto");
        const dataContrato = document.querySelector("#dataContrato");
        const phone = document.querySelector("#phone");
        const cpf = document.querySelector("#cpf");
        const cepValue = document.querySelector("#cep");
        const frmPassword = document.querySelector("#formPassword");
        const frmSubmit = document.querySelector("#frmPassSubmit");
        const cancelButton = document.querySelector("#closePasswordChange");
        const modal = document.querySelector(".modal-change-password");
        const openModal = document.querySelector("#changeBtn");
        const boxMessage = document.querySelector(".successMessagePassword");
        const boxMessageInside = document.querySelector(".messagePassword");

        const back = new setBackLink("{{ route('adm.clientes.show') }}");

        const data = {
            endereco: document.querySelector("#endereco"),
            cidade: document.querySelector("#cidade"),
            estado: document.querySelector("#estado"),
            cpf: document.querySelector("#cpf"),
            bairro: document.querySelector("#bairro"),
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

        function formatDate(el)
        {
            el = el.replace(/[^\d]/g, "");
            el = el.replace(/^(\d{2})(\d{2})/g, "$1/$2/");
            el = el.replace(/(\d{4})$/, "$1");
            return el;
        }

        phone.addEventListener("keyup",()=>{
            this.phone.value = formatTel(this.phone.value);
        });

        cpf.addEventListener("keyup", ()=>{
            this.cpf.value = formatCPF(this.cpf.value);
        });

        dataBoleto.addEventListener("keyup", ()=>{
            this.dataBoleto.value = formatDate(this.dataBoleto.value);
        });

        dataContrato.addEventListener("keyup", ()=>{
            this.dataContrato.value = formatDate(this.dataContrato.value);
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

        const dataFile = {
            boleto:(el)=>{
                if(el.files.length > 0)
                {
                    const label = el.parentNode.firstElementChild;
                    label.innerHTML = "";
                    label.innerHTML = `<p style="color: lawngreen">Adicionado&nbsp;<i style="color: lawngreen" class="icon-check"></i></p>`;

                }
            },
            contrato:(el)=>{
                if(el.files.length > 0)
                {
                    const label = el.parentNode.firstElementChild;
                    label.innerHTML = "";
                    label.innerHTML = `<p style="color: lawngreen">Adicionado&nbsp;<i style="color: lawngreen" class="icon-check"></i></p>`;
                }
            }
        }

        getCep(cepValue, {...data});

    </script>
@endsection
