@extends('adm.layouts.site')
@section('content')
    <style>
        .btn-area-estados
        {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            width: var(--full);
            margin: 15px 0;
            padding: 0 20px;
        }

        .btn-area-estados a
        {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 10px;
            border-radius: 10px;
            background-color: var(--yellow);
            font-weight: bold;
            box-shadow: 0px 0px 3px 0px #ccc;
        }

        .btn-area-estados a i
        {
            margin-left: 10px;
            font-size: 14px;
        }

        .admin-table
        {
            margin-bottom: 70px;
        }
    </style>
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
                <div class="btn-area-estados">
                    <a href="{{ route('adm.localidades.bairros.create') }}" title="Cadastrar">Cadastrar <i class="icon-plus"></i></a>
                </div>
                <div class="admin-table" style="position: relative">
                    <span class="loading" data-js="loadingFetch"></span>
                    <table>
                        <div class="search-box">
                            <label for="filter" title="Pesquise o cliente por nome ou cpf"><strong>Busca: &nbsp;</strong></label>
                            <input type="text" id="filter" onkeyup="getFilter(this.value, '{{ route('adm.localidades.bairros.ajax') }}')" placeholder="Pesquisa">
                        </div>
                        <thead>
                        <tr>
                            <th>Bairros</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody data-js="table-content">
                        </tbody>
                    </table>
                </div>
            </div>
            @include('components.adm.footerAdm')
        </section>
        <script>
            const titlePage = new admTitlePage("Bairros", "Visualize os bairros, clique em <i class='icon-plus'></i> para adicionar, <i class='icon-eye'></i> para visualizar e <i class='icon-trash'></i> para apagar.");

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
                        console.log(responseJson.length)
                        loadingFetch(false)
                        if(responseJson.length === 0)
                        {
                            table.innerHTML = `<h1 style="text-transform:uppercase; text-align: center">Sem conteúdo</h1>`;
                        }
                        else{
                            table.innerHTML = '';
                            Object.values(responseJson).map((data)=>(
                                table.innerHTML += `
                                   <tr>
                                       <td>${data.bairros}</td>
                                       <td>
                                           <div class="btn-area">
                                               <a href="{{ url('/admin/localidades/bairro/edit/') }}/${data.id}"><i class="icon-pencil"></i> Editar</a>
                                               <button type="button" id="deleteRow" onclick="openModal('{{ url('/admin/localidades/bairro/delete/') }}', ${data.id}, '{{ route('adm.localidades.bairros.all') }}')"><i class='icon-trash'></i>Apagar</button>
                                           </div>
                                       </td>
                                   </tr>
                               `
                            ))
                        }

                    })
            }

            async function getFilter(input, route)
            {
                const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
                const table = document.querySelector('[data-js="table-content"]');

                loadingFetch(true)

                await fetch(route, {
                    method: "POST",
                    headers: {
                        "content-type": "applicaiton/json",
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({input}),
                })
                    .then((response)=>response.json())
                    .then((responseJson)=>{
                        loadingFetch(false);
                        table.innerHTML = '';
                        if(responseJson.length === 0)
                        {
                            table.innerHTML = `<h1 style="text-transform:uppercase; text-align: center">Sem conteúdo</h1>`;
                        }
                        else
                        {
                            Object.values(responseJson).map((data)=>(
                                table.innerHTML += ` <tr>
                                   <td>${data.bairros}</td>
                                   <td>
                                       <div class="btn-area">
                                           <a href="{{ url('/admin/localidades/bairro/edit/') }}/${data.id}"><i class="icon-pencil"></i> Editar</a>
                                           <button type="button" id="deleteRow" onclick="openModal('{{ url('/admin/localidades/bairro/delete/') }}', ${data.id}, '{{ route('adm.localidades.bairros.all') }}')"><i class='icon-trash'></i>Apagar</button>
                                       </div>
                                   </td>
                               </tr>`
                            ))
                        }
                    })
            }

            getData("{{ route('adm.localidades.bairros.all') }}")
        </script>
    </section>

@endsection
