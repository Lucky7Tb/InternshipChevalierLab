<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ChevaSong</title>
	<link rel="stylesheet" href="/assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
	<ul id="slide-out" class="sidenav sidenav-fixed">
		<li>
			<div class="user-view">
				<div class="background">
					<img src="/assets/img/background_1.png">
				</div>
				<a href="#user"><img class="circle" src="/assets/img/avatar.png"></a>
				<a href="#name"><span class="white-text name"><?= $_SESSION["username"] ?></span></a>
				<a href="#email"><span class="white-text email"><?= $_SESSION["unique_id"] ?></span></a>
			</div>
		</li>
		<li><a href="#!"><i class="material-icons">home</i>Home</a></li>
		<li><a href="#!"><i class="material-icons">people</i>Friends</a></li>
		<li><a href="#!"><i class="material-icons">settings</i>Settings</a></li>
		<li><a href="/" id="logout-button"><i class="material-icons">logout</i>Logout</a></li>
	</ul>
	<form action="/src/actions/LogoutAction.php" method="POST" style="display: none;" id="logout-form"></form>
	<main>