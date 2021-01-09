<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<? require('components/imports.php'); ?>
	<title>Hello, world!</title>
</head>

<?
include 'config/connect.php';
session_start();
$user = $_SESSION['user'];
if (!$user) {
	header('location: 404.php');
}
$data_post = $db->ExecuteAll('SELECT eventData.*, user.name as nameUser, user.id as idUser FROM eventData JOIN user ON eventData.idOwner=user.id ORDER BY created DESC, shared DESC', []);
// $data_post = [$data_post[0], $data_post[1]]
?>

<body>
	<? require('components/header.php');?>
	<div class="app">
		<?
			$withOwner = true;
			require('components/post-content.php');
			require('components/footer.php');
		?>
	</div>
</body>

</html>