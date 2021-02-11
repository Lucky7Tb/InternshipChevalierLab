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

function printString($string)
{
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function uploadFile($keyName)
{
	$fileName = $_FILES[$keyName]["name"];
	$fileSize = $_FILES[$keyName]["size"];
	$fileError = $_FILES[$keyName]["error"];
	$tmpFile = $_FILES[$keyName]["tmp_name"];

	$allowedExtensionFile = ["jpg", "jpeg", "png"];
	$fileExtension = explode(".", $fileName);
	$fileExtension = strtolower(end($fileExtension));

	if (!in_array($fileExtension, $allowedExtensionFile)) {
		$_SESSION["avatarError"] = true;
		$_SESSION["avatarMessage"] = "Format gambar hanya jpg, jpeg, png";
		header("Location: /src/pages/settings");
		exit;
	}

	if ($fileSize > 2000000) {
		$_SESSION["avatarError"] = true;
		$_SESSION["avatarMessage"] = "Ukuran gambar hanya boleh 2Mb";
		header("Location: /src/pages/settings");
		exit;
	}

	$isUploaded = move_uploaded_file($tmpFile, dirname(__DIR__)."../assets/dist/photo/$fileName");

	if($isUploaded){
		if ($_SESSION["photo_profile"] !== "avatar.png") {
			unlink(dirname(__DIR__) . "/assets/dist/photo/" . $_SESSION["photo_profile"]);
		}
		return $fileName;
	}
	
	return null;
}

function goToHome()
{
	header("Location: /");
	exit;
}