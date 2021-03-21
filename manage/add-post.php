<pre>
<?php
include '../config/connect.php';

session_start();
$user = $_SESSION['user'];

if (!$user) {
	header('location: 404.php');
} else {
	$uploadOk = 1;
	$file = $_FILES["imgUpload"];
	$target_dir = "../post-file/";
	$target_file = $target_dir . basename($file["name"]);
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	$target_file = $target_dir . basename(uuid() . '.' . $imageFileType);
	$filename = str_replace($target_dir, '', $target_file);
	$fileSize = $file["size"];
	$maxSize = 500000;
	if (isset($_POST["submit"])) {
		$check = getimagesize($file["tmp_name"]);
		if ($check !== false) {
			$_SESSION['uploadMessage'] = "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			$_SESSION['uploadMessage'] = "File is not an image.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		$_SESSION['uploadMessage'] = "Sorry, file already exists.";
		$uploadOk = 0;
	}
	if ($fileSize > $maxSize) {
		$inMb = number_format($maxSize / 1000000, 2, ".", "");
		$fileSize = number_format($fileSize / 1000000, 2, ".", "");
		$_SESSION['uploadMessage'] = "Sorry, your file is $fileSize MB. Max size is $inMb MB";
		$uploadOk = 0;
	}
	if (
		$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif"
	) {
		$_SESSION['uploadMessage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	$uploadImage = $uploadOk === 1 ? move_uploaded_file($file["tmp_name"], $target_file) : false;
	if ($uploadOk === 1 && $uploadImage) {
		$eventName = $_POST['eventName'];
		$youtubeLink = $_POST['youtubeLink'];
		$instagramLink = $_POST['instagramLink'];
		$twitterLink = $_POST['twitterLink'];
		$facebookLink = $_POST['facebookLink'];
		$eventTime = $_POST['eventTime'];
		$eventDescription = $_POST['eventDescription'];
		$url = $_POST['url'];
		$now = date("Y-m-d H:i:s");
		$db->Execute('INSERT INTO eventData (url, idOwner, eventName, youtubeLink, instagramLink, facebookLink, twitterLink, eventTime, eventDescription, created, imagePath) VALUES (?,?,?,?,?,?,?,?,?,?,?)', [$url, $user['id'], $eventName, $youtubeLink, $instagramLink, $facebookLink, $twitterLink, $eventTime, $eventDescription, $now, $filename]);
		$_SESSION['uploadMessage'] = 'Post event success';
	}
	header('location: ../posts.php');
}
