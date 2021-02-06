<?php
session_start();
include_once(dirname(__dir__) . "../db/DBConnection.php");
include_once(dirname(__dir__) . "../utils.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id = $_POST["songId"];

	$query = "DELETE FROM songs WHERE id = '$id'";

	$isDeleted = mysqli_query($connection, $query);

	checkIsFail($isDeleted, "");

	$_SESSION["deleteSuccess"] = true;
	$_SESSION["deleteMessage"] = "Berhasil menghapus lagu";
	header("Location: /");
	exit;

}else{
	header("Location: /");
	exit;
}