<?php
session_start();

include '../config/connect.php';

$user = $_SESSION['user'];

if (!$user) {
	header('location: 404.php');
} else {
	$data = $_POST['data'];
	foreach ($data as  $contact) {
		$id = $contact['id'];
		$idOwner = $contact['idOwner'];
		$name = $contact['name'];
		$phoneNumber = $contact['phoneNumber'];
		$companyName = $contact['companyName'];
		$deleted = $contact['deleted'];
		if ($deleted === 'on') {
			$db->Execute('DELETE FROM contact WHERE id=? AND idOwner=?', [$id, $idOwner]);
		} else {
			$db->Execute('UPDATE contact SET contact.name=?, phoneNumber=?, companyName=? WHERE id=? AND idOwner=?', [$name, $phoneNumber, $companyName, $id, $idOwner]);
		}
	}
	header('location: ../contact.php');
}
