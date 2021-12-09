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
                <form action="{{ url('/admin/localidades/bairro/update/')."/".$bairros['id'] }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="estado">Bairros</label>
                        <input type="text" value="{{ $bairros['bairros'] }}" required placeholder="Digite o bairro" id="bairros" name="bairros">
                    </div>
                    <br>
                    <br>
                    <fieldset data-fieldset="Vincular ao estado" style="max-width: var(--full)">
                        <div class="form-item">
                            <label for="estado">Vincule o bairro ao estado</label>
                            <select name="estados" id="estados" required>
                                <option value="{{ $estadoSelected->id_estados }}" hidden selected>{{ $estadoSelected->estados }}</option>
                                @foreach($estados as $uf)
                                    <option value="{{ $uf['id'] }}">{{ $uf['estados'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                    <div class="btn-area">
                        <button type="submit" title="Salvar">Salvar</button>
                    </div>
                </form>
            </div>
            @include('components.adm.footerAdm')
        </section>
        <script>
            const titlePage = new admTitlePage("Bairros", "Você pode editar um bairro existente. Insira os dados no formulário abaixo e clique em salvar.");
            const back = new setBackLink("{{ route('adm.localidades.bairros.show') }}");
        </script>
    </section>

@endsection
