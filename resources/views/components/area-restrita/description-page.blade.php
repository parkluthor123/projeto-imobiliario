<div class="description-restrict-area">
   <div class="container-full">
       <div class="container-static">
           <div class="description-restrict-wrapper">
               <div class="title">
                   <h1 id="ar_title"></h1>
               </div>
               <div class="ar_description">
                   <p id="ar_description"></p>
               </div>
               <div class="btn-area">
                   <a href="{{ route('area-restrita.home') }}" title="Voltar">Voltar</a>
               </div>
           </div>
       </div>
   </div>
</div>

<script>
    function setDescriptionPage(page, description)
    {
        const titulo = document.querySelector("#ar_title").innerHTML = page;
        const descricao = document.querySelector("#ar_description").innerHTML = description;
    }
</script>
