@extends('adm.layouts.site')
@section('content')
    @include('components.messageCallback')
    @include('components.message')
    <section class="container-admin">
        @include('components.adm.sidebar')
        <section class="form-content-area">
            @include('components.adm.topbar')
            @include('components.adm.titlePage')
            @include('components.adm.backBtn')
            <div class="form-content-wrapper">
                <div class="admin-table" style="position: relative">
                    <table style="margin-bottom: 70px;">
                        <thead>
                        <tr>
                            <th>Nome da página</th>
                            <th>Descrição</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody data-js="table-content">
                            @foreach($metatags as $metatag)
                                <tr>
                                    <td>{{ $metatag['page_name'] }}</td>
                                    <td>{{ $metatag['description'] }}</td>
                                    <td>
                                        <div class="btn-area">
                                            <a href="{{ url('/admin/meta-tags/editar/')."/".$metatag['id'] }}"><i class="icon-pencil"></i> Editar</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @include('components.adm.footerAdm')
        </section>
    </section>
    <script>
        const titlePage = new admTitlePage("Meta Tags", "Você pode cadastrar um novo imóvel. Insira os dados no formulário abaixo e clique em salvar.")
    </script>
@endsection
