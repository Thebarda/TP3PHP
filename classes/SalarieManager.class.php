<?php
class SalarieManager{
  protected $db;
  public function __construct($db){
    $this->db = $db;
  }

  public function supprSalarie($per_num)
  {
      $requete=$this->db->prepare('DELETE FROM salarie WHERE per_num=:per_num');
      $requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
      $retour=$requete->execute();
  }
}
