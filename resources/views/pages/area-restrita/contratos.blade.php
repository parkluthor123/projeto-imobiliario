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
                    @foreach($contratos as $contrato)
                        <tr>
                            <td>Emitido em <br>{{ $contrato->dateFinal }}</td>
                            <td>{{ $contrato->descricao_contrato }}</td>
                            <td>
                                <div class="btn-area">
                                    <a href="{{ $contrato->contrato }}" target="_blank" title="Baixar"><i class="icon-download"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
