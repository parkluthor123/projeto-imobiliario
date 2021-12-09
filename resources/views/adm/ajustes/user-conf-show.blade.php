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
                                <th>Nome do usuário</th>
                                <th>Email</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody data-js="table-content">
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <br>
            @include('components.adm.footerAdm')
        </section>
    </section>
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
                    loadingFetch(false)
                    table.innerHTML = '';
                    if(responseJson.length === 0)
                    {
                        table.innerHTML = `<h1 style="text-transform:uppercase; text-align: center">Sem conteúdo</h1>`;
                    }
                    else if(responseJson.length === 1)
                    {
                        Object.values(responseJson).map((data)=>(
                            table.innerHTML += `
                            <tr>
                               <td>${data.name}</td>
                               <td>${data.email}</td>
                               <td>
                                   <div class="btn-area">
                                       <a href="{{ url('/admin/ajustes/configuracoes-usuarios/editar/') }}/${data.id}"><i class="icon-pencil"></i> Editar</a>
                                   </div>
                               </td>
                           </tr>`
                        ))
                    }
                    else
                    {
                        Object.values(responseJson).map((data)=>(
                            table.innerHTML += `
                            <tr>
                               <td>${data.name}</td>
                               <td>${data.email}</td>
                               <td>
                                   <div class="btn-area">
                                       <a href="{{ url('/admin/ajustes/configuracoes-usuarios/editar/') }}/${data.id}"><i class="icon-pencil"></i> Editar</a>
                                       <button type="button" id="deleteRow" onclick="openModal('{{ url('/admin/ajustes/configuracoes-usuarios/delete/') }}', ${data.id}, '{{ route('adm.ajuste.userconf.all') }}')"><i class='icon-trash'></i>Apagar</button>
                                   </div>
                               </td>
                           </tr>`
                        ))
                    }

                })
        }

        getData("{{ route('adm.ajuste.userconf.all') }}")
        const back = new setBackLink("{{ route('adm.ajuste.show') }}");
        const titlePage = new admTitlePage("Ajustes <i class='icon-gear'></i>", "Você pode definir suas configurações do site. Insira os dados no formulário abaixo e clique em salvar.")
    </script>
@endsection
