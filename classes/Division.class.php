<?php
class Division{
	private $div_num;
	private $div_nom;

	public function __construct($valeurs = array()){
		$this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch ($key) {
				case 'div_num': $this->setDiv_num($value);
					break;
				case 'div_nom' : $this->setDiv_nom($value);
					break;
			}
		}
	}

	public function setDiv_num($val){
		$this->div_num = $val;
	}

	public function setDiv_nom($val){
		$this->div_nom = $val;
	}

	public function getDiv_num(){
		return $this->div_num;
	}

	public function getDiv_nom(){
		return $this->div_nom;
	}
}
