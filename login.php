<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require('components/imports.php'); ?>
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

<body class="h-full unauth">
	<div class="form-wrapper flex flex-col h-full justify-center items-center">
		<?php if (isset($alertType)) { ?>
			<div class="alert alert-<?php echo $alertType ?>" role="alert">
				<?php echo $alert; ?>
			</div>
		<?php } ?>
		<form class="flex flex-col" method="POST" action="login.php">
			<input type="checkbox" name="doLogin" checked class="hidden" />
			<h2 class="mb-4">Login your account</h2>
			<div class="input-group mb-3">
				<span class="input-group">Username or Email</span>
				<input type="text" name="username" class="form-control">
			</div>
			<div class="input-group mb-3">
				<span class="input-group">Password</span>
				<input type="password" name="password" class="form-control">
			</div>
			<button type="submit" class="flex flex-1 btn btn-primary justify-center">Login</button>
			<label class="mt-2 text-center">Don't have an account? Register <a class="p-0 btn btn-link" href="register.php">here</a></label>
		</form>
	</div>
</body>

</html>