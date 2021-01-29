const logoutButton = document.querySelector("#logout-button");
const logoutForm = document.querySelector("#logout-form");
// console.log(logoutButton);
logoutButton.addEventListener("click", function (e) {
	e.preventDefault();
	logoutForm.submit();
})