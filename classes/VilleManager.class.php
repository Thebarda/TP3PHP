<?php
class VilleManager{
	protected $db;
	public function __construct($db){
		$this->db = $db;
	}

	public function getAll(){
		$listVilles = array();
		$sql='SELECT vil_num, vil_nom FROM ville';
		$req= $this->db->query($sql);
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$listVilles[] = new Ville($ville);
		}
		$req->closeCursor();
		return $listVilles;
	}

	public function getNbVille(){
		$sql='SELECT COUNT(vil_num) AS nbVille, FROM ville';
		$req=$this->db->query($sql);
		$resu = $req->fetch(PDO::FETCH_OBJ);
		if($resu != NULL){
			return $resu->nbVille;
		}
	}

	public function add($ville)
	{
		$requete=$this->db->prepare('INSERT into ville(vil_num,vil_nom) Values (:vil_num,:vil_nom);');
    $requete->bindValue(':vil_num',$ville->getvil_num());
    $requete->bindValue(':vil_nom',$ville->getvil_nom());
    $retour=$requete->execute();

	}
}
?>
