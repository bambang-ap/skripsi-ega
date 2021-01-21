<?php
include "function.php";

$header = apache_request_headers();

if ($header['Host'] === 'localhost:8080') {
	$db = new CRUD("skripsi-ega");
} else {
	$db = new CRUD("u3699580_skripsi", "localhost", "u3699580_admin", "mXNrXQcUQTe1");
}
