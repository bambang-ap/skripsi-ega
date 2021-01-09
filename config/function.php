<?
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