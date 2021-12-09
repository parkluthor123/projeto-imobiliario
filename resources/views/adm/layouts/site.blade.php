<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Imobiliária - Área admnistrativa</title>
    <link rel="stylesheet" href="{{ URL::to('/css/adm/style.css') }}">
</head>
<body>
    @php
        $agendamentos = \App\Models\Agendamento::where('status', '=', 0)->get();
    @endphp

    <main>
        @yield('content')
    </main>

    @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
        <a href="{{ route('adm.agendamento.show') }}" title="Ver agendamentos" class="agendamentos">
            @if(count($agendamentos) > 0)
                <span class="count">{{ count($agendamentos) }}</span>
            @endif
            Agendamentos
        </a>
    @endif
</body>
</html>
