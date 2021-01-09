<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<? require('components/imports.php'); ?>
	<title>Hello, world!</title>
</head>

<?
session_start();
?>

<body>
	<? require('components/header.php');?>
	<div class="app">
		<h2 class="text-center pt-5">Halaman yang anda minta tidak ditemukan</h2>
		<? require('components/footer.php'); ?>
	</div>
</body>

</html>