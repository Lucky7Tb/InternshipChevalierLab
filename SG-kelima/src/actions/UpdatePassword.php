<?php

include_once(dirname(__FILE__) . "/../db/DBConnection.php");
include_once(dirname(__FILE__) . "/../utils.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["update_button"])) {
		$userId = $_POST["user_id"];
		$oldPassword = $_POST["old_password"];
		$newPassword = password_hash($_POST["new_password"], PASSWORD_BCRYPT);
		$today = date("Y-m-d H:i:s");

		$query = "SELECT password FROM users WHERE id = '$userId' ";
		
		$result = mysqli_query($connection, $query);

		$currenPassword = mysqli_fetch_assoc($result);
		$currenPassword = $currenPassword["password"];

		if(!password_verify($oldPassword, $currenPassword)){
			$_SESSION["updatePasswordError"] = true;
			$_SESSION["updatePasswordMessage"] = "Password lama anda salah";
			header("Location: /src/pages/settings/");
			exit;
		}

		$query = "UPDATE users SET password='$newPassword', updated_at = '$today' WHERE id = '$userId'";

		$isUpdated = mysqli_query($connection, $query);

		checkIsFail($isUpdated, "/src/pages/settings/");

		$_SESSION["updateSuccess"] = true;
		$_SESSION["updateMessage"] = "Berhasil mengubah password";
		header("Location: /src/pages/settings/");
		exit;
	}
} else {
	header("Location: /src/pages/settings/");
	exit;
}
