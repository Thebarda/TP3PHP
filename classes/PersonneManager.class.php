<?php
class PersonneManager{
	protected $db;
	public function __construct($db){
		$this->db = $db;
	}

	public function add($personne)
	{
		$requete=$this->db->prepare('INSERT INTO personne(per_nom, per_prenom, per_mail, per_tel, per_login, per_pwd) VALUES (:per_nom,:per_prenom, :per_mail, :per_tel, :per_login, :per_pwd);');
    $requete->bindValue(':per_nom',$personne->getPer_nom(), PDO::PARAM_STR);
    $requete->bindValue(':per_prenom',$personne->getPer_prenom(), PDO::PARAM_STR);
		$requete->bindValue(':per_mail',$personne->getPer_mail(), PDO::PARAM_STR);
		$requete->bindValue(':per_tel',$personne->getPer_tel(), PDO::PARAM_STR);
		$requete->bindValue(':per_login',$personne->getPer_login(), PDO::PARAM_STR);
		$requete->bindValue(':per_pwd',$personne->getPer_pwd(), PDO::PARAM_STR);
    $retour=$requete->execute();

	}

	public function getNumByNom($perNom){
		$sql='SELECT per_num FROM personne WHERE per_nom = "'.$perNom.'"';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return $resu->per_num;
		}
	}
	public function getNomByNum($perNum){
		$sql='SELECT per_nom FROM personne WHERE per_num = "'.$perNum.'"';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return $resu->per_nom;
		}
	}

	public function getNumByLogin($login){
		$sql='SELECT per_num FROM personne WHERE per_login = "'.$login.'"';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return $resu->per_num;
		}
	}

	public function getAll(){
		$listPersonnes = array();
		$sql='SELECT per_num, per_nom , per_prenom FROM personne';
		$req= $this->db->query($sql);
		while($personne = $req->fetch(PDO::FETCH_OBJ)){
			$listPersonnes[] = new Personne($personne);
		}
		$req->closeCursor();
		return $listPersonnes;
	}

	public function getNbPersonnes(){
		$sql='SELECT COUNT(per_num) AS nbPersonnes FROM personne';
		$req=$this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return $resu->nbPersonnes;
		}
	}

	public function supprPersonnes($per_num)
	{
			$requete=$this->db->prepare('DELETE FROM personne WHERE per_num=:per_num');
			$requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
			$retour=$requete->execute();
	}

		public function estSalarie($per_num){
			$sql='SELECT per_num FROM salarie WHERE per_num = "'.$per_num.'"';
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
	public function estEtudiant($per_num){
		$sql='SELECT per_num FROM salarie WHERE per_num="'.$per_num.'"';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		return $resu->per_num;
	}
	public function updatePersonne($personne){
		$requete = $this->db->prepare('UPDATE personne SET per_nom=:per_nom, per_prenom=:per_prenom, per_mail=:per_mail, per_tel=:per_tel, per_login=:per_login, per_pwd=:per_pwd WHERE per_num='.$personne->getPer_num());
		$requete->bindValue(':per_nom',$personne->getPer_nom(), PDO::PARAM_STR);
		$requete->bindValue(':per_prenom',$personne->getPer_prenom(), PDO::PARAM_STR);
		$requete->bindValue(':per_mail',$personne->getPer_mail(), PDO::PARAM_STR);
		$requete->bindValue(':per_tel',$personne->getPer_tel(), PDO::PARAM_STR);
		$requete->bindValue(':per_login',$personne->getPer_login(), PDO::PARAM_STR);
		$requete->bindValue(':per_pwd',$personne->getPer_pwd(), PDO::PARAM_STR);
		$retour=$requete->execute();
	}

	public function checkLogin($login){
		$sql = 'SELECT per_num FROM personne WHERE per_login="'.$login.'"';
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
	public function checkPassword($pwd){
		$sql = 'SELECT per_num FROM personne WHERE per_pwd="'.$pwd.'"';
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
}
?>
