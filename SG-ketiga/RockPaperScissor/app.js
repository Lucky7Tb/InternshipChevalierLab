const options = ["rock", "paper", "scissor"];
const playerOptions = document.querySelectorAll(".player-image");
const aiOptions = document.getElementById("ai-image");
const statusBoard = document.getElementById("status-board");
const aiScoreBoard = document.getElementById("ai-score");
const playerScoreBoard = document.getElementById("player-score");

let playerChoosenOption,
		aiChoosenOption,
		aiScore = 0,
		playerScore = 0,
		winner;

aiOptions.setAttribute("src", `./img/${options[randomNumber()]}.jpg`);

playerOptions.forEach(option => {
	option.addEventListener("click", () => {
		statusBoard.innerHTML = "";
		const index = option.dataset.choosenOption;
		playerChoosenOption = options[index];
		aiStartChoose();
	})
});

function aiStartChoose() {
	let indexCounter = 0;
	const spinImage = setInterval(() => {
		aiOptions.setAttribute("src", `./img/${options[indexCounter]}.jpg`);
		if(indexCounter === 2) indexCounter = 0;
		else indexCounter++;
	}, 100);

	setTimeout(() => {
		clearInterval(spinImage);
		const aiRandomOption = randomNumber();
		aiOptions.setAttribute("src", `./img/${options[aiRandomOption]}.jpg`);
		aiChoosenOption = options[aiRandomOption];
		
		checkWinner();
		statusBoard.textContent = winner;
		aiScoreBoard.textContent = aiScore.toString();
		playerScoreBoard.textContent = playerScore.toString();
	}, 1000);
}

function checkWinner() {
	if(playerChoosenOption === aiChoosenOption){
		winner = "Draw";
	}else{
		if(playerChoosenOption === "rock"){
			if(aiChoosenOption === "paper"){
				winner = "Ai Win";
				aiScore++;
			}else{
				winner = "Player Win";
				playerScore++;
			}
		}else if(playerChoosenOption === "paper"){
			if(aiChoosenOption === "rock"){
				winner = "Player Win";
				playerScore++;
			}else{
				winner = "Ai Win";
				aiScore++;
			}
		}else{
			if(aiChoosenOption === "rock"){
				winner = "Ai Win";
				aiScore++;
			}else{
				winner = "Player Win";
				playerScore++;
			}
		}
	}
}

function randomNumber() {
	return Math.round(Math.random() * 2);
}