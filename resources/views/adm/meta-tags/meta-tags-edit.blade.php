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
                <form action="{{ url('/admin/meta-tags/update/')."/".$metatags['id'] }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="descricao">Meta descrição</label>
                        <textarea name="descricao" id="descricao" placeholder="Digite a meta descrição">{{ $metatags['description'] }}</textarea>
                    </div>
                    <br>
                    <div class="form-item">
                        <label for="keywords">Meta Keywords</label>
                        <textarea placeholder="Digite as meta keywords" id="keywords" name="keywords">{{ $metatags['keywords'] }}</textarea>
                        <span style="display: flex; margin-top: 10px; padding-left: 15px; font-weight: normal; font-size: 15px; color: #b22;">Obs* Separe as meta-tags por vírgula</span>
                    </div>
                    <br>
                    <div class="form-item">
                        <label for="code">Scripts personalizados</label>
                        <textarea placeholder="Digite os códigos personalizados" id="code" name="code">{{ $metatags['codes'] }}</textarea>
                    </div>
                    <br>
                    <div class="btn-area">
                        <button type="submit" title="Salvar">Salvar</button>
                    </div>
                    <br>
                </form>
            </div>
            @include('components.adm.footerAdm')
        </section>
    </section>
    <script>
        const titlePage = new admTitlePage("Meta Tags", "Você está editando a página <strong>{{ $metatags['page_name'] }}</strong>. Insira os dados no formulário abaixo e clique em salvar.")
        const back = new setBackLink("{{ route('adm.meta.show') }}");
    </script>
@endsection
