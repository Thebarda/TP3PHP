<?php
class FonctionManager{
	protected $db;
	public function __construct($db){
		$this->db = $db;
	}

	public function getAll(){
		$listFonctions = array();
		$sql='SELECT fonc_num, fonc_libelle FROM fonction';
		$req= $this->db->query($sql);
		while($fonction = $req->fetch(PDO::FETCH_OBJ)){
			$listFonctions[] = new Fonction($fonction);
		}
		$req->closeCursor();
		return $listFonctions;
	}
}
?>
