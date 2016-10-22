<?php
class SalarieManager{
  protected $db;
  public function __construct($db){
    $this->db = $db;
  }

  public function add($salarie)
	{
		$requete=$this->db->prepare('INSERT INTO salarie(per_num, sal_telprof, fon_num) VALUES (:per_num, :sal_telprof, :fon_num);');
    $requete->bindValue(':per_num',$salarie->getPer_num(), PDO::PARAM_STR);
    $requete->bindValue(':sal_telprof',$salarie->getSal_telprof(), PDO::PARAM_STR);
		$requete->bindValue(':fon_num',$salarie->getFon_num(), PDO::PARAM_STR);
    $retour=$requete->execute();
	}

  public function supprSalarie($per_num)
  {
      $requete=$this->db->prepare('DELETE FROM salarie WHERE per_num=:per_num');
      $requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
      $retour=$requete->execute();
  }

  public function getAllByNum($per_num)
  {
    $sql='SELECT per_num,sal_telprof,fon_num FROM salarie WHERE per_num = "'.$per_num.'"';
    $req=$this->db->query($sql);
    $resu = $req->fetch(PDO::FETCH_OBJ);
    if($resu != NULL){
      return $resu->salarie;
    }
  }
  public function getSalarieByNum($num){
    $sql='SELECT per_prenom, per_mail, per_tel, sal_telprof, fon_libelle FROM personne p INNER JOIN salarie s ON s.per_num = p.per_num INNER JOIN fonction f ON f.fon_num = s.fon_num where per_num = '.$num;
    $req=$this->db->query($sql);
    $resu=$req->fetch(PDO::FETCH_OBJ);
    if($resu != NULL){
      return $resu->personne;
    }
  }
}
