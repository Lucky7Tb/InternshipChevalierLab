<?php

session_start();
include_once(dirname(__FILE__) . "/../db/DBConnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$query = "SELECT * FROM friends WHERE user_id = '".$_SESSION['user_id']."' AND user_friend_id = '".$_POST['friend_id']."' ";
	
	$result = mysqli_query($connection, $query);

	if($result){
		if(mysqli_num_rows($result) > 0){
			$userData["code"] = 400;
			$userData["message"] = "Anda sudah berteman dengan user tersebut";
			echo json_encode($userData);
			exit;
		}
	}

	$query = "INSERT INTO friends (user_id, user_friend_id) VALUE('".$_SESSION['user_id']."', '".$_POST['friend_id']. "'), ('".$_POST['friend_id']."','".$_SESSION['user_id']."')";

	$isCreated = mysqli_query($connection, $query);

	$userData = [];

	if ($isCreated) {
		$userData["code"] = 200;
		$userData["message"] = "Berhasil menambah teman";
	} else {
		$userData["code"] = 500;
		$userData["message"] = "Gagal menambah teman";
	}

	echo json_encode($userData);
} else {
	header("Location: /src/pages/friend");
	exit;
}