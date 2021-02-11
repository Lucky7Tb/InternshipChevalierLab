<?php session_start(); ?>

<?php include_once(dirname(__dir__) . "/../../src/template/header.php") ?>

<?php
if (!isset($_SESSION["isLogin"])) {
	header("Location: /login");
	exit;
}
?>

<div class="container" style="margin-top: 2em">
	<h2 class="center-align">Tambah lagu</h2>
	<form method="POST" action="../../actions/CreateSong.php" style="margin-top: 4em">
		<div class="input-field" style="margin-bottom: 2em">
			<input id="song_name" type="text" name="song_name" class="validate" autofocus required>
			<label for="song_name">Nama lagu</label>
		</div>
		<div class="input-field">
			<input id="song_url" type="text" name="song_url" class="validate" required>
			<label for="song_url">Link lagu(youtube)</label>
		</div>
		<label>
			<input type="checkbox" name="song_is_recommended" />
			<span>Rekomendasikan untuk teman ?</span>
		</label>
		<div class="input-field">
			<button type="submit" name="submit_button" class="btn btn-large blue darken-3">Save</button>
			<button type="reset" class="btn btn-large grey darken-1">Cancel</button>
		</div>
	</form>
</div>

<script>
	<?php if (isset($_SESSION["serverError"])) { ?>
		M.toast({
			html: "<?= $_SESSION['errorMessage'] ?>",
			classes: "red light-3"
		});
	<?php unset($_SESSION["serverError"]);
		unset($_SESSION["errorMessage"]);
	} ?>

	<?php if (isset($_SESSION["createSuccess"])) { ?>
		M.toast({
			html: "<?= $_SESSION['createMessage'] ?>",
			classes: "green accent-2"
		})
	<?php unset($_SESSION["createSuccess"]);
		unset($_SESSION["createMessage"]);
	} ?>

	<?php if (isset($_SESSION["createError"])) { ?>
		M.toast({
			html: "<?= $_SESSION['createErrorMessage'] ?>",
			classes: "red light-3"
		})
	<?php unset($_SESSION["createError"]);
		unset($_SESSION["createErrorMessage"]);
	} ?>
</script>

<?php include_once(dirname(__dir__) . "/../../src/template/footer.php") ?>