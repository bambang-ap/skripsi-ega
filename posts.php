<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<? require('components/imports.php'); ?>
	<title>Hello, world!</title>
</head>

<?
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
	<? require('components/header.php');?>
	<div class="app">
		<form class="flex flex-col items-end form-post" method="POST" enctype="multipart/form-data" action="manage/add-post.php">
			<div class="w-full">
				<h2 class="pb-5">POST YOUR EVENT</h2>
				<?
				if ($_SESSION['uploadMessage'] && $_SESSION['uploadMessage'] !== '' ) { ?>
				<div class="alert alert-<? echo $_SESSION['uploadMessage'] === 'Success' ? 'success' : 'danger'; ?>" role="alert">
					<? echo $_SESSION['uploadMessage']; ?>
				</div>
				<? } ?>
				<div class="flex mb-2">
					<div class="w-1/3 mr-2 img-wrapper">
						<input class="hidden" type="file" id="img-upload" accept="image/*" onchange="previewImage(this)" name="imgUpload" />
						<img id="image-preview" src="assets/images/img.png">
						<div class="icon-wrapper">
							<label for="img-upload"><i class="fa fa-edit icon"></i></label>
						</div>
					</div>
					<div class="flex flex-col flex-1">
						<div class="flex">
							<div class="w-1/3 mr-1">
								<label class="form-label">Event name</label>
								<input type="text" class="form-control" name="eventName" placeholder="Type here..." />
							</div>
							<div class="w-1/3 ml-1">
								<label class="form-label">Youtube link</label>
								<input type="text" class="form-control" name="youtubeLink" placeholder="Type here..." />
							</div>
							<div class="w-1/3 ml-1">
								<label class="form-label">Event Date</label>
								<input type="datetime-local" class="form-control" name="eventTime" placeholder="Type here..." />
							</div>
						</div>
						<label class="form-label">Event description</label>
						<textarea class="h-full form-control" name="eventDescription" placeholder="Type here..."></textarea>
					</div>
				</div>
			</div>
			<button class="btn btn-primary" type="submit">POST</button>
		</form>
		<h2 class="text-center pb-5">YOUR EVENTS</h2>
		<?
			require('components/post-content.php');
			require('components/footer.php');
			$_SESSION['uploadMessage'] = '';
		?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>