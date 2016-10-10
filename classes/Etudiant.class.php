<?php
class Etudiant{
	private $per_num;
	private $dep_num;
	private $div_num;

	public function __construct($valeurs = array()){
		$this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch($key){
				case 'per_num':$this->setPer_num($value);
					break;
				case 'dep_num':$this->setDep_num($value);
					break;
				case 'div_num':$this->setDiv_num($value);
					break;
			}
		}
	}

	public function setPer_num($val){
		$this->per_num = $val;
	}

	public function setDep_num($val){
		$this->dep_num = $val;
	}

	public function setDiv_num($val){
		$this->div_num = $val;
	}

	public function getPer_num(){
		return $this->per_num;
	}

	public function getDep_num(){
		return $this->dep_num;
	}

	public function getDiv_num(){
		return $this->div_num;
	}
}
?>
