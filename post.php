<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require('components/imports.php'); ?>
	<?php


	session_start();

	include 'config/connect.php';

	$data = $db->Execute('SELECT * FROM eventData WHERE id=?', [$_GET['id']]);
	if (!$data) {
		header('location: 404.php');
	}

	?>
	<!-- HTML Meta Tags -->
	<title>SOUNDSEE.NET - <?php echo $data['eventName']; ?></title>
	<meta name="description" content="<?php echo $data['eventDescription']; ?>">

	<!-- Google / Search Engine Tags -->
	<meta itemprop="name" content="SOUNDSEE.NET - <?php echo $data['eventName']; ?>">
	<meta itemprop="description" content="<?php echo $data['eventDescription']; ?>">
	<meta itemprop="image" content="<?php echo 'post-file/' . $data['imagePath']; ?>">

	<!-- Facebook Meta Tags -->
	<meta property="og:url" content="http://soundsee.net">
	<meta property="og:type" content="website">
	<meta property="og:title" content="SOUNDSEE.NET - <?php echo $data['eventName']; ?>">
	<meta property="og:description" content="<?php echo $data['eventDescription']; ?>">
	<meta property="og:image" content="<?php echo 'post-file/' . $data['imagePath']; ?>">

	<!-- Twitter Meta Tags -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="SOUNDSEE.NET - <?php echo $data['eventName']; ?>">
	<meta name="twitter:description" content="<?php echo $data['eventDescription']; ?>">
	<meta name="twitter:image" content="<?php echo 'post-file/' . $data['imagePath']; ?>">

	<!-- Meta Tags Generated via http://heymeta.com -->
</head>

<?php

if (!isset($_GET['id'])) {
	header('location: 404.php');
}

$user = $_SESSION['user'];

$identifier = gen_unique_share_identifier();
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<script>
	function closePopup(e) {
		if (e && e.target.id === 'popup-wrapper') {
			$('.popup').css('display', 'none')
		}
	}

	function openPopup($this) {
		if ($this) {
			$('.list-posts .show-bookmark').hide()
			$('.popup').css('display', 'none')
			$($this).find('.show-bookmark').css("display", "flex")
			var url = $($this).find('h4').text()
			share(window.ref.replace('{number}', url), true)
		} else {
			$('.popup').css('display', 'flex')
		}
	}

	function share($this, isWa) {
		var ref = typeof $this === 'string' ? $this : $this.getAttribute('data')
		if (ref.includes('{number}')) {
			var loggedIn = <?php echo $user ? 'true' : 'false'; ?>;
			if (loggedIn) {
				window.ref = ref
				openPopup()
			} else {
				alert('This feature is for logged user only')
			}
		} else {
			var link = isWa ? btoa(`Halo Sobat soundsee !!%0a%0aKita ada event menarik ni %0asayang untuk di lewatkan%0a%0auntuk informasi lebih detailnya%0aSilahkan klik : <? echo $actual_link; ?> ( soundsee official )%0adan jangan lupa untuk share ke teman-teman kalian.`) : '<? echo base64_encode($actual_link); ?>'
			window.open(`share.php?link=${link}&id=<?php echo $_GET['id']; ?>&from=<?php echo base64_encode($identifier); ?>&ref=${ref}`, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
		}
		return false
	}
</script>

<body>
	<div class="popup" id="popup-wrapper" onclick="closePopup(event)">
		<?php
		$data_contact = $db->ExecuteAll('SELECT * FROM contact WHERE idOwner=?', [$user['id']]);
		require('components/list-contact.php');
		?>
	</div>
	<?php
	require('components/header.php');
	$data = $db->Execute('SELECT * FROM eventData WHERE id=?', [$_GET['id']]);
	if (!$data) {
		header('location: 404.php');
	}
	?>
	<div class="app">
		<div class="list-posts post-detail flex-1 flex-col">
			<h2 class="text-center pb-5 section-title c-light"><?php echo $data['eventName']; ?></h2>
			<div class="flex mb-3 flex-1 detail-event">
				<div class="w-1/3 mr-5 flex justify-center items-start" style="max-height: 15rem;">
					<img style="border-radius: 5px; max-height: 15rem;" src="<?php echo 'post-file/' . $data['imagePath']; ?>" />
				</div>
				<div class="w-2/3 mt-3">
					<p class="c-light text-justify"><?php echo $data['eventDescription']; ?></p>
				</div>
			</div>
			<div class="card flex-row p-3 justify-between items-center">
				<div>
					<div>Posted : <i><?php echo $data['created']; ?></i></div>
					<div class="mt-1">Event Time : <i><?php echo $data['eventTime']; ?></i></div>
				</div>
				<div class="flex video">
					<?php if (!empty($data['youtubeLink'])) { ?>
						<a class="btn btn-danger flex items-center ml-1 mr-1" href="<?php echo $data['youtubeLink']; ?>" target="_blank">
							<i class="fa fa-youtube text-4xl"></i>
							<label class="text-xl ml-2">View</label>
						</a>
					<?php } ?>
					<?php if (!empty($data['instagramLink'])) { ?>
						<a class="btn btn-primary flex items-center ml-1 mr-1" href="<?php echo $data['instagramLink']; ?>" target="_blank">
							<i class="fa fa-instagram text-4xl"></i>
							<label class="text-xl ml-2">View</label>
						</a>
					<?php } ?>
					<?php if (!empty($data['twitterLink'])) { ?>
						<a class="btn btn-danger flex items-center ml-1 mr-1" href="<?php echo $data['twitterLink']; ?>" target="_blank">
							<i class="fa fa-twitter text-4xl"></i>
							<label class="text-xl ml-2">View</label>
						</a>
					<?php } ?>
					<?php if (!empty($data['facebookLink'])) { ?>
						<a class="btn btn-primary flex items-center ml-1 mr-1" href="<?php echo $data['facebookLink']; ?>" target="_blank">
							<i class="fa fa-facebook text-4xl"></i>
							<label class="text-xl ml-2">View</label>
						</a>
					<?php } ?>
				</div>
				<div class="flex items-center">
					<label class="text-xl">Share on</label>
					<a class="ml-3 btn btn-success" href="javascript:void(0)" data="https://wa.me/{number}?text={sharer}" onclick="share(this)" title="Share on Whatsapp"><i class="text-4xl fa fa-whatsapp"></i></a>
					<a class="ml-3 btn btn-info" href="javascript:void(0)" data="https://twitter.com/intent/tweet?text={sharer}" onclick="share(this)" title="Share on Twitter"><i class="text-4xl c-light fa fa-twitter"></i></a>
					<a class="ml-3 btn btn-primary" href="javascript:void(0)" data="https://www.facebook.com/sharer/sharer.php?u={sharer}" onclick="share(this)" title="Share on Facebook"><i class="text-4xl fa fa-facebook-square"></i></a>
				</div>
			</div>
		</div>
		<?php require('components/footer.php'); ?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>