<?php
class ProposeManager{
	protected $db;
	public function __construct($db){
		$this->db = $db;
	}

	public function add($propose){
		$sql ='INSERT INTO propose(par_num, per_num, pro_date, pro_time, pro_place, pro_sens) VALUES (:par_num, :per_num, :pro_date, :pro_time, :pro_sens)';
		$req = $this->db->prepare($sql);
		$req->bindValue(':par_num', $propose->getPar_num(), PDO::PARAM_INT);
		$req->bindValue(':per_num', $propose->getPer_num(), PDO::PARAM_INT);
		$req->bindValue(':pro_date', $propose->getPro_date(), PDO::PARAM_STR);
		$req->bindValue(':pro_time', $propose->getPro_time(), PDO::PARAM_STR);
		$req->bindValue(':pro_sens', $propose->getPro_sens(), PDO::PARAM_INT);
		$req->execute();
	}

}

?>
