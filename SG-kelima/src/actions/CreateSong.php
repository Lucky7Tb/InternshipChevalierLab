<?php 
session_start();
include_once(dirname(__dir__) . "../db/DBConnection.php");
include_once(dirname(__dir__) . "../utils.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST["submit_button"])){
		$songName = $_POST["song_name"];
		$songUrl = $_POST["song_url"];
		$songIsRecommended = isset($_POST["song_is_recommended"]) ? 1 : 0;
		$today = date("Y-m-d H:i:s");

		$query = " INSERT INTO songs (`user_id`, `song_name`, `song_url`, `song_is_recommended`, `created_at`, `updated_at`) VALUES ('".$_SESSION['user_id']."', '$songName', '$songUrl', '$songIsRecommended', '$today', '$today')";

		$isCreated = mysqli_query($connection, $query);

		checkIsFail($isCreated, "src/pages/song/create.php");

		$_SESSION["createSuccess"] = true;
		$_SESSION["createMessage"] = "Berhasil menambah lagu";
		header("Location: /src/pages/song/create.php");
		exit;
	}

}else{
	header("Location: /src/pages/song/create.php");
	exit;
}