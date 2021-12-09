<ul>
    <li>
        <span title="Cotação atual do Dólar" id="usd-value"></span>
    </li>
    <li class="@yield('nav-quem-somos')"><a href="{{ url('/quem-somos') }}" title="Quem Somos">Quem Somos</a></li>
    <li class="@yield('nav-comprar')"><a href="{{ url('/comprar') }}" title="Comprar">Comprar ou Alugar</a></li>
    <li class="@yield('nav-vender')"><a href="{{ url('/vender') }}" title="Vender">Vender</a></li>
    <li class="@yield('nav-contato')"><a href="{{ url('/contato') }}" title="Contato">Contato</a></li>
    <li>
        <div class="switch-area">
            <label for="switch-light"><i class="icon-moon-o"></i></label>
            <input type="checkbox" id="switch-light">
        </div>
    </li>
    @if(\Illuminate\Support\Facades\Auth::guard('clientes')->check())
    <li class="login-btn-wrapper">
        <a href="{{ route('area-restrita.home') }}" title="Entrar">Meu perfil</a>
        <span><a href="{{ route('area-restrita.sair') }}" title="Entrar"><i class="icon-power-off"></i></a></span>
    </li>
    @else
        <li><a href="{{ url('/entrar') }}" title="Entrar">Entrar</a></li>
    @endif
</ul>
