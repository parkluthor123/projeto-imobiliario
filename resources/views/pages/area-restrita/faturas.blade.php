@extends('layouts.site')
@section('title', 'Imobiliária')
@section('content')
    {{-- Meta tags dinâmicas --}}
@section('keywords', 'Teste')
@section('description', 'Teste')
{{-- End Meta tags dinâmicas --}}
<link rel="stylesheet" href="{{ URL::to('/css/area-restrita/style.css') }}">
@include('components.area-restrita.description-page')
<div class="table-area">
    <div class="container-full">
        <div class="container-static">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>24/10/2021</td>
                            <td>2° via da fatura</td>
                            <td>
                                <div class="btn-area">
                                    <a href="#" target="_blank" title="Visualizar"><i class="icon-eye"></i></a>
                                    <a href="#" target="_blank" title="Baixar"><i class="icon-download"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const descTop = new setDescriptionPage("Minhas faturas", "Veja aqui suas faturas, 2° via do seu boleto.<br>Visualize ou baixe o arquivo PDF.");
</script>
@endsection
