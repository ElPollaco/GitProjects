const wyn = document.querySelector("#wyn-js");
const body = document.querySelector("body");

body.addEventListener("click", () => {
    const obiekt = document.activeElement.tagName;
    wyn.innerHTML = obiekt;
    document.cookie = `ciastek=${obiekt}`;
});