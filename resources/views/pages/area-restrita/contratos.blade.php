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
                        <td>Emitido em <br>24/10/2021</td>
                        <td>Meu contrato</td>
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
    const descTop = new setDescriptionPage("Meu contrato", "Veja aqui seu contrato do seu imóvel, mais acessibilidade para você.<br>Visualize ou baixe o arquivo PDF.");
</script>

@endsection
