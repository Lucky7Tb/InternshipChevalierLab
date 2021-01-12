const randomColorButton = document.getElementById("random-color-button");
const rgbColorContainer = document.getElementById("rgb-color-container");
const body = document.querySelector("body");

let randomColor = randomRGBColor();

body.style.backgroundColor = randomColor;
rgbColorContainer.textContent = randomColor;

randomColorButton.addEventListener("click", () => {
	randomColor = randomRGBColor();
	body.style.backgroundColor = randomColor;
	rgbColorContainer.textContent = randomColor;
})

function randomRGBColor(){
	return `rgb(${randomNumber()}, ${randomNumber()}, ${randomNumber()})`;
}

function randomNumber(){
	return Math.round(Math.random() * 255 + 1);
}
