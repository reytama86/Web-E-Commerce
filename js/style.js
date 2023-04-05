//efek scroll navbar

window.addEventListener("scroll", function(){
    var nav = document.querySelector("nav");
    nav.classList.toggle("sticky" , window.scrollY > 0);
});