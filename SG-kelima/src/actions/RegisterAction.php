<?php
include_once(dirname(__FILE__) . "/../db/DBConnection.php");
include_once(dirname(__FILE__) . "/../utils.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["submit-button"])) {
		if ( !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["username"]) ) {
			$username = $_POST["username"];
			$password = $_POST["password"];
			$confirmPassword = $_POST["confirm_password"];
			$uniqueId = generateRandomString();
			$today = date("Y-m-d H:i:s");

			if($password !== $confirmPassword){
				header("Location: /src/pages/auth/register.php");
				exit;
			}else{
				$password = password_hash($password, PASSWORD_BCRYPT);
				$query = "
					INSERT INTO users (username, password, unique_id, created_at, updated_at)
					VALUES ('$username', '$password', '$uniqueId', '$today', '$today');
				";
				
				$result = mysqli_query($connection, $query);

				$isRegistered = mysqli_affected_rows($connection);
				checkIsFail($isRegistered, "/src/pages/auth/register.php");

				header("Location: /src/pages/auth/login.php");
				exit;
			}
		}else{
			header("Location: /src/pages/auth/register.php");
			exit;
		}
	}
}else{
	header("Location: /src/pages/auth/register.php");
	exit;
}
