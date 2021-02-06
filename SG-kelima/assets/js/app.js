window.addEventListener("DOMContentLoaded", function(){

	const logoutButton = document.querySelector("#logout-button");
	const logoutForm = document.querySelector("#logout-form");

	logoutButton.addEventListener("click", function (e) {
		e.preventDefault();
		logoutForm.submit();
	});

});