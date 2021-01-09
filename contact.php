<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<? require('components/imports.php'); ?>
	<title>Hello, world!</title>
</head>

<?
require "config/connect.php";
session_start();
$user = $_SESSION['user'];
if (!$user) {
	header('location: 404.php');
}
$data_contact = $db->ExecuteAll('SELECT * FROM contact WHERE idOwner=? ORDER BY name ASC', [$user['id']]);
?>

<body>
	<? require('components/header.php');?>
	<div class="app">
		<form class="flex form-post flex-col" method="POST" action="manage/add-contact.php">
			<div>
				<h2 class="pb-5 text-center">ADD CONTACT</h2>
				<div class="flex mb-2">
					<div class="mr-1 w-1/3">
						<label class="form-label">Name</label>
						<input type="text" class="form-control" name="name" placeholder="Type here..." required>
					</div>
					<div class="ml-1 mr-1 w-1/3">
						<label class="form-label">Phone number</label>
						<input type="text" class="form-control" name="phoneNumber" placeholder="Type here..." required>
					</div>
					<div class="ml-1 w-1/3">
						<label class="form-label">Company name</label>
						<input type="text" class="form-control" name="companyName" placeholder="Type here..." required>
					</div>
				</div>
			</div>
			<button class="btn btn-primary flex self-end" type="submit">ADD</button>
		</form>
		<h2 class="text-center pb-5">YOUR CONTACTS</h2>
		<?
			require('components/list-contact.php');
			require('components/footer.php');
		?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>