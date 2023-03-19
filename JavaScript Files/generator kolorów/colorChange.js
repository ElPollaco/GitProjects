const button = document.querySelector("#button");
const tableCells = document.querySelectorAll("td");
let hslSaturation = 100;

button.addEventListener("click", () => {
    let colour = Number(document.querySelector("#number").value);

    for(const cell of tableCells){
        cell.style.backgroundColor = `hsl(${colour}, ${hslSaturation}%, 50%)`; 
        hslSaturation -= 20;
    }
    hslSaturation = 100;
});
