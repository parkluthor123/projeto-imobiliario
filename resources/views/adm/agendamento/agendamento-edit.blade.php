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
                <form action="{{ url('/admin/agendamentos/update/')."/".$agendamento['id'] }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" value="{{  $agendamento['nome'] }}" required placeholder="Digite o nome"/>
                    </div>
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input type="text" placeholder="Digite o e-mail" value="{{  $agendamento['email'] }}" id="email" required name="email"/>
                    </div>
                    <div class="form-item">
                        <label for="phone">Celular</label>
                        <input type="text" placeholder="Digite o numero de celular" value="{{  $agendamento['phone'] }}" maxlength="15" required id="phone" name="phone" />
                    </div>
                    <div class="form-item">
                        <label for="tipo">Tipo de contato</label>
                        <select name="tipo" id="tipo" required>
                            <option value="1" {{ $agendamento['tipo_contato'] === 1 ? 'selected' : '' }}>Telefone</option>
                            <option value="2" {{ $agendamento['tipo_contato'] === 2 ? 'selected' : '' }}>E-mail</option>
                            <option value="3" {{ $agendamento['tipo_contato'] === 3 ? 'selected' : '' }}>WhatsApp</option>
                        </select>
                    </div>
                    <br>
                    <div class="btn-area">
                        <button type="submit" title="Salvar">Salvar</button>
                    </div>
                    <br>
                </form>
            </div>
            @include('components.adm.footerAdm')
        </section>
    </section>
    <script>
        const titlePage = new admTitlePage("Agendamentos", "Você pode cadastrar um novo agendamento. Insira os dados no formulário abaixo e clique em salvar.")
        const back = new setBackLink("{{ route('adm.agendamento.show') }}");
        const phone = document.querySelector("#phone");
        const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        function formatTel(v){
            v = v.replace(/[^\d]/g, "");
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
            v = v.replace(/(\d)(\d{4})$/, "$1-$2");
            return v;
        }

        phone.addEventListener("keyup",()=>{
            phone.value = formatTel(phone.value);
        });

        async function handleStatus(route, id)
        {
            await fetch(route, {
                method: 'POST',
                headers:{
                    'content-type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({id: id})
            })
            .then((response)=>response.json())
        }

        handleStatus('{{ route('adm.agendamentos.status') }}', '{{ $agendamento['id'] }}')
    </script>
@endsection
