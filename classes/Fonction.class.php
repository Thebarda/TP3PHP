<?php
class Fonction{
	private $fon_num;
	private $fon_libelle;

	public function __construct($valeurs = array()){
		$this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch($key){
				case 'fon_num':$this->setFon_num($value);
					break;
				case 'fon_libelle':$this->setFon_libelle($value);
					break;
			}
		}
	}

	public function setFon_num($val){
		$this->fon_num=$val;
	}

	public function setFon_libelle($val){
		$this->fon_libelle=$val;
	}

	public function getFon_num(){
		return $this->fon_num;
	}

	public function getFon_libelle(){
		return $this->fon_libelle;
	}
}
?>
