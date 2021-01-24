<?php
class CRUD{
	public $q;
	public function __construct($selectDb, $host="localhost", $user="root", $password=""){
		$this->conn = new PDO(sprintf("mysql:host=%s;dbname=%s", $host,  $selectDb), $user, $password);
	}
	public function Execute($query, $params=array(), $output=1){
		try {
			$this->q = $this->conn->prepare($query);
			$this->q->execute($params);
			if ($output > 1){
				$out = $this->q->fetchAll(PDO::FETCH_ASSOC);
			}else{
				$out = $this->q->fetch(PDO::FETCH_ASSOC);
			}
		} catch (Exception $e) {
			$out = $this->q->errorInfo();
		}
		return $out;
	}
	public function ExecuteAll($query, $params=array(), $output=2){
		$out = $this->Execute($query, $params, $output);
		return $out;
	}
	public function error(){
		return $this->q->errorInfo();
	}
}
function uuid() {
	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
  	// 32 bits for "time_low"
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
  	// 16 bits for "time_mid"
		mt_rand( 0, 0xffff ),
  	// 16 bits for "time_hi_and_version",
  	// four most significant bits holds version number 4
		mt_rand( 0, 0x0fff ) | 0x4000,
  	// 16 bits, 8 bits for "clk_seq_hi_res",
  	// 8 bits for "clk_seq_low",
  	// two most significant bits holds zero and one for variant DCE1.1
		mt_rand( 0, 0x3fff ) | 0x8000,
  	// 48 bits for "node"
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	);
}
function get_client_ip() {
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
			$ipaddress = 'UNKNOWN';
	return $ipaddress;
}
function gen_unique_share_identifier() {
	return get_client_ip()." - ".$_SERVER['HTTP_USER_AGENT'];
}
function formatDate($date) {
	$date = explode(' ', $date);
	$time = explode(':', $date[1]);
	$date = explode('-', $date[0]);
	$dt = sprintf('%s-%s-%sT%s:%s', $date[0], $date[1], $date[2], $time[0], $time[1]);
	return $dt;
}