<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require('components/imports.php'); ?>
	<title>SOUNDSEE.NET </title>
</head>

<?php

include 'config/connect.php';
session_start();

if ($_GET['updated']) {
	$data_post = $db->ExecuteAll("SELECT eventData.*, user.name as nameUser, user.id as idUser FROM eventData JOIN user ON eventData.idOwner=user.id WHERE created >= NOW() - INTERVAL 2 HOUR ORDER BY created DESC, shared DESC LIMIT 1", []);
} else {
	$data_post = $db->ExecuteAll('SELECT eventData.*, user.name as nameUser, user.id as idUser FROM eventData JOIN user ON eventData.idOwner=user.id ORDER BY created DESC, shared DESC', []);
}

?>

<body>
	<?php require('components/header.php'); ?>
	<div class="app">
		<?php
		$withOwner = true;
		if ($_GET['updated']) {
		?>
			<h2 class="text-center section-title mt-5 pb-5">NEWS UPDATE LAST 2 HOURS</h2>
		<?php	} else { ?>
			<h2 class="text-center section-title mt-5 pb-5">ALL POST</h2>
		<?php
		}
		require('components/post-content.php');
		require('components/footer.php');
		?>
	</div>
</body>

</html>