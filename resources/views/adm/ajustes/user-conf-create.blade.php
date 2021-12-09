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
                <form action="{{ route('adm.ajuste.userconf.save') }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="nome">Nome</label>
                        <input value="{{ old('name') }}" type="text" required placeholder="Digite o nome" name="name" id="name">
                    </div>
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input type="text" value="{{ old('email') }}" required placeholder="Digite o email" name="email" id="email">
                    </div>
                    <div class="form-item">
                        <label for="password">Senha</label>
                        <input type="password" required placeholder="Digite a senha" name="password" id="password">
                    </div>
                    <div class="form-item">
                        <label for="conf_senha">Confirmar a senha</label>
                        <input type="password" required placeholder="Confirmar senha" name="conf_senha" id="conf_senha">
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
        const back = new setBackLink("{{ route('adm.ajuste.show') }}");
        const titlePage = new admTitlePage("Ajustes <i class='icon-gear'></i>", "Você pode definir suas configurações do site. Insira os dados no formulário abaixo e clique em salvar.")
    </script>
@endsection
