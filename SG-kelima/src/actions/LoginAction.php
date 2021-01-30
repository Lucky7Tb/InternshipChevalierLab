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
					$_SESSION["isLogin"] = true;
					$_SESSION["username"] =  $data["username"];
					$_SESSION["unique_id"] =  $data["unique_id"];
					session_destroy();
					header("Location: /");
					exit;
				} else {
					$_SESSION["loginError"] = true;
					$_SESSION["loginMessage"] = "Password anda salah";
					header("Location: /login");
					exit;
				}
			} else {
				$_SESSION["loginError"] = true;
				$_SESSION["loginMessage"] = "User tidak di temukan";
				header("Location: /login");
				exit;
			}
		}else{
			$_SESSION["loginError"] = true;
			$_SESSION["loginMessage"] = "Harap isi semua form";
			header("Location: /login");
			exit;
		}
	}
}else{
	header("Location: /login");
	exit;
}
