@extends('adm.layouts.site')
@section('content')
    <style>
        .btn-area-banner
        {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            width: var(--full);
            margin: 50px 0;
            padding: 0 20px;
        }

        .btn-area-banner a
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

        .btn-area-banner a i
        {
            margin-left: 10px;
            font-size: 14px;
        }
    </style>
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
                            <th>Descrição banner</th>
                            <th>link</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody data-js="table-content">
                        </tbody>
                    </table>
                </div>
                <div class="btn-area-banner">
                    <a href="{{ route('adm.bannner.create') }}" title="Cadastrar">Cadastrar <i class="icon-plus"></i></a>
                </div>
            </div>
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
                    else
                    {
                        Object.values(responseJson).map((data)=>(
                            table.innerHTML += `<tr>
                           <td>${data.description}</td>
                           <td>${data.link}</td>
                           <td>
                               <div class="btn-area">
                                   <a href="{{ url('/admin/banner/edit/') }}/${data.id}"><i class="icon-pencil"></i> Editar</a>
                                   <button type="button" id="deleteRow" onclick="openModal('{{ url('/admin/banner/delete/') }}', ${data.id}, '{{ route('adm.bannner.all') }}')"><i class='icon-trash'></i>Apagar</button>
                               </div>
                           </td>
                       </tr>`
                        ))
                    }

                })
        }

        getData("{{ route('adm.bannner.all') }}")

        const titlePage = new admTitlePage("Banner", "Visualize, edite ou exclua os banner, clique em <i class='icon-pencil'></i> para editar e <i class='icon-trash'></i> para apagar.");
    </script>
@endsection
