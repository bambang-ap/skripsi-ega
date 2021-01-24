<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require('components/imports.php'); ?>
	<title>SOUNDSEE.NET </title>
</head>

<?php
require "config/connect.php";
session_start();
$user = $_SESSION['user'];
if (!$user) {
	header('location: 404.php');
}
$data_contact = $db->ExecuteAll('SELECT * FROM contact WHERE idOwner=? ORDER BY name ASC', [$user['id']]);
?>

<body>
	<?php require('components/header.php');?>
	<div class="app">
		<form class="flex form-post flex-col" method="POST" action="manage/add-contact.php">
			<div>
				<h2 class="pb-5 section-title">ADD CONTACT</h2>
				<div class="flex mb-2 form-contact">
					<div class="mr-1 w-1/3">
						<label class="form-label">Name</label>
						<input type="text" class="form-control" name="name" title="Name or alias" placeholder="e.g. Makmur Sukimin" required>
					</div>
					<div class="ml-1 mr-1 w-1/3">
						<label class="form-label">Phone number</label>
						<input type="number" class="form-control" name="phoneNumber" title="Please use country code without (+) plus sign" placeholder="e.g. 6285712344321" required>
					</div>
					<div class="ml-1 w-1/3">
						<label class="form-label">Company name</label>
						<input type="text" class="form-control" name="companyName" title="Company name or else to identify this person" placeholder="e.g. PT. Makmur Jaya" required>
					</div>
				</div>
			</div>
			<button class="btn btn-primary submit-btn flex self-end" type="submit">ADD</button>
		</form>
		<h2 class="text-center pb-5 section-title">YOUR CONTACTS</h2>
		<?php
			require('components/list-contact.php');
			require('components/footer.php');
		?>
	</div>
</body>

</html>