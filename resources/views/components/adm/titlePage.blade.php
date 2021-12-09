<div class="title-page-area">
    <div class="title-page-wrapper">
        <div class="title">
            <h1 data-js="titlePage">Clientes</h1>
        </div>
        <div class="description">
            <p data-js="subtitlePage">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
        </div>
    </div>
</div>
<script>
    function admTitlePage(title, subtitle)
    {
        const titulo = document.querySelector("[data-js='titlePage']");
        const subtitulo = document.querySelector("[data-js='subtitlePage']");
        titulo.innerHTML = title;
        subtitulo.innerHTML = subtitle;
    }
</script>
