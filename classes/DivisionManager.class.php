<?php
class DivisionManager{
	protected $db;
	public function __construct($db){
		$this->db = $db;
	}
	public function getAll(){
		$listDivision = array();
		$sql='SELECT div_num, div_nom FROM division';
		$req= $this->db->query($sql);
		while($division = $req->fetch(PDO::FETCH_OBJ)){
			$listDivision[] = new Division($division);
		}
		$req->closeCursor();
		return $listDivision;
	}
}
?>
