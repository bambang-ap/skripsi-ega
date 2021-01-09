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

session_start();
$user = $_SESSION['user'];
if ($user) {
	echo "<script>alert('Please logout to access this page.'); location.href = 'home.php';</script>";
}

$doRegister = $_POST['doRegister'];

if ($doRegister === 'on'){
	$username = $_POST['username'];
	$phoneNumber = $_POST['phoneNumber'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$fullName = $firstName." ".$lastName;
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];
	
	$check = $db->Execute('SELECT * FROM user WHERE username=? OR phoneNumber=?', [$username, $phoneNumber]);
	if ($check) {
		echo "Username or Phone number is duplicate";
	} else {
		if ($password === $confirmPassword && $password && $confirmPassword) {
			$d = $db->Execute("INSERT INTO user (username, phoneNumber, name, email, password) VALUES (?,?,?,?,?)", [$username, $phoneNumber, $fullName, $email, $password]);
			$username='';
			$phoneNumber='';
			$firstName='';
			$lastName='';
			$email='';
			echo "Registration success";
		} else {
			echo "Password note same";
		}
	}
}

?>

<body class="h-full">
	<div class="flex h-full justify-center items-center">
		<form class="flex flex-col" method="POST" action="register.php">
			<input type="checkbox" name="doRegister" checked class="hidden" />
			<div class="input-group mb-3">
				<span class="input-group">Username</span>
				<input type="text" class="form-control" name="username" value="<? echo $username; ?>" required />
			</div>
			<div class="input-group mb-3">
				<span class="input-group">Phone number</span>
				<input type="text" class="form-control" name="phoneNumber" value="<? echo $phoneNumber; ?>" required />
			</div>
			<div class="input-group mb-3">
				<span class="input-group">First Name</span>
				<input type="text" class="form-control" name="firstName" value="<? echo $firstName; ?>" required />
			</div>
			<div class="input-group mb-3">
				<span class="input-group">Last Name</span>
				<input type="text" class="form-control" name="lastName" value="<? echo $lastName; ?>" required />
			</div>
			<div class="input-group mb-3">
				<span class="input-group">E-mail Address</span>
				<input type="email" class="form-control" name="email" value="<? echo $email; ?>" required />
			</div>
			<div class="input-group mb-3">
				<span class="input-group">Password</span>
				<input type="password" class="form-control" name="password" required />
			</div>
			<div class="input-group mb-3">
				<span class="input-group">Confirm Password</span>
				<input type="password" class="form-control" name="confirmPassword" required />
			</div>
			<div class="flex justify-between">
				<a href="login.php" class="flex flex-1 btn btn-primary">Login</a>
				<div class="p-1"></div>
				<button type="submit" class="flex flex-1 btn btn-primary">Register</button>
			</div>
		</form>
	</div>
</body>

</html>