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

	public function add($parcours){
		$sql='INSERT INTO parcours(par_km, vil_num1, vil_num2) VALUES (:par_km, :vil_num1, :vil_num2)';
		$req = $this->db->prepare($sql);
		$req->bindValue(':par_km', $parcours->getPar_km(), PDO::PARAM_INT);
		$req->bindValue(':vil_num1', $parcours->getVil_num1(), PDO::PARAM_INT);
		$req->bindValue(':vil_num2', $parcours->getVil_num2(), PDO::PARAM_INT);
		$req->execute();
	}

	public function getParNumByVil0($vil1, $vil2){
		$sql='SELECT par_num FROM parcours WHERE vil_num1 ="'.$vil1.'" AND vil_num2 = "'.$vil2.'"';
		$req = $this->db->query($sql);
		$res = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return $resu->par_num;
		}else{
			return -1;
		}
	}

	public function getParNumByVil1($vil1, $vil2){
		$sql='SELECT par_num FROM parcours WHERE vil_num2 ="'.$vil1.'" AND vil_num1 = "'.$vil2.'"';
		$req = $this->db->query($sql);
		$res = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return $resu->par_num;
		}else{
			return -1;
		}
	}

	public function getVil1(){
		$listParcours = array();
		$sql='SELECT par_num, vil_num1 FROM parcours';
		$req= $this->db->query($sql);
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listParcours[] = new Parcours($parcours);
		}
		$req->closeCursor();
		return $listParcours;
	}

	public function getVil2(){
		$listParcours = array();
		$sql='SELECT par_num, vil_num2 FROM parcours';
		$req= $this->db->query($sql);
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listParcours[] = new Parcours($parcours);
		}
		$req->closeCursor();
		return $listParcours;
	}

}
