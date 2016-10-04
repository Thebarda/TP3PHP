<?php
class Parcours{
	private $par_num;
	private $par_km;
	private $vil_num1;
	private $vil_num2;

	public function __construct($valeurs = array()){
		$this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch($donnes){
				case 'par_num':$this->setPar_num($value);
					break;
				case 'par_km':$this->setPar_km($value);
					break;
				case 'vil_num1':$this->setVil_num1($value);
					break;
				case 'vil_num2':$this->setVil_num2($value);
					break;
			}
		}
	}

	public function setPar_num($val){
		$this->par_num = $val;
	}

	public function setPar_km($val){
		$this->par_km = $val;
	}

	public function setVil_num1($val){
		$this->vil_num1 = $val;
	}

	public function setVil_num2($val){
		$this->vil_num2 = $val;
	}

	public function getPar_num(){
		return $this->par_num;
	}

	public function getPar_km(){
		return $this->par_km;
	}

	public function getVil_num1(){
		return $this->vil_num1;
	}

	public function getVil_num2(){
		return $this->vil_num2;
	}
}
?>
