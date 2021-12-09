<nav class="sidebar-area sidebar-oppened" >
    <div class="sidebar-wrapper">
        <div class="sidebar-header">
            <button id="sidebarMenu">
                <i class="icon-list"></i>
            </button>
            <h1>Imobiliária</h1>
        </div>
        <div class="gadgets-wrapper">
            <div class="gadgets-items">
                <p>Dólar</p>
                <span id="usdValue"></span>
            </div>
            <div class="gadgets-items">
                <p>E-mail</p>
                <span id="emailValue"></span>
            </div>
            <div class="gadgets-items">
                <p>Clientes</p>
                <span id="clientesQtd"></span>
            </div>
        </div>
        <div class="sidebar-items">
            <ul data-js="sidebar-menu">

                <li data-sidebar-body="1" data-js="sidebar-menu-selected">
                    <span data-sidebar-menu="1">
                        <i data-sidebar-menu="1" class="icon-group"></i>
                        <p>Clientes</p>
                    </span>
                    <div class="content">
                        <ul>
                            <li>
                                <a href="{{ route('adm.clientes.create') }}" title="Cadastrar">Cadastrar</a>
                            </li>
                            <li>
                                <a href="{{ route('adm.clientes.show') }}" title="Visualizar">Visualizar</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li data-sidebar-body="2" data-js="sidebar-menu-selected">
                    <span data-sidebar-menu="2">
                       <i data-sidebar-menu="2" class="icon-id-card"></i>
                        <p>Contato</p>
                    </span>
                    <div class="content">
                        <ul>
                            <li>
                                <a href="{{ route('adm.contato.create') }}" title="Cadastrar" >Cadastrar</a>
                            </li>
                            <li>
                                <a href="{{ route('adm.contato.show') }}" title="Visualizar">Visualizar</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li data-sidebar-body="3" data-js="sidebar-menu-selected">
                    <span data-sidebar-menu="3">
                        <i data-sidebar-menu="3" class="icon-map-signs"></i>
                        <p>Vendas</p>
                    </span>
                    <div class="content">
                        <ul>
                            <li>
                                <a href="{{ route('adm.vender.create') }}">Cadastrar</a>
                            </li>
                            <li>
                                <a href="{{ route('adm.vender.show') }}">Visualizar</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li data-sidebar-body="4" data-js="sidebar-menu-selected">
                    <span data-sidebar-menu="4">
                        <i data-sidebar-menu="4" class="icon-home"></i>
                        <p>Imóveis</p>
                    </span>
                    <div class="content">
                        <ul>
                            <li>
                                <a href="{{ route('adm.imoveis.create') }}">Cadastrar</a>
                            </li>
                            <li>
                                <a href="{{ route('adm.imoveis.show') }}">Visualizar</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('adm.meta.show') }}">
                        <span>
                           <i class="icon-tags"></i>
                           <p>Meta tags</p>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('adm.ajuste.show') }}">
                        <span>
                            <i class="icon-gear"></i>
                            <p>Ajustes</p>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<span data-js="btn-mobile" onclick="menuMobile()">
    <i class="icon-list"></i>
</span>
<section class="navbar-mobile-area">
    <ul class="nav-mobile">
        <li>
            Clientes
            <a href="{{ route('adm.clientes.create') }}">Cadastrar</a>
            <a href="{{ route('adm.clientes.show') }}">Visualizar</a>
        </li>
        <li>
            Contato
            <a href="{{ route('adm.contato.create') }}">Cadastrar</a>
            <a href="{{ route('adm.contato.show') }}">Visualizar</a>
        </li>
        <li>
            Vendas
            <a href="{{ route('adm.vender.create') }}">Cadastrar</a>
            <a href="{{ route('adm.vender.show') }}">Visualizar</a>
        </li>
        <li>
            Imóveis
            <a href="{{ route('adm.imoveis.create') }}">Cadastrar</a>
            <a href="{{ route('adm.imoveis.show') }}">Visualizar</a>
        </li>
        <li>
            <i class="icon-tags"></i>
            <a href="{{ route('adm.meta.show') }}">
                Meta Tags
            </a>
        </li>
        <li>
            <i class="icon-gear"></i>
            <a href="{{ route('adm.ajuste.show') }}">Ajustes</a>
        </li>
    </ul>
</section>

<script>
    const navbarItems = document.querySelector("[data-js='sidebar-menu']");
    const emailValue = document.querySelector("#emailValue");
    const clientesValue = document.querySelector("#clientesQtd");

    function menuMobile()
    {
        this.menu = document.querySelector(".navbar-mobile-area");
        return menu.classList.toggle("menu-mobile-active");
    }

    navbarItems.addEventListener("click", (e)=>{
        const sidebarId = e.target.dataset.sidebarMenu;
        const sidebarBody = document.querySelector(`[data-sidebar-body='${sidebarId}']`)
        const menuWrapper = document.querySelector(".sidebar-area");
        const sidebarClosed = Array
            .from(document.querySelectorAll("[data-js='sidebar-menu-selected']"))
            .filter(sidebarActive => sidebarActive !== sidebarBody)
            .find(sidebarActive => sidebarActive.classList.contains('sidebar-active'))

        if(!e.target.dataset.sidebarMenu)
        {
           return false;
        }
        if(sidebarClosed)
        {
            const sidebarBodyClosed = document.querySelector(`[data-sidebar-body='${sidebarClosed.dataset.sidebarBody}']`)
            sidebarBodyClosed.classList.remove("sidebar-active");
        }
        sidebarBody.classList.toggle("sidebar-active")

        if(sidebarBody.classList.contains("sidebar-active"))
        {
            menuWrapper.classList.add("sidebar-oppened");
            getGadgets(true)
            getTextofBtn(true)
        }
    })

    function getGadgets(el)
    {
        const gadgets = document.querySelector(".gadgets-wrapper");

        if(el === false)
        {
            gadgets.style.cssText = "animation: fadeOut .3s ease-in-out alternate forwards;";
            setTimeout(()=>{
                gadgets.style.cssText = "display: none";
            }, 300)
        }
        else
        {
            gadgets.style.cssText = "animation: fadeInn .3s ease-in-out alternate forwards";
            setTimeout(()=>{
                gadgets.style.cssText = "display: flex";
            }, 300)
        }
    }

    function getTextofBtn(el)
    {
        const btnsText = document.querySelectorAll(".sidebar-items ul li span p");

        if(el === false)
        {
            for (let i = 0; i < btnsText.length; i++)
            {
                btnsText[i].style.cssText = "animation: fadeOut .3s ease-in-out alternate forwards";
                setTimeout(()=>{
                    btnsText[i].style.cssText = "display: none";
                }, 300)
            }
        }
        else
        {
            for (let i = 0; i < btnsText.length; i++)
            {
                btnsText[i].style.cssText = "animation: fadeInn .3s ease-in-out alternate forwards";
                setTimeout(()=>{
                    btnsText[i].style.cssText = "display: flex";
                }, 300)
            }
        }
    }

    function toggleSideBar()
    {

        const menu = document.querySelector("#sidebarMenu");
        const sidebarList = document.querySelectorAll(".sidebar-items ul li");

        menu.addEventListener("click", ()=>{
            const menuWrapper = document.querySelector(".sidebar-area");
            menuWrapper.classList.toggle("sidebar-oppened");

            if(!menuWrapper.classList.contains("sidebar-oppened"))
            {
                getGadgets(false)
                getTextofBtn(false)

                for(let i = 0; i < sidebarList.length; i++)
                {
                    sidebarList[i].classList.remove("sidebar-active");
                }
            }
            else
            {
                getGadgets(true)
                getTextofBtn(true)
            }
        })
    }
    toggleSideBar();


    const getDolar = async()=>
    {
        const el = document.querySelector("#usdValue");

        await fetch("https://economia.awesomeapi.com.br/json/USD-BRL",{
            method: "GET",
            headers:{
                "content-type": "application/json",
                "Accept": "application/json",
            }
        })
            .then((response)=>response.json())
            .then((responseJson)=>{
                const data = parseFloat(responseJson[0].ask);
                if(data != null || data != undefined)
                {
                    el.innerHTML = "$ "+data.toFixed(2);
                }
            })
    }
    getDolar()

    setTimeout(()=>{
        let i = 0;
        let interval = setInterval(()=>{
            if(i < {{ $contatoCount }})
            {
                i++
                emailValue.innerHTML = i;
            }
            clearInterval();
        }, 10);
    }, 0)

    setTimeout(()=>{
        let i = 0;
        let interval = setInterval(()=>{
            if(i < {{ $clienteCount }})
            {
                i++
                clientesValue.innerHTML = i;
            }
            clearInterval();
        }, 10);
    }, 100)

</script>
