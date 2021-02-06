<?php
	session_start();

	include_once(dirname(__FILE__) . "/src/utils.php");
	include_once(dirname(__FILE__) . "/src/db/DBConnection.php");

	if (!isset($_SESSION["isLogin"])) {
		header("Location: login");
		exit;
	}

	$query = "SELECT * FROM songs WHERE user_id = '".$_SESSION['user_id']."'";
	$result = mysqli_query($connection, $query);
?>
<?php include_once(dirname(__FILE__) . "/src/template/header.php") ?>

<div class="container" style="margin-top: 5em">
	<a href="src/pages/song/create.php" class="btn btn-large blue darken-3">Tambah lagu</a>

	<table class="stripped centered" style="margin-top: 1em">
		<thead>
			<tr>
				<th>Nama lagu</th>
				<th>Link lagu</th>
				<th>Rekomendasi</th>
				<th>Aksi</th>
			</tr>
		</thead>

		<tbody>
			<?php if(mysqli_num_rows($result) == 0): ?>
				<tr>
					<td colspan="4">Tidak ada data</td>
				</tr>
			<?php else: ?>

			<?php while($data = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?= $data["song_name"] ?></td>
					<td>
						<a href="<?= $data["song_url"] ?>" target="_blank">
							Lihat dan dengarkan lagu
						</a>
					</td>
					<td>
						<?= $data["song_is_recommended"] ? '<span class="badge blue darken-3 white-text rounded">Direkomendasikan</span>' : '<span class="badge grey darken-1 white-text">Tidak direkomendasi</span>' ?>
					</td>
					<td>
						<a href="/src/pages/song/edit.php?id=<?= $data['id'] ?>">
							<i class="material-icons">edit</i>
						</a>
						<a href="javascript:void(0)" class="red-text delete-button">
							<i class="material-icons">delete</i>
							<form action="/src/actions/DeleteSong.php" method="POST" style="display: hidden" id="delete-form">
								<input type="hidden" name="songId" value="<?= $data['id'] ?>">
							</form>
						</a>
					</td>
				</tr>
			<?php endwhile; ?>

			<?php endif; ?>
		</tbody>
	</table>
</div>

<script>
	const deleteButton = document.querySelectorAll(".delete-button");
	const deleteForm = document.querySelector("#delete-form");

	deleteButton.forEach(button => {
		button.addEventListener("click", (e) => {
			button.children[1].submit();
		});
	});

	<?php if(isset($_SESSION["serverError"])){ ?>
		M.toast({
			html: "<?= $_SESSION['errorMessage'] ?>",
			classes: "red light-3"
		});
	<?php unset($_SESSION["serverError"]); unset($_SESSION["errorMessage"]);}?>

	<?php if(isset($_SESSION["updateSuccess"])){ ?>
		M.toast({
			html: "<?= $_SESSION['updateMessage'] ?>",
			classes: "green accent-2"
		})
	<?php unset($_SESSION["updateSuccess"]); unset($_SESSION["updateMessage"]);}?>

	<?php if(isset($_SESSION["deleteSuccess"])){ ?>
		M.toast({
			html: "<?= $_SESSION['deleteMessage'] ?>",
			classes: "green accent-2"
		})
	<?php unset($_SESSION["deleteSuccess"]); unset($_SESSION["deleteMessage"]);}?>
</script>

<?php include_once(dirname(__FILE__) . "/src/template/footer.php") ?>