<?php
	session_start();
	include_once(dirname(__dir__) . "../../db/DBConnection.php");
	include_once(dirname(__dir__) . "../../utils.php");

	$id = $_GET["id"];
	$query = "SELECT * FROM songs WHERE id = '$id'";
	$result = mysqli_query($connection, $query);
	$data = mysqli_fetch_assoc($result);
?>

<?php include_once(dirname(__dir__) . "/../../src/template/header.php") ?>

<div class="container" style="margin-top: 2em">
	<h2 class="center-align">Edit lagu</h2>
	<form method="POST" action="../../actions/UpdateSong.php" style="margin-top: 4em">
		<input type="hidden" name="song_id" value="<?= $data["id"] ?>" >

		<div class="input-field" style="margin-bottom: 2em">
      <input id="song_name" type="text" name="song_name" class="validate" value="<?= $data["song_name"] ?>" autofocus required>
      <label for="song_name">Nama lagu</label>
    </div>
    <div class="input-field">
      <input id="song_url" type="text" name="song_url" class="validate" value="<?= $data["song_url"] ?>" required>
      <label for="song_url">Link lagu(youtube)</label>
    </div>
   	<label>
      <input type="checkbox" name="song_is_recommended" <?= $data["song_is_recommended"] ? 'checked' : null ?> />
      <span>Rekomendasikan untuk teman ?</span>
    </label>
    <div class="input-field">
    	<button type="submit" name="submit_button" class="btn btn-large blue darken-3">Save</button>
    	<button type="reset" class="btn btn-large grey darken-1">Cancel</button>
    </div>
	</form>
</div>

<?php include_once(dirname(__dir__) . "/../../src/template/footer.php") ?>

