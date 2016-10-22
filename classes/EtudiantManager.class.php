<?php
class EtudiantManager{
	protected $db;
	public function __construct($db){
		$this->db = $db;
	}

	public function add($etudiant)
	{
		$requete=$this->db->prepare('INSERT INTO etudiant(per_num, dep_num, div_num) VALUES (:per_num, :dep_num, :div_num);');
    $requete->bindValue(':per_num',$etudiant->getPer_num(), PDO::PARAM_STR);
    $requete->bindValue(':dep_num',$etudiant->getDep_num(), PDO::PARAM_STR);
		$requete->bindValue(':div_num',$etudiant->getDiv_num(), PDO::PARAM_STR);
    $retour=$requete->execute();
	}

	public function supprEtudiant($per_num)
	{
			$requete=$this->db->prepare('DELETE FROM etudiant WHERE per_num=:per_num');
			$requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
			$retour=$requete->execute();
	}

	public function getEtudiantByNum($num){
		$sql="SELECT per_prenom, per_nom, per_mail, per_tel, dep_nom, vil_nom FROM personne p INNER JOIN etudiant e ON e.per_num = p.per_num INNER JOIN departement d ON d.dep_num = e.dep_num INNER JOIN ville v ON v.vil_num = d.vil_num where p.per_num = ".$num;
		$req=$this->db->query($sql);
    $resu=$req->fetch(PDO::FETCH_OBJ);
    $req->closeCursor();
		return $resu;
	}
}
?>
