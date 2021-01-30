<?php
include_once(dirname(__FILE__) . "/../db/DBConnection.php");
include_once(dirname(__FILE__) . "/../utils.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["submit-button"])) {
		if ( !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["username"]) ){
			$username = $_POST["username"];
			$password = $_POST["password"];
			$confirmPassword = $_POST["confirm_password"];
			$uniqueId = generateRandomString();
			$today = date("Y-m-d H:i:s");

			if($password !== $confirmPassword){
				$_SESSION["registerError"] = true;
				$_SESSION["registerMessage"] = "Konfirmasi password tidak sama";
				header("Location: /register");
				exit;
			}else{
				$query = "SELECT username FROM users WHERE username = '$username'";
				$result = mysqli_query($connection, $query);
			
				if(mysqli_num_rows($result) > 0){
					$_SESSION["registerError"] = true;
					$_SESSION["registerMessage"] = "Username sudah ada yang menggunakan";
					header("Location: /register");
					exit;
				}else{
					$password = password_hash($password, PASSWORD_BCRYPT);
					$query = "INSERT INTO users (`username`, `password`, `unique_id`, `created_at`, `updated_at`)
						VALUES ('$username', '$password', '$uniqueId', '$today', '$today')
					";

					$result = mysqli_query($connection, $query);
					checkIsFail($isRegistered, "register");

					$_SESSION["registerSuccess"] = true;
					$_SESSION["registerMessage"] = "Berhasil registrasi";
					header("Location: /login");
					exit;
				}
			}
		}else{
			$_SESSION["registerError"] = true;
			$_SESSION["registerMessage"] = "Harap isi semua form";
			header("Location: /register");
			exit;
		}
	}
}else{
	header("Location: /register");
	exit;
}
