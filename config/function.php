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