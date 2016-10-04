<?php
class ParcoursManager{
	protected $db;
	public function __construct($db){
		$this->db = $db;
	}

	public function getAll(){
		$listParcours = array();
		$sql='SELECT par_num, vil_num1,vil_num2,par_km FROM parcours';
		$req= $this->db->query($sql);
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listParcours[] = new Parcours($parcours);
		}
		$req->closeCursor();
		return $listParcours;
	}

	public function getNbParcours(){
		$sql='SELECT COUNT(par_num) AS nbParcours FROM parcours';
		$req=$this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return $resu->nbParcours;
		}
	}

}
