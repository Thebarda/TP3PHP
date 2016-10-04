<?php
class Salarie{

	private $per_num;
	private $sal_telprof;
	private $fon_num;

	public function __construct($valeurs = array()){
		$this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch($key){
				case 'per_num' : $this->setPer_num($value);
					break;
				case 'sal_telprof' : $this->setSal_telprof($value);
					break;
				case 'fon_num' : $this->setFon_num($value);
					break;
			}
		}
	}

	public function setPer_num($val){
		$this->per_num = $val;
	}

	public function setSal_telprof($val){
		$this->sal_telprof = $val;
	}

	public function setFon_num($val){
		$this->fon_num = $val;
	}


	public function getPer_num(){
		return $this->per_num;
	}

	public function getSal_telprof(){
		return $this->sal_telprof;
	}

	public function getFon_num(){
		return $this->fon_num;
	}

}
?>
