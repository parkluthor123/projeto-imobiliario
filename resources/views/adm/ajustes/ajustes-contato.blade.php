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
                <form action="{{ route('adm.ajuste.contato.save') }}" method="POST">
                    @csrf
                    <fieldset data-fieldset="Topo / página contato">
                        <div class="form-item">
                            <label for="nome">WhatsApp</label>
                            <input type="text" value="{{ $numero['topbar_num'] }}" data-js='filter-phone' placeholder="Digite o numero telefone/whatsapp" id="topbarNum" name="topbarNum">
                        </div>
                    </fieldset>
                    <br>
                    <br>
                    <fieldset data-fieldset="Rodapé">
                        <div class="form-item">
                            <label for="nome">Número 1</label>
                            <input type="text" value="{{ $numero['footer_num1'] }}" data-js='filter-phone' placeholder="Digite o numero telefone/whatsapp" id="num1" name="num1">
                        </div>
                        <div class="form-item">
                            <label for="nome">Número 2</label>
                            <input type="text" value="{{ $numero['footer_num2'] }}" data-js='filter-phone' placeholder="Digite o numero telefone/whatsapp" id="num2" name="num2">
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
        const titlePage = new admTitlePage("Ajustes <i class='icon-gear'></i>", "Você pode definir suas configurações do site. Insira os dados no formulário abaixo e clique em salvar.");
        const phone = document.querySelectorAll("[data-js='filter-phone']");
        const back = new setBackLink("{{ route('adm.ajuste.show') }}");

        function formatTel(v){
            v = v.replace(/[^\d]/g, "");
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
            v = v.replace(/(\d)(\d{4})$/, "$1-$2");
            return v;
        }

        for(let i = 0; i < phone.length; i++)
        {
            phone[i].addEventListener("keyup", ()=>{
                phone[i].value = formatTel(phone[i].value);
                phone[i].setAttribute("maxlength", 15);
            });
        }
    </script>
@endsection
