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
                <fieldset data-fieldset="Endereço">
                    <form action="{{ route('adm.ajuste.endereco.save') }}" method="POST">
                        @csrf
                        <div class="form-item">
                            <label for="link_facebook" style="padding-left: 15px"><strong>Link de compartilhamento (Google Maps)</strong>&nbsp;&nbsp;/&nbsp;&nbsp;<strong>Nome do endereço na página</strong> <i class="icon-question-circle map-link-helper" data-text="Texto que aparecerá no link no site"></i></label>
                            <div class="wrapp" style="margin-top: 10px;">
                                <input type="text" value="{{ $ajustes['link_endereco'] }}" placeholder="Link de compartilhamento" id="link_endereco" name="link_endereco">
                                <input type="text" value="{{ $ajustes['endereco'] }}" placeholder="Digite o endereco" id="endereco" name="endereco">
                            </div>
                        </div>
                        <br>
                        <div class="form-item">
                            <label for="iframe-item">Tag iframe (Google Maps) - Mapa página de contato</label>
                            <input type="text" id="iframe-item" name="iframe" value="{{ $ajustes['iframe'] }}" placeholder="Insira a tag do iframe">
                        </div>
                        <br>
                        <div class="btn-area" style="max-width: 120px; margin: 0 auto; padding: 0;">
                            <button type="submit" style="display: flex; justify-content: center; align-items: center; min-height: 40px;">Salvar</button>
                        </div>
                    </form>
                </fieldset>

                <div class="ajustes-wrapper">
                    <a href="{{ route('adm.ajuste.contato') }}" title="Números de contato">
                        <div class="ajustes-items">
                            <i class="icon-phone"></i>
                            <p>Números de<br> contatos</p>
                        </div>
                    </a>
                    <a href="{{ route('adm.ajuste.social') }}" title="Links de redes sociais">
                        <div class="ajustes-items">
                            <i class="icon-group"></i>
                            <p>Links de<br>redes sociais</p>
                        </div>
                    </a>
                    <div class="user-conf-wrapper">
                        <i class="icon-user"></i>
                        <p>Configurações de<br>usuários</p>
                        <div class="options">
                            <a href="{{ route('adm.ajuste.userconf') }}" title="Cadastrar">Cadastrar</a>
                            <a href="{{ route('adm.ajuste.userconf.show') }}" title="Visualizar">Visualizar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="boxMessageTable">
                <div class="boxMessage"></div>
            </div>
            @include('components.adm.footerAdm')
        </section>
    </section>
    <script>
        const titlePage = new admTitlePage("Ajustes <i class='icon-gear'></i>", "Você pode definir suas configurações do site por aqui. Escolha uma das opções.")
    </script>
@endsection
