<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ChevaSong</title>
	<link rel="stylesheet" href="/assets/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/styles.css">
	<script src="/assets/js/materialize.min.js"></script>
	<script src="/assets/js/app.js"></script>
</head>

<body>
	<ul id="slide-out" class="sidenav sidenav-fixed">
		<li>
			<div class="user-view">
				<div class="background">
					<img src="/assets/img/background_1.png">
				</div>
				<a href="#user"><img class="circle" src="/assets/dist/photo/<?= $_SESSION['photo_profile']; ?>"></a>
				<a href="#name"><span class="white-text name"><?= $_SESSION["username"] ?></span></a>
				<a href="#email"><span class="white-text email">Id: <?= $_SESSION["unique_id"] ?></span></a>
			</div>
		</li>
		<li><a href="/"><i class="material-icons">home</i>Home</a></li>
		<li><a href="/src/pages/friend"><i class="material-icons">people</i>Friends</a></li>
		<li><a href="/src/pages/friend/listFriends.php"><i class="material-icons">music_note</i>Song friends</a></li>
		<li><a href="/src/pages/settings"><i class="material-icons">settings</i>Settings</a></li>
		<li><a href="/" id="logout-button"><i class="material-icons">logout</i>Logout</a></li>
	</ul>
	<form action="/src/actions/LogoutAction.php" method="POST" style="display: none;" id="logout-form"></form>
	<main>