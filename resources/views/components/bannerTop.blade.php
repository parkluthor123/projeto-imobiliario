<section class="bannerTop-area">
    <div class="container-full">
        <div class="container-static">
            <div class="bannerTop-wrapper">
                <div class="banner-top-items">
                    <div class="description-area">
                        <span id="description"></span>
                    </div>
                </div>
                <div class="banner-top-items">
                    <div class="page-area">
                        <p><span id="pageName"></span> | <a href="{{ url('/') }}" title="Home"><i class="icon-home"></i> Home</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function setBannerTop(desc, pgname)
    {
        const pageName = document.querySelector("#pageName");
        const descricao = document.querySelector("#description");
        pageName.innerHTML = pgname;
        descricao.innerHTML = desc;
    }
</script>