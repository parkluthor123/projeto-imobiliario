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
                <div class="admin-table" style="position: relative">
                    <span class="loading" data-js="loadingFetch"></span>
                    <table>
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody data-js="table-content">

                        </tbody>
                    </table>
                    <div class="btn-add">
                        <button type="button" onclick="showMensalidade()"><i class="icon-plus"></i>Adicionar</button>
                    </div>
                </div>
            </div>
            @include('components.adm.footerAdm')
        </section>
    <section class="modal-file-adicionar-area" data-js="mensalidade-wrapper">
        <div class="modal-file-mensalidade-adicionar">
            <form action="{{ url('/admin/clientes/'.$clientes['id'].'/mensalidades/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <span class="closeModalMensalidade" onclick="closeMensalidade()">Fechar</span>
                <div class="title-area">
                    <div class="title">
                        <h1>Cadastrar boleto</h1>
                    </div>
                </div>
                <div class="form-items">
                    <label for="descricao">Data de vencimento</label>
                    <input type="date" name="data" id="data" required placeholder="Digite a data">
                </div>
                <div class="form-items">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" required placeholder="Digite a descrição"></textarea>
                </div>
                <div class="form-items">
                    <div class="fileModal">
                        <label for="fileSubmit">
                            <p>Fazer upload</p>
                        </label>
                        <input type="file" onchange="dataFile.boleto(this)" name="mensalidade" id="fileSubmit">
                    </div>
                </div>
                <div class="btn-area">
                    <button type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        const titlePage = new admTitlePage("Mensalidades", "Visualize as mensalidades, clique em <i class='icon-plus'></i> para adicionar, <i class='icon-eye'></i> para visualizar e <i class='icon-trash'></i> para apagar.");

        function closeMensalidade()
        {
            const el = document.querySelector("[data-js='mensalidade-wrapper']");
            el.style.display = "none";
        }

        function showMensalidade()
        {
            const el = document.querySelector("[data-js='mensalidade-wrapper']");
            el.style.display = "flex";
        }

        function loadingFetch(boolean)
        {
            const loading = document.querySelector("[data-js='loadingFetch']");
            if(boolean == true)
            {
                loading.style.cssText = "display: block !important";
            }
            else
            {
                loading.style.cssText = "display: false !important";
            }
        }

        const getData = async(route)=>{
            const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
            const table = document.querySelector('[data-js="table-content"]');

            loadingFetch(true)
            await fetch(route,{
                method: 'GET',
                headers:{
                    'content-type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
                .then((response)=> response.json())
                .then((responseJson)=> {
                    loadingFetch(false)
                    table.innerHTML = '';
                    if(responseJson.length === 0)
                    {
                        table.innerHTML = `<h1 style="text-transform:uppercase; text-align: center">Sem conteúdo</h1>`;
                    }
                    else
                    {
                        Object.values(responseJson).map((data)=>(
                            table.innerHTML += `
                               <tr>
                                   <td>${data.dateFinal}</td>
                                   <td>${data.descricao_boleto}</td>
                                   <td>
                                        <div class="btn-area">
                                            <a href="${data.mensalidade}" target="_blank"><i class="icon-eye"></i> Visualizar</a>
                                            <button type="button" id="deleteRow" onclick="openModal('{{ url('/admin/clientes/apagar/mensalidade/') }}', ${data.id}, '{{ url('/admin/clientes/editar/'.$clientes['id'].'/mensalidades/all') }}')"><i class='icon-trash'></i>Apagar</button>
                                        </div>
                                   </td>

                               </tr>
                           `
                        ))
                    }

                })
        }

        const dataFile = {
            boleto:(el)=>{
                if(el.files.length > 0)
                {
                    const label = el.parentNode.firstElementChild;
                    label.innerHTML = "";
                    label.innerHTML = `<p style="color: lawngreen">Adicionado&nbsp;<i style="color: lawngreen" class="icon-check"></i></p>`;

                }
            },
        }

        getData("{{ url('/admin/clientes/editar/'.$clientes['id'].'/mensalidades/all') }}")
    </script>
    </section>

@endsection
