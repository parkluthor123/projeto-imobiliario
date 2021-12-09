@extends('adm.layouts.site')
@section('content')
    @include('components.messageCallback')
    @include('components.message')
    <section class="container-admin">
        @include('components.adm.sidebar')
        <div class="form-content-area">
            @include('components.adm.topbar')
            @include('components.adm.titlePage')
            @include('components.adm.backBtn')
            <div class="form-content-wrapper">
                <form action="{{ url('/admin/contato/update/')."/".$contato['id'] }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="nome">Nome completo</label>
                        <input type="text" value="{{ $contato['nome'] }}" required placeholder="Digite o nome completo" id="nome" name="nome">
                    </div>
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input type="text" value="{{ $contato['email'] }}" required placeholder="Digite seu e-mail" id="email" name="email">
                    </div>
                    <div class="form-item">
                        <label for="phone">Telefone</label>
                        <input type="text" required value="{{ $contato['phone'] }}" maxlength="15" placeholder="Digite seu telefone" id="phone" name="phone">
                    </div>
                    <div class="form-item">
                        <label for="phone">Assunto</label>
                        <input type="text" required value="{{ $contato['assunto'] }}" placeholder="Digite o assunto" id="assunto" name="assunto">
                    </div>
                    <div class="form-item">
                        <label for="phone">Mensagem</label>
                        <textarea required placeholder="Digite a mensagem" id="mensagem" name="mensagem">{{ $contato['mensagem'] }}</textarea>
                    </div>
                    <div class="btn-area">
                        <button type="submit" title="Salvar">Salvar</button>
                    </div>
                </form>
            </div>
            @include('components.adm.footerAdm')
        </div>
    </section>
    <script>
        const titlePage = new admTitlePage("Contato", "Você pode editar um contato existente. Insira os dados no formulário abaixo e clique em salvar.")
        const phone = document.querySelector("#phone");
        const back = new setBackLink("{{ route('adm.contato.show') }}");
        const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        function formatTel(v){
            v = v.replace(/[^\d]/g, "");
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
            v = v.replace(/(\d)(\d{4})$/, "$1-$2");
            return v;
        }


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

        handleStatus('{{ route('adm.contato.notification') }}', '{{ $contato['id'] }}')


        phone.addEventListener("keyup",()=>{
            this.phone.value = formatTel(this.phone.value);
        });

    </script>
@endsection
