<?php
include_once(dirname(__FILE__) . "/../db/DBConnection.php");
include_once(dirname(__FILE__) . "/../utils.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["update-button"])) {
		$username = $_POST["username"];
		$photoProfile = "avatar.png";
		$today = date("Y-m-d H:i:s");
		
		if($_FILES["avatar"]["name"] !== ""){
			$photoProfile = uploadFile("avatar");
		}

		$query = "UPDATE users SET username = '$username', photo_profile = '$photoProfile', updated_at = '$today' WHERE id = '".$_SESSION['user_id']."' ";
		$isUpdated = mysqli_query($connection, $query);
		checkIsFail($isUpdated, "/src/pages/settings");

		$_SESSION["username"] = $username;
		$_SESSION["photo_profile"] = $photoProfile;
		$_SESSION["updateSuccess"] = true;
		$_SESSION["updateMessage"] = "Berhasil mengupdate profile";
		header("Location: /src/pages/settings");
		exit;
	}
} else {
	header("Location: /src/pages/settings");
	exit;
}

