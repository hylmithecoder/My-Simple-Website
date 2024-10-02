
function stickNavbar() 
{
    const navbar = document.getElementById("topnav");
    let sticky = navbar.offsetTop;
    // console.log(sticky);
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
}

window.addEventListener('scroll',stickNavbar);
console.log("Connected to script.js");
