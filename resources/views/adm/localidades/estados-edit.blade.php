@extends('adm.layouts.site')
@section('content')
    @include('components.messageCallback')
    @include('components.message')
    @include('components.adm.modalDelete')
    <section class="container-admin">
        @include('components.adm.sidebar')
        <section class="form-content-area">
            @include('components.adm.topbar')
            @include('components.adm.titlePage')
            @include('components.adm.backBtn')
            <div class="form-content-wrapper">
                <form action="{{ url('/admin/localidades/estados/update/')."/".$estados['id'] }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="estado">Estado</label>
                        <input type="text" value="{{ $estados['estados'] }}" required placeholder="Digite o estado" id="estado" name="estado">
                    </div>
                    <div class="btn-area">
                        <button type="submit" title="Salvar">Salvar</button>
                    </div>
                </form>
            </div>
            @include('components.adm.footerAdm')
        </section>
        <script>
            const titlePage = new admTitlePage("Estados", "Você pode editar um estado existente. Insira os dados no formulário abaixo e clique em salvar.");
            const back = new setBackLink("{{ route('adm.localidades.estados.show') }}");
        </script>
    </section>

@endsection
