<?php
session_start();
include_once(dirname(__FILE__) . "/../db/DBConnection.php");

$query = "SELECT * FROM users WHERE unique_id LIKE '%".$_POST["key"]."%' AND id != '".$_SESSION['user_id']."' ";

$result = mysqli_query($connection, $query);

$userData = [];

while($data = mysqli_fetch_assoc($result)){
	$userData[] = $data;
}

echo json_encode($userData);