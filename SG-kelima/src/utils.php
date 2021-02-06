<?php
function generateRandomString($length = 8)
{
	$string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIZKLMNOPQRSTUVWXYZ1234567890";
	$randomString = "#";
	for($i = 1; $i < $length; $i++){
		$randomString .= $string[mt_rand(0, strlen($string))];
	}
	return $randomString;
}

function echoString($string)
{
	return htmlspecialchars($string);
}

function checkIsFail($fail, $header)
{
	if(!$fail){
		$_SESSION["serverError"] = true;
		$_SESSION["errorMessage"] = "Terjadi suatu kesalahan";
		header("Location: /$header");
		exit;
	}
}

function goToHome()
{
	header("Location: /");
	exit;
}