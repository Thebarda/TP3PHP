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

	public function getAll(){
		$listVersonnes = array();
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

	public function estSalarie($per_num)
	{
			$requete=$this->db->prepare('SELECT per_num FROM salarie WHERE per_num=:per_num');
			$requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
			$retour=$requete->execute();
			if($retour = NULL){
				return false;
			}
			else {
				return true;
			}

	}



}
?>
