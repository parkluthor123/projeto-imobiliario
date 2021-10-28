<div class="title-section-area">
    <div class="title-section">
        <h1 id="titleSection"></h1>
    </div>
</div>

<script>
    function setTitleSection(divPai, name)
    {
        const title = document.querySelector(divPai+" #titleSection");
        title.innerHTML = name;
    }
</script>