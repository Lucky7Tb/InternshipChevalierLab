<?php

$DB_HOST = "localhost";
$DB_NAME = "cheva_song";
$DB_USERNAME = "root";
$DB_PASSWORD = "";

$connection = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if (mysqli_connect_errno()) {
	echo "Koneksi ke database error. Harap cek koneksi database anda";
	exit();
}