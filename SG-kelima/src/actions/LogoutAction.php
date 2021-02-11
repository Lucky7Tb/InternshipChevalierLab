<?php
session_start();
include_once(dirname(__FILE__) . "/../utils.php");

if(($_SERVER["REQUEST_METHOD"] == "POST")){
	session_destroy();
	setcookie("id", "", time() - (time() + (86400 * 30)), "/");
	setcookie("key", "", time() - (time() + (86400 * 30)), "/");
	header("Location: /login");
	exit;
}else {
	goToHome();
}
