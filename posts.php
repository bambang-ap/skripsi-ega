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
$data_post = $db->ExecuteAll('SELECT * FROM eventData WHERE idOwner=? ORDER BY created DESC', [$user['id']]);
$data_edit = $db->Execute('SELECT * FROM eventData WHERE id=? AND idOwner=?', [$_GET['edit'], $user['id']]);
$isEditData = $data_edit;

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
	<?php require('components/header.php'); ?>
	<div class="app">
		<form class="flex flex-col items-end form-post" method="POST" enctype="multipart/form-data" action="<?php echo $isEditData ? 'manage/edit-delete-post.php' : 'manage/add-post.php' ?>">
			<div class="w-full">
				<h2 class="pb-5">POST YOUR EVENT</h2>
				<input name="id" value="<?php echo $data_edit['id']; ?>" class="none">
				<?php
				if ($_SESSION['uploadMessage'] && $_SESSION['uploadMessage'] !== '') { ?>
					<div class="alert alert-<?php echo $_SESSION['uploadMessage'] === 'Success' ? 'success' : 'danger'; ?>" role="alert">
						<?php echo $_SESSION['uploadMessage']; ?>
					</div>
				<?php } ?>
				<div class="flex mb-2">
					<div class="w-1/3 mr-2 flex justify-center items-center img-wrapper">
						<input class="hidden" type="file" id="img-upload" accept="image/*" onchange="previewImage(this)" name="imgUpload" />
						<img id="image-preview" src="<?php echo $isEditData ?  'post-file/' . $data_edit['imagePath'] : 'assets/images/thumb.png' ?>">
						<div class="icon-wrapper" title="Image to become a thumbnail of your event">
							<label for="img-upload"><i class="fa fa-edit icon"></i></label>
						</div>
					</div>
					<div class="flex flex-col flex-1">
						<div class="flex">
							<div class="w-1/2 mr-1" title="Your event name">
								<label class="form-label">Event name</label>
								<input type="text" class="form-control" name="eventName" value="<?php echo $data_edit['eventName']; ?>" placeholder="e.g. Cuci Gudang iPhone" required />
							</div>
							<div class="w-1/2 ml-1" title="The date of your event">
								<label class="form-label">Event Date</label>
								<input type="datetime-local" class="form-control" name="eventTime" value="<?php echo formatDate($data_edit['eventTime']) ?>" required />
							</div>
						</div>
						<div class="flex">
							<div class="w-1/2 mr-1" title="Youtube link to describe your event by video. This field is optional">
								<label class="form-label">Youtube link</label>
								<input type="text" class="form-control" name="youtubeLink" value="<?php echo $data_edit['youtubeLink']; ?>" placeholder="e.g. https://www.youtube.com/watch?v=-1Tkar1nLWQ" />
							</div>
							<div class="w-1/2 ml-1" title="Instagram link to describe your event by video. This field is optional">
								<label class="form-label">Instagram link</label>
								<input type="text" class="form-control" name="instagramLink" value="<?php echo $data_edit['instagramLink']; ?>" placeholder="e.g. https://www.instagram.com/p/CJ-5ChUheMm" />
							</div>
						</div>
						<div class="flex">
							<div class="w-1/2 mr-1" title="Twitter link to describe your event by video. This field is optional">
								<label class="form-label">Twitter link</label>
								<input type="text" class="form-control" name="twitterLink" value="<?php echo $data_edit['twitterLink']; ?>" placeholder="e.g. https://www.youtube.com/watch?v=-1Tkar1nLWQ" />
							</div>
							<div class="w-1/2 ml-1" title="Facebook link to describe your event by video. This field is optional">
								<label class="form-label">Facebook link</label>
								<input type="text" class="form-control" name="facebookLink" value="<?php echo $data_edit['facebookLink']; ?>" placeholder="e.g. https://www.instagram.com/p/CJ-5ChUheMm" />
							</div>
						</div>
						<label class="form-label" title="Full description of your event">Event description</label>
						<textarea class="h-full form-control" name="eventDescription" title="Full description of your event" placeholder="Type here..." required><?php echo $data_edit['eventDescription']; ?></textarea>
					</div>
				</div>
			</div>
			<div class="flex">
				<?php if ($isEditData) { ?>
					<a href="posts.php" class="btn btn-link" type="submit">CANCEL</a>
				<?php } ?>
				<button class="btn btn-primary" type="submit"><?php echo $isEditData ? 'EDIT' : 'POST'; ?></button>
			</div>
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