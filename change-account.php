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
if (!$user) {
	header('location: 404.php');
}
if ($_POST['submit']) {
	extract($_POST);
	$idUser = $user['id'];
	if ($submit === 'info') {
		if ($user['password'] === $password) {
			$db->Execute('UPDATE user SET username=?, email=?, user.name=?, phoneNumber=? WHERE id=?', [$username, $email, $name, $phoneNumber, $idUser]);
			$err = $db->error();
			if ($err[2]) $errMsg = $err[2];
			else {
				$_SESSION['user'] = $db->Execute('SELECT * FROM user WHERE user.password=? AND username=?', [$password, $username]);
				$user = $_SESSION['user'];
			}
		} else $errMsg = 'Wrong password';
	} else if ($submit === 'password') {
		if ($user['password'] === $oldPassword) {
			if ($newPassword === $confirmPassword) {
				$db->Execute('UPDATE user SET user.password=? WHERE id=?', [$newPassword, $idUser]);
				$err = $db->error();
				if ($err[2]) $errMsg2 = $err[2];
				else {
					$_SESSION['user']['password'] = $newPassword;
				}
			} else $errMsg2 = 'New password and Confirm password not match';
		} else $errMsg2 = 'Wrong password';
	}
}

?>

<body>
	<?php require('components/header.php'); ?>
	<div class="app">
		<form class="flex form-post flex-col mb-3" method="POST">
			<div>
				<?php if ($errMsg) { ?> <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div><?php } ?>
				<h2 class="pb-5 section-title">UPDATE ACCOUNT INFO</h2>
				<div class="flex mb-2 flex-wrap form-contact" style="margin: -5px;">
					<div class="w-1/2" style="padding: 5px;">
						<label class="form-label">Name</label>
						<input type="text" class="form-control" value="<?php echo $user['name']; ?>" name="name" title="Name or alias" placeholder="e.g. Makmur Sukimin">
					</div>
					<div class="w-1/2" style="padding: 5px;">
						<label class="form-label">Username</label>
						<input type="text" class="form-control" value="<?php echo $user['username']; ?>" name="username" title="This field is used for login" placeholder="e.g. theusername">
					</div>
					<div class="w-1/2" style="padding: 5px;">
						<label class="form-label">Email</label>
						<input type="email" class="form-control" value="<?php echo $user['email']; ?>" name="email" title="You can use this field as login username" placeholder="e.g. google@gmail.com">
					</div>
					<div class="w-1/2" style="padding: 5px;">
						<label class="form-label">Phone Number</label>
						<input type="number" class="form-control" value="<?php echo $user['phoneNumber']; ?>" name="phoneNumber" title="Use country code at begining" placeholder="e.g. 62857xxxxxxxx">
					</div>
					<div class="w-full" style="padding: 5px;">
						<label class="form-label">Current Password</label>
						<input type="password" class="form-control" name="password" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please provide password for changing data')" title="Provide password for changing data" placeholder="e.g. *******" required>
					</div>
				</div>
			</div>
			<button class="btn btn-primary submit-btn flex self-end" name="submit" value="info" type="submit">SAVE</button>
		</form>
		<form class="flex form-post flex-col mb-3" method="POST">
			<div>
				<?php if ($errMsg2) { ?> <div class="alert alert-danger" role="alert"><?php echo $errMsg2; ?></div><?php } ?>
				<h2 class="pb-5 section-title">CHANGE PASSWORD</h2>
				<div style="margin: -5px" class="flex mb-2 form-contact">
					<div class="w-1/3" style="padding: 5px">
						<label class="form-label">Old Password</label>
						<input type="password" class="form-control" name="oldPassword" title="Your existing password" placeholder="e.g. ******">
					</div>
					<div class="w-1/3" style="padding: 5px">
						<label class="form-label">New Password</label>
						<input type="password" class="form-control" name="newPassword" title="Your new password" placeholder="e.g. ******">
					</div>
					<div class="w-1/3" style="padding: 5px">
						<label class="form-label">Confirm Password</label>
						<input type="password" class="form-control" name="confirmPassword" title="Confirm your new password" placeholder="e.g. ******">
					</div>
				</div>
			</div>
			<button class="btn btn-primary submit-btn flex self-end" name="submit" value="password" type="submit">CHANGE</button>
		</form>
		<?php
		require('components/footer.php');
		?>
	</div>
</body>

</html>