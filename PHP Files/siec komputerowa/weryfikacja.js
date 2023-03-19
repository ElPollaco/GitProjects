let idZamowienia = 0;

const ilosci = document.querySelectorAll(".ilosci");
const przyciski = document.querySelectorAll("button");
const produkty = document.querySelectorAll(".produkty");

function koloryIlosci(){
    for(const ilosc of ilosci){
        if(ilosc.innerHTML == 0){
            ilosc.style.backgroundColor = "red";
        }
        else if(ilosc.innerHTML >= 1 && ilosc.innerHTML <= 5){
            ilosc.style.backgroundColor = "yellow";
        }
        else{
            ilosc.style.backgroundColor = "honeydew";
        }
    }
}

for(const przycisk of przyciski){
    przycisk.addEventListener("click", () =>{
        if(przycisk.className == "aktualizacja"){
            let newIlosc = prompt("Podaj nową ilość:");

            for(const ilosc of ilosci){
                if(ilosc.id == przycisk.id){
                    ilosc.innerHTML = newIlosc;
                }
            }
            koloryIlosci();
        }
        else if(przycisk.className == "zamowienie"){
            idZamowienia++;

            for(const produkt of produkty){
                if(produkt.id == przycisk.id){
                    alert(`Zamówienie nr ${idZamowienia}. Produkt: ${produkt.innerHTML}.`);
                }
            }
        }
    });
}