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
                <form action="{{ route('adm.tipo-imovel.store') }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="tipo-imovel">Tipo de Imóvel</label>
                        <input type="text" value="{{ old('tipo_imovel') }}" required placeholder="Digite o tipo de imóvel" id="tipo-imovel" name="tipo_imovel">
                    </div>
                    <div class="btn-area">
                        <button type="submit" title="Salvar">Salvar</button>
                    </div>
                </form>
            </div>
            @include('components.adm.footerAdm')
        </section>
        <script>
            const titlePage = new admTitlePage("Tipo de imóvel", "Você pode cadastrar um novo tipo de imóvel. Insira os dados no formulário abaixo e clique em salvar.");
            const back = new setBackLink("{{ route('adm.tipo-imovel.show') }}");
        </script>
    </section>

@endsection
