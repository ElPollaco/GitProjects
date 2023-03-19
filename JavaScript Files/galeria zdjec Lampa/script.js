const zdjecia = document.querySelectorAll(".galeria-zdj");
const obrazGlowny = document.querySelector("#glowne-zdj");
const zdjSerce = document.querySelector("#zdj-serce");
let licznik = 0;

for(const zdjecie of zdjecia){
    zdjecie.addEventListener("click", function(){
        obrazGlowny.src = this.src;
    });
}

zdjSerce.addEventListener("click", function(){
    licznik++;
    
    if(licznik % 2 != 0){
        zdjSerce.src = "icon-on.png";
    }
    else{
        zdjSerce.src = "icon-off.png";
    }
});