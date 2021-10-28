@extends('adm.layouts.site')
@section('content')
    @include('components.adm.errorPassword')
    <nav class="navbar-adm-area">
        <div class="container-full">
            <div class="container-static">
                <div class="navbar-adm-wrapper">
                    <h1>Área Administrativa</h1>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="login-area">
            <div class="container-full">
                <div class="container-static">
                    <div class="login-wrapper">
                        <form action="{{ route('adm.login.do') }}" method="POST">
                            @csrf
                            <div class="form-items">
                                <label for="email">Email</label>
                                <input type="text" name="email" placeholder="Digite o e-mail" id="email">
                            </div>
                            <div class="form-items">
                                <label for="password">Senha</label>
                                <input type="password" name="password" id="password" placeholder="Digite a senha">
                            </div>
                            <div class="btn-area">
                                <button type="submit">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

