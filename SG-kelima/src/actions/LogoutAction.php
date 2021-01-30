<?php
session_start();
include_once(dirname(__FILE__) . "/../utils.php");

if(($_SERVER["REQUEST_METHOD"] == "POST")){
	session_destroy();
	header("Location: /login");
	exit;
}else {
	goToHome();
}
