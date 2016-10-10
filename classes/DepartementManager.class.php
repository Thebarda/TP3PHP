<?php
class DepartementManager{
	protected $db;
	public function __construct($db){
		$this->db = $db;
	}
	public function getAll(){
		$listDepartement = array();
		$sql='SELECT dep_num, dep_nom FROM departement';
		$req= $this->db->query($sql);
		while($departement = $req->fetch(PDO::FETCH_OBJ)){
			$listDepartement[] = new Departement($departement);
		}
		$req->closeCursor();
		return $listDepartement;
	}
}
?>
