@if($success = Session::get('success'))
    <div class="message-errors" id="message-success">
        <div class="container-full">
            <div class="container-static">
                <div class="message-errors-wrapper">
                    <p style="text-align: center; font-weight: bold; color: #fff; text-transform:uppercase;">{{$success}}</p>
                    <div class="btn-area">
                        <button type="button" id="messageClose">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function handleMessageAnimation(type, ms)
        {
            const message = document.querySelector("#message-success");

            let fadeOut =
                `
                animation: fadeOut ${ms}s ease-in-out forwards alternate;
           `;


            function setStyle()
            {
                return new Promise((resolve)=>{
                    resolve(message.style.cssText = fadeOut)
                })
            }

            if(type === "waiting")
            {

                setTimeout(()=>{
                    setStyle()
                        .then((boolean)=>{
                            if(boolean)
                            {
                                setTimeout(()=>{
                                    message.style.cssText = "display: none";
                                }, (ms.toFixed(1) + 50))
                            }
                        })
                }, 4000);

            }
            else if(type === "now")
            {
                setStyle()
                    .then((boolean)=>{
                        if(boolean)
                        {
                            setTimeout(()=>{
                                message.style.cssText = "display: none";
                            }, (ms.toFixed(1) + 50))
                        }
                    })
            }
        }

        handleMessageAnimation("waiting", 1)
        const btnClose = document.querySelector("#messageClose");
        btnClose.addEventListener("click", ()=>{
            handleMessageAnimation("now", 1);
        })
    </script>
@endif
