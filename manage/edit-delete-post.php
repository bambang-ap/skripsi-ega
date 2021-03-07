<pre>
<?php

session_start();

include '../config/connect.php';

$user = $_SESSION['user'];

if (!$user) {
	header('location: 404.php');
} else {
	$_POST['idOwner'] = $user['id'];
	$_GET['idOwner'] = $user['id'];
	if ($_POST['id']) { // Edit
		$id = $_POST['id'];
		$eventName = $_POST['eventName'];
		$eventTime = $_POST['eventTime'];
		$youtubeLink = $_POST['youtubeLink'];
		$instagramLink = $_POST['instagramLink'];
		$twitterLink = $_POST['twitterLink'];
		$facebookLink = $_POST['facebookLink'];
		$eventDescription = $_POST['eventDescription'];
		$url = $_POST["url"];
		$idOwner = $_POST['idOwner'];
		$file = $_FILES["imgUpload"];
		if ($file['size'] > 0) {
			$uploadOk = 1;
			$target_dir = "../post-file/";
			$target_file = $target_dir . basename($file["name"]);
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$target_file = $target_dir . basename(uuid() . '.' . $imageFileType);
			$filename = str_replace($target_dir, '', $target_file);
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
			if ($file["size"] > 500000) {
				$_SESSION['uploadMessage'] = "Sorry, your file is too large.";
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
				$db->Execute('UPDATE eventData SET url=?, imagePath=?, eventName=?, eventTime=?, youtubeLink=?, instagramLink=?, twitterLink=?, facebookLink=?, eventDescription=? WHERE id=? AND idOwner=?', [$url, $filename, $eventName, $eventTime, $youtubeLink, $instagramLink, $twitterLink, $facebookLink, $eventDescription, $id, $idOwner]);
				$err = $db->error();
				if ($err[2]) {
					echo "<script>alert(\"" . $err[2] . "\")</script>";
				} else {
					echo "<script>alert('Edit success')</script>";
				}
			}
		} else {
			$db->Execute('UPDATE eventData SET url=?, eventName=?, eventTime=?, youtubeLink=?, instagramLink=?, twitterLink=?, facebookLink=?, eventDescription=? WHERE id=? AND idOwner=?', [$url, $eventName, $eventTime, $youtubeLink, $instagramLink, $twitterLink, $facebookLink, $eventDescription, $id, $idOwner]);
			$err = $db->error();
			if ($err[2]) {
				echo "<script>alert(\"" . $err[2] . "\")</script>";
			} else {
				echo "<script>alert('Edit success')</script>";
			}
		}
	} else if ($_GET['id']) { // Delete
		$db->Execute('DELETE FROM eventData WHERE id=? AND idOwner=?', [$_GET['id'], $_GET['idOwner']]);
		$err = $db->error();
		if ($err[2]) {
			echo "<script>alert(\"" . $err[2] . "\")</script>";
		} else {
			echo "<script>alert('Delete success')</script>";
		}
	}
	// print_r($db->error());
	header('location: ../posts.php');
}




?>
</pre>