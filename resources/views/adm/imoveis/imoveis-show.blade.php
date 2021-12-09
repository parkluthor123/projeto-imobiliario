@extends('adm.layouts.site')
@section('content')
    @include('components.adm.modalDelete')
    @include('components.messageCallback')
    @include('components.message')
    <section class="container-admin">
        @include('components.adm.sidebar')
        <section class="form-content-area">
            @include('components.adm.topbar')
            @include('components.adm.titlePage')
            @include('components.adm.backBtn')
            <div class="form-content-wrapper">
                <div class="admin-table" style="position: relative; margin-bottom: 70px;">
                    <span class="loading" data-js="loadingFetch"></span>
                    <table>
                        <div class="search-box">
                            <label for="filter" title="Pesquise o cliente por nome ou cpf"><strong>Busca: &nbsp;</strong></label>
                            <input type="text" id="filter" onkeyup="getFilter(this.value, '{{ route('adm.imoveis.ajax') }}')" placeholder="Pesquisa">
                        </div>
                        <thead>
                        <tr>
                            <th>Nome do locador</th>
                            <th>Telefone</th>
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
    </section>
    <script>
        const titlePage = new admTitlePage("Imóveis", "Visualize, busque  os imóveis, clique em <i class='icon-pencil'></i> para editar e <i class='icon-trash'></i> para apagar.")
    </script>
    <script>
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
                           <td>${data.nome}</td>
                           <td>${data.phone}</td>
                           <td>
                               <div class="btn-area">
                                   <a href="{{ url('/admin/imoveis/editar/') }}/${data.id}"><i class="icon-pencil"></i> Editar</a>
                                   <button type="button" id="deleteRow" onclick="openModal('{{ url('/admin/imoveis/apagar') }}', ${data.id}, '{{ route('adm.imoveis.all') }}')"><i class='icon-trash'></i>Apagar</button>
                                   <a style="margin-left: 15px;" href="{{ url('/admin/imoveis/images/') }}/${data.id}"><i class="icon-picture-o"></i> Imagens</a>
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
                           <td>${data.nome}</td>
                           <td>${data.phone}</td>
                           <td>
                               <div class="btn-area">
                                   <a href="{{ url('/admin/imoveis/editar/') }}/${data.id}"><i class="icon-pencil"></i> Editar</a>
                                   <button type="button" id="deleteRow" onclick="openModal('{{ url('/admin/imoveis/apagar') }}', ${data.id}, '{{ route('adm.imoveis.all') }}')"><i class='icon-trash'></i>Apagar</button>
                                   <a style="margin-left: 15px;" href="{{ url('/admin/imoveis/images/') }}/${data.id}"><i class="icon-picture-o"></i> Imagens</a>
                               </div>
                           </td>
                       </tr>`
                        ))
                    }
                })
        }
        getData("{{ route('adm.imoveis.all') }}")

    </script>
@endsection
