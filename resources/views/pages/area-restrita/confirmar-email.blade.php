@extends("layouts.site")
@section('title', 'Imobiliária')
@section('content')
<link rel="stylesheet" href="{{ URL::to('css/area-restrita/style.css') }}">

{{-- Meta tags dinâmicas --}}
@section('keywords', 'Teste')
@section('description', 'Teste')
{{-- End Meta tags dinâmicas --}}
<h1>Verify email</h1>

<p>Please verify your email address by clicking the link in the mail we just sent you. Thanks!</p>

@endsection
