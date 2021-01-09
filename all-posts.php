<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require('components/imports.php'); ?>
	<title>Hello, world!</title>
</head>

<?php

include 'config/connect.php';
session_start();
$data_post = $db->ExecuteAll('SELECT eventData.*, user.name as nameUser, user.id as idUser FROM eventData JOIN user ON eventData.idOwner=user.id ORDER BY created DESC, shared DESC', []);

?>

<body>
	<?php require('components/header.php');?>
	<div class="app">
		<?php
			$withOwner = true;
			require('components/post-content.php');
			require('components/footer.php');
		?>
	</div>
</body>

</html>