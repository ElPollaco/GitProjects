document.addEventListener("DOMContentLoaded",() =>{  // skrypt nasłuchuje na władowany w elementy DOM strony, a gdy je wykryje - wykonuje funkcję
    [...document.querySelectorAll("#checkbox-menu input[name='elementy']")].map((el) => { //skrypt ten wybiera wszystkie selektory o nazwie pola input = 'elementy' z diva 
                                                                                         // checkbox-menu, a następnie tworzy mapę tychże selektórów o nazwie 'el' i odpowiednią 
                                                                                         // do tego funkcję
        const element = el; // stała element to mapa o nazwie el
        element.addEventListener("click",(element) => {  // skrypt następnie nasłuchuje się na wszystkie elementy w mapie, czekając aż któryś z checkboxów zostanie wciśnięty;
                                                        // w  przypadku powodzenia któregoś z nich, aktywuje on kolejną funckję z tymże elementem
            const produkt = document.querySelector("form > ."+el.value); // jeżeli funkja się wywoła, tworzy się stała 'produkt' który oznacza wartość checkboxa 
                                                                        // pobranej z mapy el w formularzu
            produkt.classList.toggle("ukryty"); // jednocześnie, przełącza się, pokazując nawiązany do niego element "ukryty"
        }
    ,false)}) // gdy wyżej wymienione warunki nie zachodzą, naturalnie występuje stan fałszu dla obu funkcji
},false);