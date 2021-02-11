<?php
session_start();

include_once(dirname(__FILE__) . "/src/utils.php");
include_once(dirname(__FILE__) . "/src/db/DBConnection.php");

if (!isset($_SESSION["isLogin"])) {
	header("Location: login");
	exit;
}

$query = "SELECT * FROM songs";
$result = mysqli_query($connection, $query);

$totalData = mysqli_num_rows($result);
$dataPerPage = 5;
$totalPage = ceil($totalData / $dataPerPage);
$activePage = isset($_GET["page"]) ? $_GET["page"] : 1;
$firstIndexLimit = ($dataPerPage * $activePage) - $dataPerPage;

$query = "SELECT * FROM songs WHERE user_id = '" . $_SESSION['user_id'] . "' LIMIT $firstIndexLimit, $dataPerPage";
$result = mysqli_query($connection, $query);
?>
<?php include_once(dirname(__FILE__) . "/src/template/header.php") ?>

<div class="container" style="margin-top: 5em">
	<div>
		<a href="src/pages/song/create.php" class="btn btn-large blue darken-3">Tambah lagu</a>
	</div>

	<div class="right">
		<div class="input-field" style="margin-bottom: 2em">
			<i class="material-icons prefix blue-text">search</i>
			<input id="search-field" type="text" name="search_field">
			<label for="search-field">Nama lagu</label>
		</div>
	</div>
	<table class="stripped centered" style="margin-top: 1em">
		<thead>
			<tr>
				<th>Nama lagu</th>
				<th>Link lagu</th>
				<th>Rekomendasi</th>
				<th>Aksi</th>
			</tr>
		</thead>

		<tbody id="song-table-body">
			<?php if (mysqli_num_rows($result) == 0) : ?>
				<tr>
					<td colspan="4">Tidak ada data</td>
				</tr>
			<?php else : ?>

				<?php while ($data = mysqli_fetch_assoc($result)) : ?>
					<tr>
						<td><?= printString($data["song_name"]) ?></td>
						<td>
							<a href="<?= $data["song_url"] ?>" target="_blank">
								Lihat dan dengarkan lagu
							</a>
						</td>
						<td>
							<?= printString($data["song_is_recommended"]) ? '<span class="badge blue darken-3 white-text rounded">Direkomendasikan</span>' : '<span class="badge grey darken-1 white-text">Tidak direkomendasi</span>' ?>
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
	<ul class="pagination right-align">
		<?php for($i = 1; $i <= $totalPage; $i++): ?>
			<li class="<?= $i == $activePage ? "active" : null; ?> waves-effect"><a href="?page=<?= $i ?>"><?= $i ?></a></li>
		<?php endfor; ?>
	</ul>
</div>

<script>
	const deleteButton = document.querySelectorAll(".delete-button");
	const deleteForm = document.querySelector("#delete-form");
	const searchField = document.querySelector("#search-field");
	const songTableBody = document.querySelector("#song-table-body");


	deleteButton.forEach(button => {
		button.addEventListener("click", (e) => {
			const willDeleted = confirm("Yakin ingin menghapusnya?");

			if(willDeleted) button.children[1].submit();
		});
	});

	searchField.onkeyup = function() {
		fetch(`src/actions/SearchSong.php?key=${searchField.value}`, {
				method: "GET"
			})
			.then(result => result.json())
			.then(result => {
				songTableBody.innerHTML = "";
				element = "";

				if (result.length > 0) {
					result.forEach(data => {
						element += `
					<tr>
						<td>${data.song_name}</td>
						<td>
							<a href="'${data.song_url}'" target="_blank">
								Lihat dan dengarkan lagu
							</a>
						</td>
						<td>
							${data.song_is_recommended == '1' ? '<span class="badge blue darken-3 white-text rounded">Direkomendasikan</span>' : '<span class="badge grey darken-1 white-text">Tidak direkomendasi</span>'}
						</td>
						<td>
							<a href="/src/pages/song/edit.php?id=${data.id}">
								<i class="material-icons">edit</i>
							</a>
							<a href="javascript:void(0)" class="red-text delete-button">
								<i class="material-icons">delete</i>
								<form action="/src/actions/DeleteSong.php" method="POST" style="display: hidden" id="delete-form">
									<input type="hidden" name="songId" value="${data.id}">
								</form>
							</a>
						</td>
					</tr>
					`;
					});
				} else {
					element += `
				<tr>
					<td colspan="4">Tidak ada data</td>
				</tr>
				`;
				}

				songTableBody.innerHTML = element;
			})
			.catch(error => {
				M.toast({
					html: "Terjadi kesalahan pada server",
					classes: "red light-3"
				});
				console.log(error);
			});
	}

	<?php if (isset($_SESSION["serverError"])) { ?>
		M.toast({
			html: "<?= $_SESSION['errorMessage'] ?>",
			classes: "red light-3"
		});
	<?php unset($_SESSION["serverError"]);
		unset($_SESSION["errorMessage"]);
	} ?>

	<?php if (isset($_SESSION["updateSuccess"])) { ?>
		M.toast({
			html: "<?= $_SESSION['updateMessage'] ?>",
			classes: "green accent-2"
		})
	<?php unset($_SESSION["updateSuccess"]);
		unset($_SESSION["updateMessage"]);
	} ?>

	<?php if (isset($_SESSION["deleteSuccess"])) { ?>
		M.toast({
			html: "<?= $_SESSION['deleteMessage'] ?>",
			classes: "green accent-2"
		})
	<?php unset($_SESSION["deleteSuccess"]);
		unset($_SESSION["deleteMessage"]);
	} ?>
</script>

<?php include_once(dirname(__FILE__) . "/src/template/footer.php") ?>