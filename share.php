<?php
session_start();
require('config/connect.php');

$link = base64_decode($_GET['link']);
$from = $_GET['from'];
$id = $_GET['id'];
$ref = $_GET['ref'];
$ref = str_replace('{sharer}', $link, $ref);

$data = $db->Execute('SELECT * FROM sharer WHERE id=?', [$from]);
$eventData = $db->Execute('SELECT * FROM eventData WHERE id=?', [$id]);

if ($eventData) {
	$ids = [];
	if ($data) {
		$ids = preg_replace('/\(|\)/', '', $data['eventIds']);
		$ids = explode(',', $ids);
	}
	if (!in_array($id, $ids)) {
		array_push($ids, $id);
		$ids = '(' . join(',', $ids) . ')';
		if ($data) {
			echo $ids;
			$db->Execute('UPDATE sharer SET eventIds=? WHERE id=?', [$ids, $from]);
		} else {
			echo $ids . $ids;
			$db->Execute('INSERT INTO sharer (id, eventIds) VALUES (?,?)', [$from, $ids]);
		}
		$db->Execute('UPDATE eventData SET shared=? WHERE id=?', [intval($eventData['shared']) + 1, $id]);
	}
	header("location: $ref");
} else {
	echo "Not valid id";
}
