<?php
class Departement{
	private $dep_num;
	private $dep_nom;
	private $vil_num;
	public function __construct($valeurs = array()){
		$this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch($key){
				case 'dep_num' : $this->setDep_num($value);
					break;
				case 'dep_nom' : $this->setDep_nom($value);
					break;
				case 'vil_num' : $this->setVil_num($value);
					break;
			}
		}
	}

	public function setDep_num($val){
		$this->dep_num = $val;
	}

	public function setDep_nom($val){
		$this->dep_nom = $val;
	}

	public function setVil_num($val){
		$this->vil_num = $val;
	}

	public function getDep_num(){
		return $this->dep_num;
	}

	public function getDep_nom(){
		return $this->dep_nom;
	}

	public function getVil_num(){
		return $this->vil_num;
	}
}
