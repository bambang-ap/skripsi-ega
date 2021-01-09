<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<title>Hello, world!</title>
</head>

<?

require('config/connect.php');

$doLogin = $_POST['doLogin'];

if ($doLogin === 'on'){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$check = $db->Execute('SELECT * FROM user WHERE user.password=? AND (username=? OR phoneNumber=?)', [$password, $username, $username]);
	if ($check) {
		session_start();
		$_SESSION['user'] = $check;
		header('location: home.php');
	} else {
		echo "Login failed, please check Username or Password";
	}
}

?>

<body class="h-full">
	<div class="flex h-full justify-center items-center">
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>