<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<title>Hello, world!</title>
</head>

<body class="h-full">
	<div class="flex h-full justify-center items-center">
		<form class="flex flex-col" method="POST" action="login.php">
			<div class="input-group mb-3">
				<span class="input-group">Username or Phone number</span>
				<input type="text" class="form-control">
			</div>
			<div class="input-group mb-3">
				<span class="input-group">First Name</span>
				<input type="text" class="form-control">
			</div>
			<div class="input-group mb-3">
				<span class="input-group">Last Name</span>
				<input type="text" class="form-control">
			</div>
			<div class="input-group mb-3">
				<span class="input-group">E-mail Address</span>
				<input type="text" class="form-control">
			</div>
			<div class="input-group mb-3">
				<span class="input-group">Password</span>
				<input type="text" class="form-control">
			</div>
			<div class="input-group mb-3">
				<span class="input-group">COnfirm Password</span>
				<input type="text" class="form-control">
			</div>
			<div class="flex justify-between">
				<button type="submit" class="flex flex-1 btn btn-primary">Register</button>
				<div class="p-1"></div>
				<a href="login.php" class="flex flex-1 btn btn-primary">Login</a>
			</div>
		</form>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>