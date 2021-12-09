@extends('adm.layouts.site')
@section('content')
    <link rel="stylesheet" href="{{ URL::to('libs/cropper/cropper.min.css') }}">
    <style>
        .save-banner
        {
            width: var(--full);
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 800px;
            margin: 0 auto;
            margin-bottom: 70px;
        }

        .save-banner button
        {
            border-style: none;
            background-color: var(--yellow);
            display: flex;
            width: var(--full);
            min-height: 40px;
            border-radius: 10px 0 10px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
    @include('components.messageCallback')
    @include('components.message')
    <section class="container-admin">
        @include('components.adm.sidebar')
        <section class="form-content-area">
            @include('components.adm.topbar')
            @include('components.adm.titlePage')
            @include('components.adm.backBtn')
            <div class="form-content-wrapper">
                <fieldset data-fieldset="Envie uma imagem">
                    <div class="form-item">
                        <button type="button" class="modal-image" onclick="modalImage.open()" id="modal-image">Selecionar a imagem</button>
                    </div>
                </fieldset>
                <br>
                <br>
                <fieldset data-fieldset="Descrição do banner">
                    <div class="form-item">
                        <input type="text" onkeyup="data.descricao = this.value;" placeholder="Digite a descrição do banner" name="descricao" maxlength="40" id="descricao">
                        <p style="font-size: 14px; color: #b22; padding-left: 15px; padding-top: 10px;">Máximo de caractere: 40</p>
                    </div>
                </fieldset>
                <br>
                <br>
                <fieldset data-fieldset="Link do banner">
                    <div class="form-item">
                        <input type="text" onkeyup="data.link = this.value;" placeholder="Digite o link do banner" name="link" id="link">
                    </div>
                </fieldset>
                <br>
                <br>
                <div class="btn-area save-banner">
                    <button type="button" data-js="sendImageBanner" title="Salvar">Salvar</button>
                </div>
            </div>
            @include('components.adm.footerAdm')
        </section>
    </section>

    <section class="form-send-image">
        <form action="" style="max-width: 1200px;" enctype="multipart/form-data">
            @csrf
            <span onclick="modalImage.close()">[fechar]</span>
            <div class="form-items">
                <div class="img-wrapper">
                    <img src="#" class="imagePreview image-hide" style="max-height: 440px;" alt="Fazendo o upload da imagem">
                </div>
                <label for="uploadImage">Envie a imagem</label>
                <input type="file" data-js="uploadImage" name="uploadImage" id="uploadImage">
            </div>
            <div class="form-items hide-preview" data-js="image-preview">
                <p>Pré-visualização:</p>
                <div class="preview-photo"></div>
                <div class="btn-send-image">
                    <button type="button" data-js="cropp-image"><i class="icon-check"></i> Recortar imagem</button>
                </div>
            </div>
        </form>
    </section>
    <div class="boxMessageTable">
        <div class="boxMessage"></div>
    </div>
    <script src="{{ URL::to('libs/cropper/cropper.min.js') }}"></script>
    <script>
        const titlePage = new admTitlePage("Banners", "Você pode cadastrar as imagens do banner principal da home.");
        const back =  new setBackLink("{{ route('adm.bannner.show') }}");
        let cropp = undefined;
        const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
        const saveImage = document.querySelector("[data-js='sendImageBanner']");

        let data = {
            imagem: '',
            descricao: '',
            link: '',
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

        function showOptions(bool = true)
        {
            this.image = document.querySelector(".imagePreview");
            this.preview = document.querySelector("[data-js='image-preview']");

            if(bool === true)
            {
                image.classList.remove("image-hide");
                preview.classList.remove("hide-preview");
            }
            else
            {
                image.classList.add("image-hide");
                preview.classList.add("hide-preview");
            }
        }

        function imagePreview()
        {
            this.inputSendImage = document.querySelector("[data-js='uploadImage']");
            this.image = document.querySelector(".imagePreview");
            this.url = "";

            inputSendImage.addEventListener("change", function(){
                url = window.URL.createObjectURL(this.files[0]);
                const btnOpenModal = document.querySelector(".modal-image");
                if(inputSendImage.files.length > 0)
                {
                    btnOpenModal.innerHTML =  `<p style="color: lawngreen">Adicionado&nbsp;<i style="color: lawngreen" class="icon-check"></i></p>`;
                }
                if(cropp)
                {
                    cropp.destroy()
                }
                showOptions();
                image.src = url;
            })

            bannerImageCropp(image);
        }

        function bannerImageCropp(imagePreview)
        {
            const croppBtn = document.querySelector("[data-js='cropp-image']");

            imagePreview.addEventListener("load", function(){
                cropp = new Cropper(imagePreview, {
                    aspectRatio: 3.2 / 1,
                    viewMode: 3,
                    preview: '.preview-photo',
                });
            })

            croppBtn.addEventListener("click", function(){
                let canvas = cropp.getCroppedCanvas({
                    width: 1920,
                    height: 600,
                });
                canvas.toBlob((blob)=>{
                    // let url = URL.createObjectURL(blob);
                    const reader =  new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function(){
                        const base64 = this.result;
                        data.imagem = base64;
                        modalImage.close();
                    }
                })
            })
        }

        const modalImage = {
            modal: document.querySelector(".form-send-image"),
            close: ()=>{
                modalImage.modal.style.cssText = "display: none";
                cropp.destroy();
                showOptions(false)
            },
            open: ()=>{
                modalImage.modal.style.cssText = "display: flex";
            }
        }

        saveImage.addEventListener("click", async function(){
            const description = document.querySelector("#descricao");
            const link = document.querySelector("#link");
            const btnOpenModal = document.querySelector(".modal-image");
            const form = document.querySelector(".form-send-image form");

            if((data.descricao).length < 1)
            {
                setMessage("A descrição é obrigatória");
            }
            else if((data.link).length < 1)
            {
                setMessage("O link é obrigatório");
            }
            else if((data.imagem).length < 1)
            {
                setMessage("A imagem é obrigatória");
            }
            else
            {
                await fetch("{{ route('adm.bannner.store') }}", {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify(data)
                })
                .then((response)=>response.json())
                .then((responseJson)=>{
                    setMessage(responseJson)
                    btnOpenModal.innerHTML = "Selecionar a imagem";
                    description.value = '';
                    link.value = '';
                    data = {
                        imagem: '',
                        descricao: '',
                        link: '',
                    }
                    form.reset();
                })
            }
        });

        imagePreview();
    </script>
@endsection
