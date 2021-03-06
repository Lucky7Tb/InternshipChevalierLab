<?php
include_once(dirname(__FILE__) . "/../../db/DBConnection.php");
include_once(dirname(__FILE__) . "/../../utils.php");
session_start();

if(isset($_COOKIE["id"]) && isset($_COOKIE["key"])){
	$id = $_COOKIE["id"];
	$key = $_COOKIE["key"];

	$query = "SELECT * FROM users WHERE id = '$id'";
	$result = mysqli_query($connection, $query);
	
	$data = mysqli_fetch_assoc($result);

	if($key === hash("sha256", $data["username"])){
		$_SESSION["isLogin"] = true;
		$_SESSION["user_id"] = $data["id"];
		$_SESSION["username"] = $data["username"];
		$_SESSION["photo_profile"] = $data["photo_profile"];
		$_SESSION["unique_id"] = $data["unique_id"];
	}
}

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
								<div class="switch">
									<label>
										<input type="checkbox" name="remember">
										<span class="lever"></span>
										Remember me?
									</label>
								</div>
								<div class="col s12">
									<button type="submit" name="submit-button" class="btn btn-large waves-effect blue darken-3" style="width: 100%; margin-top: 2em">Login</button>
								</div>
								<div class="col s12" style="margin-top: 5%;">
									<h6 class="center-align">
										<a href="/register">Don't have an account?</a>
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
	<script>
		<?php if (isset($_SESSION["registerSuccess"])) { ?>
			M.toast({
				html: "<?= $_SESSION['registerMessage'] ?>",
				classes: "green accent-2"
			})
		<?php session_destroy();
		} ?>
		<?php if (isset($_SESSION["loginError"])) { ?>
			M.toast({
				html: "<?= $_SESSION['loginMessage'] ?>",
				classes: "red light-3"
			})
		<?php session_destroy();
		} ?>
	</script>
</body>

</html>