@extends('layouts.site')
@section('title', 'Imobiliária')
@section('content')
    {{-- Meta tags dinâmicas --}}
@section('keywords', 'Teste')
@section('description', 'Teste')
{{-- End Meta tags dinâmicas --}}
<link rel="stylesheet" href="{{ URL::to('/css/area-restrita/style.css') }}">
@include('components.area-restrita.description-page')

<script>
    const descTop = new setDescriptionPage("Meus agendamentos", "Veja aqui seus agendamentos marcados.");
</script>
@endsection
