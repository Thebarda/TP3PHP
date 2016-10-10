<?php
class Personne{

	private $per_num;
	private $per_nom;
	private $per_prenom;
	private $per_tel;
	private $per_mail;
	private $per_login;
	private $per_pwd;

	public function affecte($donnees){
		foreach ($donnees as $key => $value) {
			switch($key){
				case 'per_num' : $this->setPer_num($value);
					break;
				case 'per_nom' : $this->setPer_nom($value);
					break;
				case 'per_prenom' : $this->setPer_prenom($value);
					break;
				case 'per_tel' : $this->setPer_tel($value);
					break;
				case 'per_mail' : $this->setPer_mail($value);
					break;
				case 'per_login' : $this->setPer_login($value);
					break;
				case 'per_pwd' : $this->setPer_pwd($value);
					break;
			}
		}
	}

	public function setPer_num($val){
		$this->per_num = $val;
	}

	public function setPer_nom($val){
		$this->per_nom = $val;
	}

	public function setPer_prenom($val){
		$this->per_prenom = $val;
	}

	public function setPer_tel($val){
		$this->per_tel = $val;
	}

	public function setPer_mail($val){
		$this->per_mail = $val;
	}

	public function setPer_login($val){
		$this->per_login = $val;
	}

	public function setPer_pwd($val){
		$this->per_pwd = $val;
	}

///////////////////////////////////////////////////////
	public function getPer_num(){
		return $this->per_num;
	}

	public function getPer_nom(){
		return $this->per_nom;
	}

	public function getPer_prenom(){
		return $this->per_prenom;
	}

	public function getPer_tel(){
		return $this->per_tel;
	}

	public function getPer_mail(){
		return $this->per_mail;
	}

	public function getPer_login(){
		return $this->per_login;
	}

	public function getPer_pwd(){
		return $this->per_pwd;
	}
}
?>
