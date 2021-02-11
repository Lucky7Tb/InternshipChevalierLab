<?php session_start(); ?>
<?php include_once(dirname(__dir__) . "/../../src/template/header.php") ?>

<?php
if (!isset($_SESSION["isLogin"])) {
	header("Location: /login");
	exit;
}
?>

<div class="container" style="margin-top: 2em">
	<h3>Settings</h3>

	<div id="modal1" class="modal">
		<form action="/src/actions/UpdatePassword.php" method="POST">
			<input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
			<div class="modal-content">
				<h4>Update password</h4>
				<div class="input-field col s12">
					<input id="old_password" name="old_password" type="password" class="validate">
					<label for="old_password">Old password</label>
				</div>
				<div class="input-field col s12">
					<input id="new_password" name="new_password" type="password" class="validate">
					<label for="new_password">New password</label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="update_button" class="waves-effect btn blue darken-3">Save</button>
				<a href="#" class="modal-close waves-effect btn-flat">Close</a>
			</div>
		</form>
	</div>

	<form action="/src/actions/Settings.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
		<div class="row">
			<div class="input-field col s12">
				<input id="username" type="text" name="username" class="validate" value="<?= $_SESSION['username'] ?>">
				<label for="username">Username</label>
			</div>
			<div class="file-field input-field col s12">
				<div class="btn blue darken-3">
					<span>Avatar</span>
					<input type="file" name="avatar">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" id="avatar" type="text">
				</div>
			</div>
			<div class="col s12">
				<a class="waves-effect waves-light btn yellow darken-3 modal-trigger" href="#modal1">Update password</a>
			</div>
			<div class="col s12">
				<button type="submit" name="update-button" class="btn btn-large waves-effect blue darken-3" style="width: 100%; margin-top: 2em">Save</button>
			</div>
		</div>
	</form>
</div>

<script>
	var elems = document.querySelectorAll('.modal');
	M.Modal.init(elems);

	<?php if (isset($_SESSION["updateSuccess"])) { ?>
		M.toast({
			html: "<?= $_SESSION['updateMessage'] ?>",
			classes: "green accent-2"
		})
	<?php
		unset($_SESSION["updateSuccess"]);
		unset($_SESSION["updateMessage"]);
	} ?>

	<?php if (isset($_SESSION["avatarError"])) { ?>
		M.toast({
			html: "<?= $_SESSION['avatarMessage'] ?>",
			classes: "red light-3"
		});
	<?php unset($_SESSION["avatarError"]);
		unset($_SESSION["avatarMessage"]);
	} ?>

	<?php if (isset($_SESSION["updatePasswordError"])) { ?>
		console.log("dwihdoihdwoihdwoihwdo")
		M.toast({
			html: "<?= $_SESSION['updatePasswordMessage'] ?>",
			classes: "red light-3"
		});
	<?php unset($_SESSION["updatePasswordError"]);
		unset($_SESSION["updatePasswordMessage"]);
	} ?>

	<?php if (isset($_SESSION["serverError"])) { ?>
		M.toast({
			html: "<?= $_SESSION['errorMessage'] ?>",
			classes: "red light-3"
		});
	<?php unset($_SESSION["serverError"]);
		unset($_SESSION["errorMessage"]);
	} ?>
</script>

<?php include_once(dirname(__dir__) . "/../../src/template/footer.php") ?>