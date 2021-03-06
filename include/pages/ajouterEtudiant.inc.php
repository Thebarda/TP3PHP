<?php
if(!empty($_SESSION["statusPersConnected"])){
  if((empty($_POST["annee"]))&&(empty($_POST["dep"]))){
    $db = new Mypdo();
    $divisionManager = new DivisionManager($db);
    $listDivision = $divisionManager->getAll();
    $departementManager = new DepartementManager($db);
    $listDepartement = $departementManager->getAll();
  ?>
  <h1>Ajouter un étudiant</h1>
  <form method="post" action="#">
  <label class="label">Année : </label><select name="annee" class="text">
  <?php
  foreach ($listDivision as $value) {
    echo "<option value=".$value->getDiv_num().">".$value->getDiv_nom()."</option>";
  }
  ?>
  </select><br><br>
  <label class="label">Département : </label<select name="dep" class="text">
  <?php
  foreach ($listDepartement as $value) {
    echo "<option value=".$value->getDep_num().">".$value->getDep_nom()."</option>";
  }
  ?>
  </select><br><br>
  <input type="submit" name="name" value="Valider" class="valider">
  </form>
  <?php
  }else{
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $personneManager->add($_SESSION["personne"]);
    $file = fopen("./log/covoiturage.log","a");
    fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a ajouté la personne ".$_SESSION["personne"]->getPer_nom()."</span><br>\n");
    $perNum = $personneManager->getNumByNom($_SESSION["nom"]);
    $etudiant = new Etudiant(array(
      "per_num" => $perNum,
      "dep_num" => $_POST["dep"],
      "div_num" => $_POST["annee"]
    ));
    $etudiantManager = new EtudiantManager($db);
    $etudiantManager->add($etudiant);
    $file = fopen("./log/covoiturage.log","a");
    fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a ajouté l'étudiant ".$_SESSION["personne"]->getPer_nom()."</span><br>\n");
    unset($_SESSION["personne"]);
    echo "vous avez ajouté l'étudiant ".$perNum.".<br>";
    echo "<br><span id='chrono'>Redirection dans 2 secondes</span>";
    echo "<script>appel();
    redirection();</script>";
  }
}else{
  echo "Vous n'avez pas accès à cette page";
}
?>
