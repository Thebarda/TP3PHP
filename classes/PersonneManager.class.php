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
		$sql='SELECT per_num FROM personne WHERE per_num = "'.$perNom.'"';
		$req = $this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return $resu->nbVille;
		}
	}
}
?>
