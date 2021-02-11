<?php

session_start();
include_once(dirname(__FILE__) . "/../db/DBConnection.php");

if($_GET['key'] != ""){
	$query = "SELECT * FROM songs WHERE song_name LIKE '%".$_GET['key']."%' AND  user_id = '".$_SESSION['user_id']."'";

}else{
	$query = "SELECT * FROM songs WHERE user_id = '".$_SESSION['user_id']."'";
}

$result = mysqli_query($connection, $query);

$userData = [];
while($data = mysqli_fetch_assoc($result)){
	$userData[] = $data;
}

echo json_encode($userData);