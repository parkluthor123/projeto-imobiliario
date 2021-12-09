@php
    $notification = \App\Models\Contato::where('status', '=', 0)->take(4)->orderBy("id", "desc")->get();
    $notificationCount = \App\Models\Contato::where('status', '=', 0)->get();
@endphp
<section class="topbar-area">
    <div class="topbar-wrapper">
        <a href="{{ route('adm.logout') }}" class="btn-standBy">
            <i class="icon-power-off"></i>
        </a>
        <div class="topbar-acessibility">
            <div class="notifications-area">
                <div class="counter-area" data-js="counter">
                    <i class="icon-bell"></i>
                    <p>{{ count($notificationCount) }}</p>
                </div>
                <div class="notifications-content">
                    <ul>
                        @if(count($notification) > 0)
                            @foreach($notification as $notifications)
                                <li>
                                    <a href="{{ url('/admin/contato/editar/').'/'.$notifications->id }}">{{ $notifications->nome }}</a>
                                </li>
                            @endforeach
                            <li style="border-top: 1px solid var(--font-color);">
                                <a style="font-weight: bold;" href="{{ route('adm.contato.show') }}">Ver todos</a>
                            </li>
                        @else
                            <li>
                                <a href="javascript:;" style="font-weight: bold">Sem notificações</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="user-information-area">
                <button type="button" data-js="conf-user">{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->name }}<i class="icon-user-circle"></i></button>
                <ul class="list-information">
                    <li>
                        <a href="{{ route('adm.ajuste.userconf.show') }}">Conf. usuários</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<script>
    function showNotification()
    {
        const notification = document.querySelector("[data-js='counter']");
        const notificationContent = document.querySelector(".notifications-content");
        notification.addEventListener("click", ()=>{
            notificationContent.classList.toggle("notifications-content-active");
        })
    }

    function showConfUser()
    {
        const user = document.querySelector("[data-js='conf-user']");
        const userContent = document.querySelector(".list-information");

        user.addEventListener("click",()=>{
            userContent.classList.toggle("list-information-active");
        });
    }

    window.onload = ()=>{
        showNotification()
        showConfUser()
    }
</script>
