@extends('layouts.site')
@section('title', 'Imobiliária')
@section('content')
    {{-- Meta tags dinâmicas --}}
@section('keywords', 'Teste')
@section('description', 'Teste')
{{-- End Meta tags dinâmicas --}}
<link rel="stylesheet" href="{{ URL::to('/css/area-restrita/style.css') }}">
@include('components.area-restrita.description-page')
@include('components.messageCallback')
<section class="ar_info-area">
    <div class="container-full">
        <div class="container-static">
            <div class="ar_info-wrapper">
                <div class="ar_info-items">
                    <form action="{{ route('area-restrita.info.do') }}" method="POST">
                        @csrf
                        <div class="form-item">
                            <label for="nome">Nome completo</label>
                            <input type="text" value="{{ $user['name'] }}" required placeholder="Digite o nome completo" id="nome" name="nome">
                        </div>
                        <div class="form-item">
                            <label for="email">E-mail</label>
                            <input type="text" value="{{ $user['email'] }}" required placeholder="Digite seu e-mail" id="email" name="email">
                        </div>
                        <div class="form-item">
                            <label for="phone">Telefone</label>
                            <input type="text" required value="{{ $user['phone'] }}" maxlength="15" placeholder="Digite seu telefone" id="phone" name="phone">
                        </div>
                        <div class="form-item">
                            <label for="cpf">CPF</label>
                            <input type="text" required value="{{ $user['cpf'] }}" maxlength="14" placeholder="Digite seu CPF" id="cpf" name="cpf">
                        </div>
                        <div class="form-item">
                            <label for="tipo_imovel" value="{{ $user['renda'] }}">Renda</label>
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
                                <input type="text" value="{{ $user['endereco'] }}" required placeholder="Digite o endereço" id="endereco" name="endereco">
                            </div>
                            <div class="form-item">
                                <label for="cep">CEP</label>
                                <input type="text" value="{{ $user['cep'] }}" required placeholder="CEP" maxlength="8" id="cep" name="cep">
                            </div>
                        </div>
                        <div class="form-wrapp">
                            <div class="form-item">
                                <label for="bairro">Bairro</label>
                                <input type="text" value="{{ $user['bairro'] }}" required placeholder="Digite o bairro" id="bairro" name="bairro">
                            </div>
                            <div class="form-item">
                                <label for="num">Número</label>
                                <input type="text" value="{{ $user['num'] }}" required placeholder="N°" id="num" name="num">
                            </div>
                        </div>
                        <div class="form-wrapp">
                            <div class="form-item">
                                <label for="cidade">Cidade</label>
                                <input type="text" value="{{ $user['cidade'] }}" required placeholder="Digite a cidade" id="cidade" name="cidade">
                            </div>
                            <div class="form-item" style="max-width: none;">
                                <label for="estado">Estado</label>
                                <input type="text" value="{{ $user['uf'] }}" required placeholder="Digite o estado" id="estado" name="estado">
                            </div>
                        </div>
                        <div class="btn-area">
                            <button type="submit" title="Salvar">Salvar</button>
                        </div>
                    </form>
                </div>
                <div class="ar_info-items">
                    <div class="change-password-area">
                        <h2>Segurança</h2>
                        <p>Caso deseje alterar sua senha, clique no botão abaixo:</p>
                        <div class="btn-area">
                            <button type="button" id="changeBtn" title="Alterar minha senha">Alterar minha senha</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal-change-password">
    <div class="modal-change">
        <span class="loading"></span>
        <form action="#" id="formPassword">
            @csrf
            <div class="form-items" id="curSenha">
                <label for="currentPassword">Senha atual</label>
                <input type="text" name="currentPassword" id="currentPassword" required placeholder="Digite a senha atual">
                <span></span>
            </div>
            <div class="form-items" id="curPass">
                <label for="newPassword">Nova senha</label>
                <input type="text" name="newPassword" id="newPassword" required placeholder="Digite a nova senha">
                <span></span>
            </div>
            <div class="form-items" id="confSenha">
                <label for="confirmSenha">Confirme senha</label>
                <input type="text" name="confirmPassword" id="confirmSenha" required placeholder="Confirme a senha">
                <span></span>
            </div>
            <div class="btn-area">
                <button type="button" id="closePasswordChange">Cancelar</button>
                <button type="submit" id="frmPassSubmit">Alterar</button>
            </div>
        </form>
    </div>
</div>

<div class="successMessagePassword">
    <div class="messagePassword">
    </div>
</div>
<script>
    const descTop = new setDescriptionPage("Informações pessoais", "Aqui ficam salvas suas informações pessoais.<br>Edite suas informações e clique em salvar.");
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


    const dataPasswordForm = {
        currentPassword: document.querySelector("#currentPassword"),
        newPassword: document.querySelector("#newPassword"),
        confirmPassword: document.querySelector("#confirmSenha"),
        setErrors: (el, message)=>{
            let parentEl = el.parentNode;
            const errorEl = document.querySelector("#"+parentEl.getAttribute("id")+" span");
            errorEl.innerHTML = message;
        }
    }
    function displayLoading(boolean)
    {
        const loading = document.querySelector(".loading");
        if(boolean == true)
        {
            loading.style.cssText = "display: block !important";
        }
        else
        {
            loading.style.cssText = "display: false !important";
        }
    }

    function setMessage(container, containerInside, message)
    {
        container.style.cssText = "display: flex;"
        containerInside.innerHTML = `<p>${message}</p>`;

        return setTimeout(()=>{
            container.style.cssText = "display: none";
        }, 4000)
    }

    function changePassword(form, obj)
    {
        const route = "{{ route('area-restrita.info.trocarSenha') }}";
        const arrData = [];

        if((obj.currentPassword.value).toString().length > 0)
        {
            this.currentPassword = obj.currentPassword;
            obj.setErrors(obj.currentPassword, null)
            arrData.push(currentPassword);
        }
        else
        {
            obj.setErrors(obj.currentPassword, "*Este campo precisa ser preenchido")
        }

        if((obj.newPassword.value).toString().length > 0)
        {
            this.newPassword = obj.newPassword;
            obj.setErrors(obj.newPassword, null);
            arrData.push(newPassword);
        }
        else
        {
            obj.setErrors(obj.newPassword, "*Este campo precisa ser preenchido")
        }

        if((obj.confirmPassword.value).toString().length > 0)
        {
            this.confirmPassword = obj.confirmPassword;
            obj.setErrors(obj.confirmPassword, null)
            arrData.push(confirmPassword);
        }
        else
        {
            obj.setErrors(obj.confirmPassword, "*Este campo precisa ser preenchido")
        }

        if(arrData.length >= 3)
        {
            displayLoading(true);
            const atualSenha = arrData[0].value;
            const novaSenha = arrData[1].value;
            const confSenha = arrData[2].value;
            const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
            fetch(route, {
                method: 'POST',
                headers:{
                    'content-type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({atualSenha, novaSenha, confSenha})
            })
            .then((response)=>response.json())
            .then((responseJson)=>{
                displayLoading(false);
                console.log(responseJson)
                if(responseJson.senha_incorreta)
                {
                    obj.setErrors(obj.currentPassword, responseJson.senha_incorreta);
                }

                if(responseJson.confSenha)
                {
                    obj.setErrors(obj.newPassword, responseJson.confSenha);
                    obj.setErrors(obj.confirmPassword, responseJson.confSenha);
                }
                if(responseJson.success)
                {
                    setMessage(boxMessage, boxMessageInside, responseJson.success);
                }

            })
        }
    }

    frmSubmit.addEventListener("click", (e)=>{
        e.preventDefault();
        changePassword(frmPassword, {...dataPasswordForm});
    })

    cancelButton.addEventListener("click", ()=>{
        modal.style.cssText = "display: none";
    })

    openModal.addEventListener("click", ()=>{
        modal.style.cssText = "display: flex";
    })

    getCep(cepValue, {...data});

</script>
@endsection
