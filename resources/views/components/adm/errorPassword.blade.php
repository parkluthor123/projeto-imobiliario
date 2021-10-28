@if($verify = Session::get('verify'))
    <div class="messageErrorLogin">
        <div class="messageError">
            <p>{{ $verify }}</p>
        </div>
    </div>
    <script>
        window.onload = ()=>{
            const message = document.querySelector(".messageErrorLogin");
            setTimeout(()=>{
                message.style.cssText = "display: none";
            }, 4000)
        }
    </script>
@endif
