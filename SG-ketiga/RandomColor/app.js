const randomColorButton = document.getElementById("random-color-button");
const rgbColorContainer = document.getElementById("rgb-color-container");
const rRange = document.getElementById("rRange");
const gRange = document.getElementById("gRange");
const bRange = document.getElementById("bRange");
const body = document.querySelector("body");

randomRGBColor();

randomColorButton.addEventListener("click", () => {
	randomColor = randomRGBColor();
	body.style.backgroundColor = randomColor;
	rgbColorContainer.textContent = randomColor;
})

rRange.addEventListener("mousemove", () => {
	changeColor(rRange.value, gRange.value, bRange.value);
})

gRange.addEventListener("mousemove", () => {
	changeColor(rRange.value, gRange.value, bRange.value);
})

bRange.addEventListener("mousemove", () => {
	changeColor(rRange.value, gRange.value, bRange.value);
})

function changeColor(r, g, b){
	const rgbColor = `rgb(${r}, ${g}, ${b})`;
	body.style.backgroundColor = rgbColor;
	rgbColorContainer.textContent = rgbColor;
}

function randomRGBColor(){
	const rColor = randomNumber();
	const gColor = randomNumber();
	const bColor = randomNumber();
	const randomColor = `rgb(${rColor}, ${gColor}, ${bColor})`;

	body.style.backgroundColor = randomColor;
	rgbColorContainer.textContent = randomColor;

	rRange.value = rColor;
	gRange.value = gColor;
	bRange.value = bColor;
}

function randomNumber(){
	return Math.round(Math.random() * 255 + 1);
}
