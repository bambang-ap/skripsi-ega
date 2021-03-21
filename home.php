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

$user = $_SESSION['user'];

$previous_week = strtotime("today");
$start_week = strtotime("last monday", $previous_week);
$end_week = strtotime("next monday", $start_week);
$start_week = date("Y-m-d H:i:s", $start_week);
$end_week = date("Y-m-d H:i:s", $end_week);

$data_post = $db->ExecuteAll("SELECT eventData.*, user.name as nameUser, user.id as idUser FROM eventData JOIN user ON eventData.idOwner=user.id WHERE created > ? ORDER BY shared DESC, created DESC LIMIT 3", [$start_week]);

$updated_post = $db->ExecuteAll("SELECT * FROM eventData WHERE created >= NOW() - INTERVAL 2 HOUR LIMIT 1");

?>
<script>
	$(document).ready(() => {
		setTimeout(() => {
			$('.popup-new-update').css('opacity', '1')
		}, 500);
	})

	function hideNewUpdate() {
		$('.popup-new-update').css('opacity', '0')
	}
</script>

<body>
	<?php require('components/header.php'); ?>
	<?php if ($user) { ?><marquee class="scroll-text">Diharapkan bagi para user untuk mengganti id , dan password secara berkala</marquee><?php } ?>
	<div class="app relative">
		<?php if (count($updated_post) > 0) { ?>
			<div class="popup-new-update">
				<div><?php echo count($updated_post); ?> News updated</div>
				<a class="mr-2 ml-2 btn btn-primary" href="all-posts.php?updated=true">Take a Look</a>
				<i onclick="hideNewUpdate()" class="close-btn fa fa-times"></i>
			</div>
		<?php } ?>
		<div class="banner"></div>
		<h2 class="text-center section-title mt-5 pb-5">POPULAR THIS WEEK</h2>
		<?php
		$withOwner = true;
		require('components/post-content.php');
		?>
		<a class="section-title mt-5 pb-5 flex self-center" href="all-posts.php">
			<h2>More events <i class="fa fa-chevron-right"></i></h2>
		</a>
		<?php require('components/footer.php'); ?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>