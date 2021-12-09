@extends('adm.layouts.site')
@section('content')
    @include('components.adm.modalDelete')
    <section class="container-admin">
        @include('components.adm.sidebar')
        <section class="form-content-area">
            @include('components.adm.topbar')
            @include('components.adm.titlePage')
            @include('components.adm.backBtn')
            <div class="form-content-wrapper">
                @if(count($busca) > 0)
                    <div class="admin-table" style="position: relative">
                        <table>
                            <thead>
                            <tr>
                                <th>Nome do cliente</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody data-js="table-content">
                            @foreach($busca as $buscar)
                                <tr>
                                    <td>{{ $buscar->name }}</td>
                                    <td>{{ $buscar->cpf }}</td>
                                    <td>{{ $buscar->phone }}</td>
                                    <td>
                                        <div class="btn-area">
                                            <a href="{{ url('/admin/clientes/editar/') }}/{{ $buscar->id }}"><i class="icon-pencil"></i> Editar</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h1 style="text-align: center; text-transform: uppercase;">Nenhum cliente encontrado!</h1>
                @endif
            </div>
            <br>
            <br>
            @include('components.adm.footerAdm')
        </section>
    </section>
    <script>
        const titlePage = new admTitlePage("Buscar cliente", "{{ count($busca) }} resultado(s) encontrado(s)");
    </script>
@endsection
