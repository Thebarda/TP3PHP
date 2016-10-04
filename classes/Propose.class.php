<?php
class Propose{

	private $par_num;
	private $per_num;
	private $pro_date;
	private $pro_time;
	private $pro_place;
	private $pro_sens;

	public function __construct($valeurs = array()){
		$this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch($key){
				case 'par_num' : $this->setPar_num($value);
					break;
				case 'per_num' : $this->setPer_num($value);
					break;
				case 'pro_date' : $this->setPro_date($value);
					break;
				case 'pro_time' : $this->setPro_time($value);
					break;
				case 'pro_place' : $this->setPro_place($value);
					break;
				case 'pro_sens' : $this->setPro_sens($value);
					break;
			}
		}
	}

	public function setPar_num($val){
		$this->par_num = $val;
	}

	public function setPer_num($val){
		$this->per_num = $val;
	}

	public function setPro_date($val){
		$this->Pro_date = $val;
	}

	public function setPro_time($val){
		$this->pro_time = $val;
	}

	public function setPro_place($val){
		$this->pro_place = $val;
	}

	public function setPro_sens($val){
		$this->pro_sens = $val;
	}


	public function getPar_num(){
		return $this->par_num;
	}

	public function getPer_num(){
		return $this->per_num;
	}

	public function getPro_date(){
		return $this->pro_date;
	}

	public function getPro_time(){
		return $this->Pro_time;
	}

	public function getPro_place(){
		return $this->Pro_place;
	}

	public function getPro_sens(){
		return $this->Pro_sens;
	}


}
?>
