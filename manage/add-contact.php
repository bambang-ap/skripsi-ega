<?
include '../config/connect.php';

session_start();
$user = $_SESSION['user'];

if (!$user) {
	header('location: 404.php');
} else {
	$name = $_POST['name'];
	$phoneNumber = $_POST['phoneNumber'];
	$companyName = $_POST['companyName'];

	$db->Execute('INSERT INTO contact (idOwner, name, phoneNumber, companyName) VALUES (?,?,?,?)', [$user['id'], $name, $phoneNumber,	$companyName]);
	header('location: ../contact.php');

}