<div class="back-home-area">
    <a data-js="link-back" href="{{ route('adm.home') }}"><i class="icon-chevron-left"></i>&nbsp;Voltar</a>
</div>

<div class="back-home-area back-fixed" data-js="back-home">
    <a data-js="link-back" href="{{ route('adm.home') }}"><i class="icon-chevron-left"></i>&nbsp;Voltar</a>
</div>
<script>
    function getHome()
    {
        const back = document.querySelector("[data-js=back-home]");
        window.addEventListener("scroll", ()=>{
            if(this.scrollY >= 200)
            {
                back.style.cssText = "visibility: visible !important;";
            }
            else
            {
                back.style.cssText = "visibility: hidden !important;";
            }
        })
    }

    function setBackLink(url)
    {
        const link = document.querySelector("[data-js='link-back']");
        if(url !== '')
        {
            link.setAttribute("href", url);
        }
        else
        {
            link.setAttribute("href", '{{ route('adm.home') }}');
        }
    }
    getHome()
</script>
