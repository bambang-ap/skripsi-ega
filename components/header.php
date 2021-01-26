<?php
$loggedIn = $_SESSION['user'];
?>
<div class="header">
	<div class="logo">
		<a href="home.php"><img src="assets/images/logo.png"></a>
	</div>
	<div class="flex menu">
		<a class="flex items-center btn btn-link self-center" href="home.php#popular">POPULAR</a>
		<?php if ($loggedIn) { ?>
			<div class="flex">
				<a class="flex items-center btn btn-link icon" href="posts.php"><i class="fa fa-images"></i></a>
				<a class="flex items-center btn btn-link icon" href="contact.php"><i class="fa fa-address-book"></i></a>
				<a class="flex items-center btn btn-link icon" href="logout.php"><i class="fa fa-sign-out-alt"></i></a>
			</div>
		<?php } else { ?>
			<a class="flex items-center btn btn-link self-center" href="login.php">LOGIN</a>
		<?php } ?>
	</div>
</div>