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
<script>
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

    function openModal(route, id, fetchAfterDelete)
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
                getData(fetchAfterDelete)
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
