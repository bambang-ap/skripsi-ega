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

$previous_week = strtotime("today");
$start_week = strtotime("last monday", $previous_week);
$end_week = strtotime("next monday", $start_week);
$start_week = date("Y-m-d H:i:s", $start_week);
$end_week = date("Y-m-d H:i:s", $end_week);

$data_post = $db->ExecuteAll("SELECT eventData.*, user.name as nameUser, user.id as idUser FROM eventData JOIN user ON eventData.idOwner=user.id WHERE created > ? ORDER BY shared DESC, created DESC LIMIT 3", [$start_week]);
?>

<body>
	<?php require('components/header.php');?>
	<div class="app">
		<div class="banner"></div>
		<h2 class="text-center pt-5 pb-5">POPULAR THIS WEEK</h2>
		<?php
			$withOwner = true;
			require('components/post-content.php');
		?>
		<a class="mt-5 pb-5 flex self-center" href="all-posts.php">
			<h2>More events <i class="fa fa-chevron-right"></i></h2>
		</a>
		<?php require('components/footer.php');?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>