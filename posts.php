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
$user = $_SESSION['user'];
if (!$user) {
	header('location: 404.php');
}
$data_post = $db->ExecuteAll('SELECT * FROM eventData WHERE idOwner=?', [$user['id']]);
?>

<body>
	<script>
		function previewImage($this) {
			// document.getElementById("image-preview").style.display = "block"
			var oFReader = new FileReader()
			oFReader.readAsDataURL($this.files[0])
			oFReader.onload = function(oFREvent) {
				document.getElementById("image-preview").src = oFREvent.target.result;
			}
		}
	</script>
	<?php require('components/header.php');?>
	<div class="app">
		<form class="flex flex-col items-end form-post" method="POST" enctype="multipart/form-data" action="manage/add-post.php">
			<div class="w-full">
				<h2 class="pb-5">POST YOUR EVENT</h2>
				<?php
				if ($_SESSION['uploadMessage'] && $_SESSION['uploadMessage'] !== '' ) { ?>
				<div class="alert alert-<?php echo $_SESSION['uploadMessage'] === 'Success' ? 'success' : 'danger'; ?>" role="alert">
					<?php echo $_SESSION['uploadMessage']; ?>
				</div>
				<?php } ?>
				<div class="flex mb-2">
					<div class="w-1/3 mr-2 img-wrapper">
						<input class="hidden" type="file" id="img-upload" accept="image/*" onchange="previewImage(this)" name="imgUpload" />
						<img id="image-preview" src="assets/images/img.png">
						<div class="icon-wrapper" title="Image to become a thumbnail of your event">
							<label for="img-upload"><i class="fa fa-edit icon"></i></label>
						</div>
					</div>
					<div class="flex flex-col flex-1">
						<div class="flex">
							<div class="w-1/3 mr-1" title="Your event name">
								<label class="form-label">Event name</label>
								<input type="text" class="form-control" name="eventName" placeholder="e.g. Cuci Gudang iPhone" />
							</div>
							<div class="w-1/3 ml-1" title="Youtube link to describe your event by video">
								<label class="form-label">Youtube link</label>
								<input type="text" class="form-control" name="youtubeLink" placeholder="e.g. https://www.youtube.com/watch?v=-1Tkar1nLWQ" />
							</div>
							<div class="w-1/3 ml-1" title="The date of your event">
								<label class="form-label">Event Date</label>
								<input type="datetime-local" class="form-control" name="eventTime" />
							</div>
						</div>
						<label class="form-label" title="Full description of your event">Event description</label>
						<textarea class="h-full form-control" title="Full description of your event" name="eventDescription" placeholder="Type here..."></textarea>
					</div>
				</div>
			</div>
			<button class="btn btn-primary" type="submit">POST</button>
		</form>
		<h2 class="text-center pb-5">YOUR EVENTS</h2>
		<?php
			require('components/post-content.php');
			require('components/footer.php');
			$_SESSION['uploadMessage'] = '';
		?>
	</div>
</body>

</html>