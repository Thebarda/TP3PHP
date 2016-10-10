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
}
?>
