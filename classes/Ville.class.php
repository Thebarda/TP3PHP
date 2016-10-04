<?php
class Ville{
	private $vil_num;
	private $vil_nom;

	public function __construct($valeurs = array()){
		$this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch($key){
				case 'vil_nom' : $this->setVil_nom($value);
					break;
				case 'vil_num' : $this->setVil_num($value);
					break;
			}
		}
	}

	public function setVil_nom($val){
		$this->vil_nom = $val;
	}

	public function setVil_num($val){
		$this->vil_num = $val;
	}

	public function getVil_nom(){
		return $this->vil_nom;
	}

	public function getVil_num(){
		return $this->vil_num;
	}
}
?>
