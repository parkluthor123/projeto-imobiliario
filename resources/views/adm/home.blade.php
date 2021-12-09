@extends('adm.layouts.site')
@section('content')
    <section class="container-admin">
        @include('components.adm.sidebar')
        <section class="welcome-area">
            @include('components.adm.topbar')
            <div class="search-area">
                <form action="{{ route('adm.clientes.busca') }}" method="POST">
                    @csrf
                    <div class="form-items">
                        <label for="search">Pesquisar cliente</label>
                        <input type="text" placeholder="Digite o CPF do cliente" required id="search" name="buscar">
                    </div>
                    <div class="btn-area">
                        <button type="submit" title="Pesquisar">Pesquisar</button>
                    </div>
                </form>
            </div>

            <div class="welcome-content">
                <div class="welcome-items">
                    <div class="title-area">
                        <div class="title">
                            <h2>Alterar banners</h2>
                        </div>
                        <div class="subtitle">
                            <p>Home</p>
                        </div>
                    </div>
                    <div class="btn-area">
                        <a href="{{ route('adm.bannner.show') }}" title="Ver +">Ver +</a>
                    </div>
                </div>
                <div class="welcome-items">
                    <div class="title-area">
                        <div class="title">
                            <h2>Configurações</h2>
                        </div>
                        <div class="subtitle">
                            <p>Usuários</p>
                        </div>
                    </div>
                    <div class="btn-area">
                        <a href="{{ route('adm.ajuste.userconf.show') }}" title="Ver +">Ver +</a>
                    </div>
                </div>
            </div>

            <div class="welcome-content">
                <div class="welcome-items" style="max-width: none;">
                    <div class="title-area">
                        <div class="title">
                            <h2>Ajustes</h2>
                        </div>
                        <div class="subtitle">
                            <p>Blog</p>
                        </div>
                    </div>
                    <div class="btn-area">
                        <a href="#" title="Ver +">Ver +</a>
                    </div>
                </div>
            </div>

            @include('components.adm.footerAdm')
        </section>
    </section>
@endsection
