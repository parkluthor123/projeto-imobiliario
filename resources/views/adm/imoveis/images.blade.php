@extends('adm.layouts.site')
@section('content')
    <link rel="stylesheet" href="{{ URL::to('libs/cropper/cropper.min.css') }}">
    @include('components.messageCallback')
    @include('components.message')
    <div class="modal-delete-area" data-js="modal-delete">
        <div class="modal-delete-wrapper">
            <span class="loading"></span>
            <div class="modal-header">
                <span id="closeModal" onclick="closeModal()">Fechar</span>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir este ítem?</p>
                <div class="btn-area">
                    <button type="button" id="deleteValue">Sim</button>
                    <button type="button" onclick="closeModal()">Não</button>
                </div>
            </div>
        </div>
    </div>
    <div class="boxMessageTable">
        <div class="boxMessage"></div>
    </div>
    <section class="container-admin">
        @include('components.adm.sidebar')
        <section class="form-content-area">
            @include('components.adm.topbar')
            @include('components.adm.titlePage')
            @include('components.adm.backBtn')
            <div class="form-imoveis-images" style="justify-content: center">
                <button type="button" class="btn-image-insert" onclick="modalImage.open()">
                    <i class="icon-picture-o"></i>
                    <p>Adicionar imagens</p>
                </button>
                <div class="imoveis-image-area" style="
                        @if(count($images) < 3)
                            justify-content: space-around;
                        @else
                            justify-content: space-between;
                        @endif
                    " data-js="images-wrapper">
                </div>
            </div>
            @include('components.adm.footerAdm')
        </section>
        <section class="form-send-image">
            <form action="" onsubmit="(e)=>e.preventDefault();" enctype="multipart/form-data">
                @csrf
                <span onclick="modalImage.close()">[fechar]</span>
                <div class="form-items">
                    <div class="img-wrapper">
                        <img src="#" class="imagePreview image-hide" alt="Fazendo o upload da imagem">
                    </div>
                    <label for="uploadImage">Envie a imagem</label>
                    <input type="file" data-js="uploadImage" name="uploadImage" id="uploadImage">
                </div>
                <div class="form-items hide-preview" data-js="image-preview">
                    <p>Pré-visualização:</p>
                    <div class="preview-photo"></div>
                    <div class="btn-send-image">
                        <button type="button" data-js="send-image"><i class="icon-check"></i> Salvar imagem</button>
                    </div>
                </div>
            </form>
        </section>
    </section>

    <script src="{{ URL::to('libs/cropper/cropper.min.js') }}"></script>
    <script>
        const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
        const table = document.querySelector('[data-js="table-content"]');
        const back = new setBackLink("{{ route('adm.imoveis.show') }}");
        let cropper = undefined;

        function displayLoading(boolean)
        {
            const loading = document.querySelector(".loading");
            if(boolean == true)
            {
                loading.style.cssText = "display: block !important";
            }
            else
            {
                loading.style.cssText = "display: false !important";
            }
        }

        function setMessage(message)
        {
            this.boxMessage = document.querySelector(".boxMessageTable");
            this.boxInside = document.querySelector(".boxMessage");
            boxMessage.style.cssText = "display: flex";
            boxInside.innerHTML = `<p style="color: #fff; font-weight: bold;">${message}</p>`;

            return setTimeout(()=>{
                boxMessage.style.cssText = "display: none";
            }, 4000)
        }

        function imagePreview()
        {
            this.file = document.querySelector("[data-js='uploadImage']");
            this.img = document.querySelector(".imagePreview");

            file.addEventListener("change", ()=>{
                this.urlImage = window.URL.createObjectURL(file.files[0]);
                img.src = urlImage;
                if(cropper)
                {
                    cropper.destroy()
                }
            });

            return img.addEventListener("load", ()=>{
                img.classList.remove("image-hide");
                const preview = document.querySelector("[data-js='image-preview']");
                preview.style.cssText = "display: flex !important"
            });
        }

        imagePreview();

        function croppImage()
        {
            const sendButton = document.querySelector("[data-js='send-image']");
            img.addEventListener("load", ()=>{
                cropper = new Cropper(img, {
                    aspectRatio: 2.31,
                    viewMode: 3,
                    preview: '.preview-photo',
                });
            });

            sendButton.addEventListener("click", ()=>{
                displayLoading(true);
                let canvas = cropper.getCroppedCanvas({
                    width: 323,
                    height: 140,
                })

                canvas.toBlob(blob=>{
                    url = URL.createObjectURL(blob);
                    let reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = ()=>{

                        this.fileFull = document.querySelector("[data-js='uploadImage']");
                        let base64data = reader.result;
                        let imageFull = new FileReader()
                        imageFull.readAsDataURL(fileFull.files[0]);

                        imageFull.onloadend = async ()=>{
                            let imagemFinal = imageFull.result;

                            await fetch("{{ url('/admin/imoveis/images/store')."/".$imoveis['id'] }}",{
                                method: 'POST',
                                headers:{
                                    'content-type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': token,
                                },
                                body: JSON.stringify({
                                    data:base64data,
                                    fullName: fileFull.files[0].name,
                                    originalImage: imagemFinal
                                })
                            })
                            .then((response)=>response.json())
                            .then((responseJson) =>{
                                getData('{{ url('/admin/imoveis/images/all/')."/".$imoveis['id'] }}');
                                displayLoading(false);
                                setMessage("Informações salvas com sucesso");
                                modalImage.close();
                            })
                        }
                    }
                })
            });
        }

        const getData = async(route)=>
        {
            const container = document.querySelector("[data-js='images-wrapper']")
            await fetch(route, {
                method: 'GET',
                headers:{
                    'content-type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
            .then((response)=>response.json())
            .then((responseJson) =>{
                if(responseJson.length === 0)
                {
                    container.innerHTML = `<h1 style="text-transform:uppercase; text-align: center">Sem conteúdo</h1>`;
                }
                else
                {
                    container.innerHTML = "";
                    Object.values(responseJson).map((data)=>(
                        container.innerHTML+=`
                            <div class="images-imoveis-wrapper">
                                <figure>
                                    <img src="${data.image}" draggable="false" alt="{{ $imoveis['nome'] }}">
                                    <figcaption>
                                        <button type="button" onclick="openModal('{{ url('/admin/imoveis/images/apagar/') }}', ${data.id})"><i class="icon-trash"></i></button>
                                    </figcaption>
                                </figure>
                            </div>
                        `
                    ))
                }
            })
        }

        getData('{{ url('/admin/imoveis/images/all/')."/".$imoveis['id'] }}')
        croppImage()
    </script>


    <script>
        function openModal(route, id)
        {
            const modal = document.querySelector("[data-js='modal-delete']");
            const deleteValue = document.querySelector("#deleteValue");
            modal.classList.add("modal-delete-active");
            const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

            deleteValue.addEventListener("click", async ()=>{
                displayLoading(true);
                await fetch(`${route}/${id}`, {
                    method: 'POST',
                    headers:{
                        'content-type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify(id),
                })
                    .then((response)=>response.json())
                    .then((responseJson)=>{
                        displayLoading(false)
                        closeModal();
                        getData('{{ url('/admin/imoveis/images/all/')."/".$imoveis['id'] }}');
                        setMessage(responseJson);
                    })
            })
        }

        function closeModal()
        {
            const modal = document.querySelector("[data-js='modal-delete']");
            modal.classList.remove("modal-delete-active");
        }
    </script>


    <script>
        const titlePage = new admTitlePage("Imóveis", "Você pode cadastrar um novo imóvel. Insira os dados no formulário abaixo e clique em salvar.");

        const modalImage = {
            modal: document.querySelector(".form-send-image"),
            close: ()=>{
                modalImage.modal.style.cssText = "display: none";
                cropper.destroy();
                const preview = document.querySelector("[data-js='image-preview']");
                preview.style.cssText = "display: none !important";
                getData('{{ url('/admin/imoveis/images/all/')."/".$imoveis['id'] }}')
            },
            open: ()=>{
                modalImage.modal.style.cssText = "display: flex";
                this.img = document.querySelector(".imagePreview");
                img.src = null;
                img.classList.add("image-hide");
            }
        }
    </script>
@endsection
