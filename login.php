<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<title>SOUNDSEE.NET </title>
</head>

<?php

require('config/connect.php');
session_start();
$user = $_SESSION['user'];
if ($user) {
	echo "<script>alert('Please logout to access this page.'); location.href = 'home.php';</script>";
}

$doLogin = $_POST['doLogin'];

if ($doLogin === 'on') {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$check = $db->Execute('SELECT * FROM user WHERE user.password=? AND (username=? OR phoneNumber=?)', [$password, $username, $username]);
	if ($check) {
		$_SESSION['user'] = $check;
		header('location: home.php');
	} else {
		$alertType = "danger";
		$alert = "Login failed, please check Username or Password";
	}
}

?>

<body class="h-full">
	<div class="flex flex-col h-full justify-center items-center">
		<?php if (isset($alertType)) { ?>
			<div class="alert alert-<?php echo $alertType ?>" role="alert">
				<?php echo $alert; ?>
			</div>
		<?php } ?>
		<form class="flex flex-col" method="POST" action="login.php">
			<input type="checkbox" name="doLogin" checked class="hidden" />
			<div class="input-group mb-3">
				<span class="input-group">Username or Email</span>
				<input type="text" name="username" class="form-control">
			</div>
			<div class="input-group mb-3">
				<span class="input-group">Password</span>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="flex justify-between">
				<a href="register.php" class="flex flex-1 btn btn-primary">Register</a>
				<div class="p-1"></div>
				<button type="submit" class="flex flex-1 btn btn-primary">Login</button>
			</div>
		</form>
	</div>
</body>

</html>