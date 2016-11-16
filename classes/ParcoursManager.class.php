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
		$sql='SELECT par_num FROM parcours WHERE vil_num1 =":vil1" AND vil_num2 = ":vil2"';
		$req = $this->db->prepare($sql);
		$req->bindValue(':vil1', $vil1, PDO::PARAM_INT);
		$req->bindValue(':vil2', $vil2, PDO::PARAM_INT);
		$req->execute();
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return $resu->par_num;
		}else{
			return -1;
		}
	}

	public function getParNumByVil1($vil1, $vil2){
		$sql='SELECT par_num FROM parcours WHERE vil_num2 =":vil2" AND vil_num1 = ":vil1"';
		$req = $this->db->prepare($sql);
		$req->bindValue(':vil1', $vil1, PDO::PARAM_INT);
		$req->bindValue(':vil2', $vil2, PDO::PARAM_INT);
		$req->execute();
		$resu = $req->fetch(PDO::FETCH_OBJ);
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

	public function vilExisteDansV1($vi11){
		$sql='SELECT par_num FROM parcours WHERE vil_num1 ="'.$vil1.'"';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return 0;
		}else{
			return -1;
		}
	}

	public function vilExisteDansV2($vil2){
		$sql='SELECT par_num FROM parcours WHERE vil_num2 ="'.$vil2.'"';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return 0;
		}else{
			return -1;
		}
	}

	public function getVil1ByVil2($vil2){
		$listParcours = array();
		$sql='SELECT par_num, vil_num1 FROM parcours WHERE vil_num2= "'.$vil2.'"';
		$req= $this->db->query($sql);
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listParcours[] = new Parcours($parcours);
		}
		$req->closeCursor();
		return $listParcours;
	}

	public function getVil2ByVil1($vil1){
		$listParcours = array();
		$sql='SELECT par_num, vil_num2 FROM parcours WHERE vil_num1= "'.$vil1.'"';
		$req= $this->db->query($sql);
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listParcours[] = new Parcours($parcours);
		}
		$req->closeCursor();
		return $listParcours;
	}

	public function getVillDep()
	{
		$listParcours = array();
		$sql='SELECT DISTINCT vil_num1 FROM parcours pa INNER JOIN propose p ON pa.par_num=pa.par_num WHERE pro_sens=1 UNION SELECT DISTINCT vil_num2 FROM parcours pa INNER JOIN propose p ON pa.par_num=pa.par_num WHERE pro_sens=0';
		$req= $this->db->query($sql);
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listParcours[] = new Parcours($parcours);
		}
		$req->closeCursor();
		return $listParcours;
	}


	public function getVill2Arriv($vil1Dep)
	{
		$listParcours = array();
		$sql='SELECT DISTINCT vil_num2 FROM parcours pa INNER JOIN propose p ON p.par_num=pa.par_num WHERE pro_sens=1 AND vil_num1="'.$vil1Dep.'"';
		$req= $this->db->query($sql);
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listParcours[] = new Parcours($parcours);
		}
		$req->closeCursor();
		return $listParcours;
	}

	public function getVill1Arriv($vil2Dep)
	{
		$listParcours = array();
		$sql='SELECT DISTINCT vil_num1 FROM parcours pa INNER JOIN propose p ON pa.par_num=p.par_num WHERE pro_sens=0 AND vil_num2="'.$vil2Dep.'"';
		$req= $this->db->query($sql);
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listParcours[] = new Parcours($parcours);
		}
		$req->closeCursor();
		return $listParcours;
	}

	public function estvill1Dep($vil1Dep,$vil2Arriv){
		$sql='SELECT vil_num1 FROM parcours pa INNER JOIN propose p ON p.par_num=pa.par_num WHERE pro_sens = 0 AND vil_num1 =:vilDep AND vil_num2=:vilArriv';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return true;
		}
		else {
			{
				return false;
			}
		}
		}
		public function estvill2Dep($vil2Dep){
			$sql='SELECT vil_num2 FROM parcours pa INNER JOIN propose p ON p.par_num=pa.par_num WHERE pro_sens = 1 AND vil_num2 = "'.$vil2Dep.'" ';
			$req = $this->db->query($sql);
			$resu = $req->fetch(PDO::FETCH_OBJ);
			if($resu != NULL){
				return true;
			}
			else {
				{
					return false;
				}
			}
		}

		public function getAllTrajetVil1Dep($vilDep,$vilArriv)
		{

		}

		public function getAllTrajetVil2Dep($vilDep,$vilArriv)
		{

		}
}
