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
				<div class="account-btn flex flex-col justify-center">
					<a class="flex items-center btn btn-link icon"><i class="fa fa-user"></i></a>
					<div class="relative">
						<div class="absolute account-menu">
							<a class="btn" href="change-account.php"><i class="fa fa-user-edit"></i> Change Account Info</a>
							<a class="btn" href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(() => {
						$('.account-btn')
							.mouseenter(() => $('.account-menu').addClass('show-menu'))
							.mouseleave(() => $('.account-menu').removeClass('show-menu'))
					})
				</script>
			</div>
		<?php } else { ?>
			<a class="flex items-center btn btn-link self-center" href="login.php">LOGIN</a>
		<?php } ?>
	</div>
</div>