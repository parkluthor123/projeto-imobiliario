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
                <form action="{{ route('adm.agendamento.store') }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required placeholder="Digite o nome"/>
                    </div>
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input type="text" placeholder="Digite o e-mail" value="{{ old('email') }}" id="email" required name="email"/>
                    </div>
                    <div class="form-item">
                        <label for="phone">Celular</label>
                        <input type="text" placeholder="Digite o numero de celular" value="{{ old('email') }}" maxlength="15" required id="phone" name="phone" />
                    </div>
                    <div class="form-item">
                        <label for="tipo">Tipo de contato</label>
                        <select name="tipo" id="tipo" required>
                            <option value="1">Telefone</option>
                            <option value="2">E-mail</option>
                            <option value="3">WhatsApp</option>
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

        function formatTel(v){
            v = v.replace(/[^\d]/g, "");
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
            v = v.replace(/(\d)(\d{4})$/, "$1-$2");
            return v;
        }

        phone.addEventListener("keyup",()=>{
            phone.value = formatTel(phone.value);
        });
    </script>
@endsection
