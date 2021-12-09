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
                <div class="btn-form">
                    <a href="{{ url('/admin/clientes/editar/'.$clientes['id'].'/mensalidades') }}" title="Mensalidades">
                        <p>Mensalidades</p>
                    </a>
                    <a href="{{ url('/admin/clientes/editar/'.$clientes['id'].'/contratos') }}" title="Contratos">
                        <p>Contrato</p>
                    </a>
                </div>
            </div>
            <div class="form-content-wrapper">
                <form action="{{ url('/admin/clientes/update/').'/'.$clientes['id'] }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="nome">Nome completo</label>
                        <input type="text" value="{{ $clientes['name'] }}" required placeholder="Digite o nome completo" id="nome" name="nome">
                    </div>
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input type="text" value="{{ $clientes['email'] }}" required placeholder="Digite seu e-mail" id="email" name="email">
                    </div>
                    <div class="form-item">
                        <label for="phone">Telefone</label>
                        <input type="text" required value="{{ $clientes['phone'] }}" maxlength="15" placeholder="Digite seu telefone" id="phone" name="phone">
                    </div>
                    <div class="form-item">
                        <label for="cpf">CPF</label>
                        <input type="text" required value="{{ $clientes['cpf'] }}" maxlength="14" placeholder="Digite seu CPF" id="cpf" name="cpf">
                    </div>
                    <div class="form-item">
                        <label for="tipo_imovel" >Renda</label>
                        <select name="renda" id="renda">
                            <option value="1" {{ $clientes['renda'] == 1 ? "selected" : "" }}>De R$ 1500 a R$ 2500</option>
                            <option value="2" {{ $clientes['renda'] == 2 ? "selected" : "" }}>De R$ 3000 a R$ 4500</option>
                            <option value="3" {{ $clientes['renda'] == 3 ? "selected" : "" }}>De R$ 5000 a R$ 10.000</option>
                            <option value="4" {{ $clientes['renda'] == 4 ? "selected" : "" }}>Acima de 10.000</option>
                        </select>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="endereco">Endereço</label>
                            <input type="text" value="{{ $clientes['endereco']  }}" required placeholder="Digite o endereço" id="endereco" name="endereco">
                        </div>
                        <div class="form-item">
                            <label for="cep">CEP</label>
                            <input type="text" value="{{ $clientes['cep'] }}" required placeholder="CEP" maxlength="8" id="cep" name="cep">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="bairro">Bairro</label>
                            <input type="text" value="{{ $clientes['bairro'] }}" required placeholder="Digite o bairro" id="bairro" name="bairro">
                        </div>
                        <div class="form-item">
                            <label for="num">Número</label>
                            <input type="text" value="{{ $clientes['num'] }}" required placeholder="N°" id="num" name="num">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="cidade">Cidade</label>
                            <input type="text" value="{{ $clientes['cidade'] }}" required placeholder="Digite a cidade" id="cidade" name="cidade">
                        </div>
                        <div class="form-item" style="max-width: none;">
                            <label for="estado">Estado</label>
                            <input type="text" value="{{ $clientes['uf'] }}" required placeholder="Digite o estado" id="estado" name="estado">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <div class="form-item">
                            <label for="cidade">Nova senha</label>
                            <input type="password" placeholder="Digite a nova senha" id="password" name="password">
                        </div>
                        <div class="form-item" style="max-width: none;">
                            <label for="estado">Confirmar senha</label>
                            <input type="password" placeholder="Confirme a nova senha" id="conf_senha" name="conf_senha">
                        </div>
                    </div>
                    <div class="form-wrapp">
                        <span style="display: flex; justify-content: center; color: #b22">Obs* Se não quiser alterar a senha, deixar em branco.</span>
                    </div>
                    <div class="btn-area">
                        <button type="submit" title="Salvar">Salvar</button>
                    </div>
                </form>
            </div>
            @include('components.adm.footerAdm')
        </section>
        <script>
            const titlePage = new admTitlePage("Clientes", "Você pode editar um cliente existente. Insira os dados no formulário abaixo e clique em salvar.")
            const back = new setBackLink("{{ route('adm.clientes.show') }}");
        </script>
        <script>
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

            phone.addEventListener("keyup",()=>{
                this.phone.value = formatTel(this.phone.value);
            });

            cpf.addEventListener("keyup", ()=>{
                this.cpf.value = formatCPF(this.cpf.value);
            })

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
</section>

