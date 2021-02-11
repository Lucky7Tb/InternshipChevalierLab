<?php
session_start();

include_once(dirname(__DIR__) . "/../../src/db/DBConnection.php");
include_once(dirname(__DIR__) . "/../../src/utils.php");

if (!isset($_SESSION["isLogin"])) {
	header("Location: /login");
	exit;
}

$query = "SELECT friends.*, users.username FROM friends JOIN users ON friends.user_friend_id = users.id WHERE user_id = '" . $_SESSION['user_id'] . "'";
$result = mysqli_query($connection, $query);

$totalData = mysqli_num_rows($result);
$dataPerPage = 5;
$totalPage = ceil($totalData / $dataPerPage);
$activePage = isset($_GET["page"]) ? $_GET["page"] : 1;
$firstIndexLimit = ($dataPerPage * $activePage) - $dataPerPage;

$query = "SELECT friends.*, users.username FROM friends JOIN users ON friends.user_friend_id = users.id WHERE user_id = '" . $_SESSION['user_id'] . "' LIMIT $firstIndexLimit, $dataPerPage";
$result = mysqli_query($connection, $query);
?>
<?php include_once(dirname(__DIR__) . "/../../src/template/header.php") ?>

<div class="container" style="margin-top: 5em">
	<h3>Daftar teman</h3>
	<table class="stripped centered" style="margin-top: 1em">
		<thead>
			<tr>
				<th>Nama teman</th>
				<th>Aksi</th>
			</tr>
		</thead>

		<tbody id="friend-table-body">
			<?php if (mysqli_num_rows($result) == 0) : ?>
				<tr>
					<td colspan="4">Tidak ada data</td>
				</tr>
			<?php else : ?>

				<?php while ($data = mysqli_fetch_assoc($result)) : ?>
					<tr>
						<td><?= printString($data["username"]) ?></td>
						<td>
							<a href="/src/pages/friend/listSongs.php?id=<?= $data["user_friend_id"] ?>" class="btn btn-small blue darken-3 waves-effect">Lihat lagu</a>
						</td>
					</tr>
				<?php endwhile; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<ul class="pagination right-align">
		<?php for ($i = 1; $i <= $totalPage; $i++) : ?>
			<li class="<?= $i == $activePage ? "active" : null; ?> waves-effect"><a href="?page=<?= $i ?>"><?= $i ?></a></li>
		<?php endfor; ?>
	</ul>
</div>
<?php include_once(dirname(__DIR__) . "/../../src/template/footer.php") ?>