<?php
  if((empty($_POST["telephone2"]))&&(empty($_POST["fonction"]))){
    $db = new Mypdo();
    $fonctionManager = new FonctionManager($db);
    $listFonctions = $fonctionManager->getAll();
    ?>
    <h1>Ajouter un salarié</h1>
    <form method="post" action="#">
      Téléphone professionnel : <input type="text" name="telephone2">
      Fonction : <select name="fonction">
        <?php
        foreach ($listFonctions as $value) {
          echo "<option value='".$value->getFon_num()."'>".$value->getFon_libelle()."</option>";
        }
        ?>
      </select>
      <input type="submit" value="Valider">
    </form>
    <?php
  }else{
    if(strlen($_POST["telephone2"])!=10){
      echo "Numéro de téléphone incorrecte";
      echo "<script>redirectionSalarie();</script>";
    }else{
      $db = new Mypdo();
      $personneManager = new PersonneManager($db);
      $perNum = $personneManager->getNumByNom($_SESSION["nom"]);
      $salarie = new Salarie(array(
        "per_num" => $perNum,
        "sal_telprof" => $_POST["telephone2"],
        "fon_num" => $_POST["fonction"]
      ));
      $salarieManager = new SalarieManager($db);
      $salarieManager->add($salarie);
      echo "la personne ".$perNum." a été ajoutée ";
    }
  }
?>
