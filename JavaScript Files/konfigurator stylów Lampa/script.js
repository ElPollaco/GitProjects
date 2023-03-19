const buttons = document.querySelectorAll("button");
const options = document.querySelector("select");
const fontSizeInput = document.querySelector("input");
const radioButtons = document.querySelectorAll("input[type=radio]");

const paragraph = document.querySelector("#def-text");
const unList = document.querySelector("ul");

for (const button of buttons) {
    button.addEventListener("click", function(){
        const aside = document.querySelector("aside");
        aside.style.backgroundColor = this.value;
    });
}


options.addEventListener("change", function(){
    for (const option of options) {
        if(option.selected){
            paragraph.style.color = this.value;
            unList.style.color = this.value;
        }
    }
});


fontSizeInput.addEventListener("blur", function(){
    unList.style.fontSize = this.value;
    paragraph.style.fontSize = this.value;
});

function checkboxClick(){
    const checkboxButton = document.querySelector("input[type=checkbox]");
    const image = document.querySelector("img");

    if(checkboxButton.checked){
        image.style.border = "1px solid white";
    }
    else if(!checkboxButton.checked){
        image.style.border = "none";
    }
}

for (const radioButton of radioButtons) {
    radioButton.addEventListener("click", function(){
        unList.style.listStyleType = this.value;
    });
}