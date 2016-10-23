<?php
if(!empty($_SESSION["statusPersConnected"])){
  if((empty($_POST["telephone2"]))&&(empty($_POST["fonction"]))){
    $db = new Mypdo();
    $fonctionManager = new FonctionManager($db);
    $listFonctions = $fonctionManager->getAll();
    ?>
    <h1>Ajouter un salarié</h1>
    <form method="post" action="#">
      <label class="label">Téléphone professionnel : </label><input type="text" name="telephone2" class="text"><br><br>
      <label class="label">Fonction : </label><select name="fonction" class="text">
        <?php
        foreach ($listFonctions as $value) {
          echo "<option value='".$value->getFon_num()."'>".$value->getFon_libelle()."</option>";
        }
        ?>
      </select><br><br>
      <input type="submit" value="Valider" class="valider">
    </form>
    <?php
  }else{
    if(strlen($_POST["telephone2"])!=10){
      echo "Numéro de téléphone incorrecte";
      echo "<script>redirectionSalarie();</script>";
    }else{
      $db = new Mypdo();

    $personneManager = new PersonneManager($db);
    $personneManager->add($_SESSION["personne"]);
    $file = fopen("./log/covoiturage.log","a");
    fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a ajouté la personne ".$_SESSION["personne"]->getPer_nom()."</span><br>\n");
      $perNum = $personneManager->getNumByNom($_SESSION["nom"]);
      $salarie = new Salarie(array(
        "per_num" => $perNum,
        "sal_telprof" => $_POST["telephone2"],
        "fon_num" => $_POST["fonction"]
      ));
      $salarieManager = new SalarieManager($db);
      $salarieManager->add($salarie);
      $file = fopen("./log/covoiturage.log","a");
      fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a ajouté le salarié ".$_SESSION["personne"]->getPer_nom()."</span><br>\n");
      echo "la personne ".$perNum." a été ajoutée ";
      unset($_SESSION["personne"]);
      echo "<br><span id='chrono'>Redirection dans 2 secondes</span>";
  		echo "<script>appel();
  		redirection();</script>";
    }
  }
}else{
  echo "Vous n'avez pas accès à cette page";
}
?>
