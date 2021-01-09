<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require('components/imports.php'); ?>
	<title>Hello, world!</title>
</head>

<?php
include 'config/connect.php';
session_start();

$identifier = gen_unique_share_identifier();

if (!isset($_GET['id'])) {
	header('location: 404.php');
}

$data = $db->Execute('SELECT * FROM eventData WHERE id=?', [$_GET['id']]);

?>

<body>
	<?php require('components/header.php'); ?>
	<div class="app">
		<div class="list-posts flex-1 flex-col">
			<h2 class="text-center pb-5 c-light"><?php echo $data['eventName']; ?></h2>
			<div class="flex flex-1">
				<div class="w-1/3 mr-5 flex justify-center items-start" style="max-height: 15rem;">
					<img style="border-radius: 5px; max-height: 15rem;" src="<?php echo 'post-file/' . $data['imagePath']; ?>" />
				</div>
				<div class="w-2/3">
					<div class="flex mb-3  justify-between">
						<h4 class="c-light">Created : <i><?php echo $data['created']; ?></i></h4>
						<h4 class="c-light">Event Time : <i><?php echo $data['eventTime']; ?></i></h4>
					</div>
					<p class="c-light text-justify"><?php echo $data['eventDescription']; ?></p>
				</div>
			</div>
			<div class="flex">
				<a class="btn btn-link flex flex-1 c-light-hover items-center justify-center" href="<?php echo $data['youtubeLink']; ?>" target="_blank">
					<h4>Youtube video</h4>
				</a>
				<a href="https://wa.me/6285717570370?text=https://google.com?id=jdfhsdjgh" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook">sdsds</a>
				<a href="https://twitter.com/intent/tweet?text=%20https://soundsee.net?dd=sdsd" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook">sdsds</a>
				<a href="https://www.facebook.com/sharer/sharer.php?&t=WOwowow&u=https://google.com?id=sdsd" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook">sdsds</a>
				<button class="flex flex-1 btn btn-primary justify-center items-center">SHARE</button>
			</div>
		</div>
		<?php require('components/footer.php'); ?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>