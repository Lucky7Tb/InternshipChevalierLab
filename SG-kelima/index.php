<?php
	session_start();

	include_once(dirname(__FILE__) . "/src/utils.php");
	if (!isset($_SESSION["isLogin"])) {
		header("Location: login");
		exit;
	}
?>
<?php include_once(dirname(__FILE__) . "/src/template/header.php") ?>
<h1>Hallo</h1>
<?php include_once(dirname(__FILE__) . "/src/template/footer.php") ?>