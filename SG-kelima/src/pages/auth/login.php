<?php
	session_start();

	include_once(dirname(__FILE__) . "/../../utils.php");
	if (isset($_SESSION["isLogin"])) {
		goToHome();
	}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="/assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/auth.css">
</head>

<body>
	<div class="container">
		<div id="login-container">
			<div class="row">
				<div class="col l12">
					<h1 class="center-align">Login</h1>
				</div>
			</div>
			<div class="row">
				<div class="col l12">
					<div class="container">
						<form action="/src/actions/LoginAction.php" method="POST" autocomplete="on">
							<div class="row">
								<div class="input-field col s12">
									<input id="username" name="username" type="text" class="validate" placeholder="e.g Jhon doe" autofocus>
									<label for="username">Username</label>
								</div>
								<div class="input-field col s12">
									<input id="password" name="password" type="password" class="validate" placeholder="Your password">
									<label for="password">Password</label>
								</div>
								<div class="col s12">
									<button type="submit" name="submit-button" class="btn btn-large waves-effect blue darken-3" style="width: 100%;">Login</button>
								</div>
								<div class="col l12" style="margin-top: 5%;">
									<h6 class="center-align">
										<a href="/src/pages/auth/register.php">Don't have an account?</a>
									</h6>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="/assets/js/materialize.min.js"></script>
</body>

</html>