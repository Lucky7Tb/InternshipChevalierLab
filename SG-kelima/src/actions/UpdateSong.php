<?php 
// https://www.youtube.com/watch?v=j5-yKhDd64s
session_start();
include_once(dirname(__dir__) . "../db/DBConnection.php");
include_once(dirname(__dir__) . "../utils.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST["submit_button"])){
		$songId = $_POST["song_id"];
		$songName = $_POST["song_name"];
		$songUrl = $_POST["song_url"];
		$songIsRecommended = isset($_POST["song_is_recommended"]) ? 1 : 0;
		$today = date("Y-m-d H:i:s");

		$query = "UPDATE songs SET song_name='$songName',song_url='$songUrl',song_is_recommended='$songIsRecommended',updated_At= '$today' WHERE id = '$songId'";

		$isUpdated = mysqli_query($connection, $query);

		checkIsFail($isUpdated, "");

		$_SESSION["updateSuccess"] = true;
		$_SESSION["updateMessage"] = "Berhasil mengubah lagu";
		header("Location: /");
		exit;
	}

}else{
	header("Location: /");
	exit;
}