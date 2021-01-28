<?php
include_once(dirname(__FILE__) . "/../db/DBConnection.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST["submit-button"])){
		if(!empty($_POST["username"]) && !empty($_POST["password"])){
			$username = $_POST["username"];
			$password = $_POST["password"];

			$query = "SELECT * FROM users WHERE username = '$username' ";
			$result = mysqli_query($connection, $query);

			if (mysqli_num_rows($result) > 0) {
				$data = mysqli_fetch_assoc($result);
				if (password_verify($password, $data["password"])) {
					header("Location: /");
					exit;
				} else {
					header("Location: /src/pages/auth/login.php");
					exit;
				}
			} else {
				header("Location: /src/pages/auth/login.php");
				exit;
			}
		}else{
			header("Location: /src/pages/auth/login.php");
			exit;
		}
	}
}else{
	header("Location: /src/pages/auth/login.php");
	exit;
}
