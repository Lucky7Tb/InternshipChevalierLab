<?php session_start(); ?>
<?php include_once(dirname(__dir__) . "/../../src/template/header.php") ?>

<?php
if (!isset($_SESSION["isLogin"])) {
	header("Location: /login");
	exit;
}
?>

<div class="container" style="margin-top: 2em">
	<h3>Cari teman</h3>
	<div class="row">
		<div class="col s5">
			<div class="input-field">
				<i class="material-icons prefix blue-text">search</i>
				<input id="search-field" type="text" name="search_field" autofocus>
				<label for="search-field">Cari id user atau nama user</label>
			</div>
		</div>
		<div class="col s3" style="margin-top: 1em">
			<button class="waves-effect btn btn-large blue darken-3" id="search-button">Search</button>
		</div>
	</div>

	<ul class="collection" id="list-friend" style="height: 450px; overflow: auto">
	</ul>

</div>

<script>
	<?php if (isset($_SESSION["addFriendSuccess"])) { ?>
		M.toast({
			html: "<?= $_SESSION['addFriendMessage'] ?>",
			classes: "green accent-2"
		})
	<?php
		unset($_SESSION["addFriendSuccess"]);
		unset($_SESSION["addFriendMessage"]);
	} ?>

	<?php if (isset($_SESSION["serverError"])) { ?>
		M.toast({
			html: "<?= $_SESSION['errorMessage'] ?>",
			classes: "red light-3"
		});
	<?php unset($_SESSION["serverError"]);
		unset($_SESSION["errorMessage"]);
	} ?>

	const searchField = document.querySelector("#search-field");
	const searchButton = document.querySelector("#search-button");
	const listFriend = document.querySelector("#list-friend");

	searchButton.addEventListener("click", function() {
		const formData = new FormData;
		formData.append("key", searchField.value);

		fetch(`/src/actions/SearchFriends.php`, {
				method: "POST",
				body: formData
			})
			.then(result => result.json())
			.then(result => {
				listFriend.innerHTML = "";
				element = "";

				if (result.length === 0) {
					element += '<li class="center-align">Tidak ditemukan</li>';
				} else {
					result.forEach(data => {
						element += `
						<li class="collection-item avatar">
							<img src="/assets/dist/photo/${data.photo_profile}" alt="Foto profile" class="circle">
							<p class="flow-text">${data.username}</p>
							<p>${data.unique_id}</p>
							<a href="/" class="secondary-content blue-text" onclick="addFriend(event, ${data.id})"><i class="material-icons">person_add</i></a>
						</li>
						`;
					});
				}
				listFriend.innerHTML = element;
			})
	});


	function addFriend(event, userId) {
		event.preventDefault();
		const formData = new FormData;

		formData.append("friend_id", userId);

		fetch(`/src/actions/AddFriends.php`, {
				method: "POST",
				body: formData
			})
			.then(result => result.json())
			.then(result => {
				if (result.code === 200) {
					M.toast({
						html: result.message,
						classes: "green accent-2"
					})
				} else {
					M.toast({
						html: result.message,
						classes: "red light-3"
					})
				}
			})
	}
</script>

<?php include_once(dirname(__dir__) . "/../../src/template/footer.php") ?>