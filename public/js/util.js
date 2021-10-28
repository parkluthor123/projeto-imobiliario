const menu = document.querySelector("#menuMobile");
const switchBtn = document.querySelector(".switch-area label");
const chk = document.querySelector("#switch-light");

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function delete_cookie(name) {
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function setActiveNavbar(prop)
{
    const menuContent = document.querySelector(prop);
    menuContent.classList.toggle("navbar-mobile-active");
}

function switchIconTheme(prop)
{
    const btnSwitch = document.querySelector(prop);
    btnSwitch.classList.toggle("icon-sun");
}

menu.addEventListener("click", ()=>{
    setActiveNavbar(".navbar-mobile");
});

switchBtn.addEventListener("click", ()=>{
    switchIconTheme(".switch-area label i");
    if(chk.checked !== true)
    {
        document.documentElement.setAttribute('data-theme', 'dark');
        setCookie("theme", "dark");
    }
    else
    {
        delete_cookie("theme");
        document.documentElement.removeAttribute('data-theme', 'dark');
    }
})

if(getCookie("theme") == "dark")
{
    document.documentElement.setAttribute('data-theme', 'dark');
    switchIconTheme(".switch-area label i");
    chk.checked = true;
}
else
{
    document.documentElement.removeAttribute('data-theme', 'dark');
}

const getDolar = async()=>
{
    const el = document.querySelector("#usd-value");

    await fetch("https://economia.awesomeapi.com.br/json/USD-BRL",{
        method: "GET",
        headers:{
            "content-type": "application/json",
            "Accept": "application/json",
        }
    })
    .then((response)=>response.json())
    .then((responseJson)=>{
        const data = parseFloat(responseJson[0].ask);
        if(data != null || data != undefined)
        {
            el.innerHTML = "USD "+data.toFixed(2);
        }
    })
}

let splide = 0
let splideCaption = 0

try{
    splide = new Splide( '#slider-home', {
        type: 'fade',
        speed: 1500,
        pagination: false,
        pauseOnHover: false,
        pauseOnFocus: false,
        classes: {
            arrows: 'splide__arrows arrows-wrapper',
            prev  : 'splide__arrow--prev your-class-prev',
            next  : 'splide__arrow--next your-class-next',
        },
    });

    splideCaption = new Splide( '#slider-caption', {
        type: 'loop',
        speed: 1200,
        pagination: false,
        autoplay: true,
        interval: 7000,
        pauseOnHover: false,
        pauseOnFocus: false,
        arrows: false,
    }).mount();

    splide.sync( splideCaption ).mount();
}
catch(e)
{
    splide = 0;
    splideCaption = 0;
}

getDolar();
