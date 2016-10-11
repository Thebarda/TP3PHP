<?php
class SalarieManager{
	protected $db;
	public function __construct($db){
		$this->db = $db;
	}

	public function add($salarie)
	{
		$requete=$this->db->prepare('INSERT INTO personne(per_num, sal_telprof, fon_num) VALUES (:per_num, :sal_telprof, :fon_num);');
    $requete->bindValue(':per_num',$salarie->getPer_num(), PDO::PARAM_INT);
    $requete->bindValue(':sal_telprof',$salarie->getSal_telprof(), PDO::PARAM_STR);
		$requete->bindValue(':fon_num',$salarie->getFon_num(), PDO::PARAM_INT);
    $retour=$requete->execute();
	}
}
?>
