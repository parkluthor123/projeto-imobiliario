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
                <form action="{{ route('adm.ajuste.social.save') }}" method="POST">
                    @csrf
                    <fieldset data-fieldset="Facebook">
                        <div class="form-item">
                            <label for="link_facebook">Link da página / Nome da página <i class="icon-question-circle map-link-helper" data-text="Texto que aparecerá no link no site"></i></label>
                            <div class="wrapp">
                                <input type="text" value="{{ $links['facebook'] }}" placeholder="Digite o link da página do facebook" id="link_facebook" name="link_facebook">
                                <input type="text" value="{{ $links['facebook_title'] }}" placeholder="Digite o nome da página do facebook" id="facebook" name="facebook">
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <br>
                    <fieldset data-fieldset="LinkedIn">
                        <div class="form-item">
                            <label for="link_linkedin">Link da página / Nome da página <i class="icon-question-circle map-link-helper" data-text="Texto que aparecerá no link no site"></i></label>
                            <div class="wrapp">
                                <input type="text" value="{{ $links['linkedin'] }}" placeholder="Digite o link da página do linkedin" id="link_linkedin" name="link_linkedin">
                                <input type="text" value="{{ $links['linkedin_title'] }}" placeholder="Digite o nome da página do linkedin" id="linkedin" name="linkedin">
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <br>
                    <fieldset data-fieldset="Instagram">
                        <div class="form-item">
                            <label for="link_instagram">Link da página / Nome da página <i class="icon-question-circle map-link-helper" data-text="Texto que aparecerá no link no site"></i></label>
                            <div class="wrapp">
                                <input type="text" value="{{ $links['instagram'] }}" placeholder="Digite o link da página do instagram" id="link_instagram" name="link_instagram">
                                <input type="text" value="{{ $links['instagram_title'] }}" placeholder="Digite o nome da página do instagram" id="instagram" name="instagram">
                            </div>
                        </div>
                    </fieldset>
                    <div class="btn-area">
                        <button type="submit" title="Salvar">Salvar</button>
                    </div>
                </form>
            </div>
            @include('components.adm.footerAdm')
        </section>
    </section>
    <script>
        const back = new setBackLink("{{ route('adm.ajuste.show') }}");
        const titlePage = new admTitlePage("Ajustes <i class='icon-gear'></i>", "Você pode definir suas configurações do site. Insira os dados no formulário abaixo e clique em salvar.")
    </script>
@endsection
