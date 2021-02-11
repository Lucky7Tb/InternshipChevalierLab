<?php
session_start();

include_once(dirname(__DIR__) . "/../../src/db/DBConnection.php");
include_once(dirname(__DIR__) . "/../../src/utils.php");

if (!isset($_SESSION["isLogin"])) {
	header("Location: /login");
	exit;
}

$query = "SELECT * FROM songs WHERE user_id = '".$_GET['id']. "' AND song_is_recommended = '1'";
$result = mysqli_query($connection, $query);

$totalData = mysqli_num_rows($result);
$dataPerPage = 5;
$totalPage = ceil($totalData / $dataPerPage);
$activePage = isset($_GET["page"]) ? $_GET["page"] : 1;
$firstIndexLimit = ($dataPerPage * $activePage) - $dataPerPage;

$query = "SELECT * FROM songs WHERE user_id = '" . $_GET['id'] . "' AND song_is_recommended = '1' LIMIT $firstIndexLimit, $dataPerPage";
$result = mysqli_query($connection, $query);
?>
<?php include_once(dirname(__DIR__) . "/../../src/template/header.php") ?>

<div class="container" style="margin-top: 5em">
	<table class="stripped centered" style="margin-top: 1em">
		<thead>
			<tr>
				<th>Nama lagu</th>
				<th>Link lagu</th>
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
					</tr>
				<?php endwhile; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<ul class="pagination right-align">
		<?php for ($i = 1; $i <= $totalPage; $i++) : ?>
			<li class="<?= $i == $activePage ? "active" : null; ?> waves-effect"><a href="?id=<?= $_GET['id'] ?>&page=<?= $i ?>"><?= $i ?></a></li>
		<?php endfor; ?>
	</ul>
</div>

<?php include_once(dirname(__DIR__) . "/../../src/template/footer.php") ?>