<?php
if((empty($_POST["annee"]))&&(empty($_POST["dep"]))){
  $_SESSION["nom"] = $_POST["nom"];
  $personne = new Personne(array(
    "per_nom" => $_POST["nom"],
    "per_prenom" => $_POST["prenom"],
    "per_tel" => $_POST["telephone1"],
    "per_mail" => $_POST["mail"],
    "per_login" => $_POST["login"],
    "per_pwd" => md5("48@!alsd".$_POST["mdp"])
  ));
  $db = new Mypdo();
  $personneManager = new PersonneManager($db);
  $personneManager->add($personne);
    $divisionManager = new DivisionManager($db);
    $listDivision = $divisionManager->getAll();
    $departementManager = new DepartementManager($db);
    $listDepartement = $departementManager->getAll();
?>
<h1>Ajouter un étudiant</h1>
<form method="post" action="#">
Année : <select name="annee">
<?php
foreach ($listDivision as $value) {
  echo "<option value=".$value->getDiv_num().">".$value->getDiv_nom()."</option>";
}
?>
</select>
Département : <select name="dep">
<?php
foreach ($listDepartement as $value) {
  echo "<option value=".$value->getDep_num().">".$value->getDep_nom()."</option>";
}
?>
</select>
<input type="submit" name="name" value="Valider">
</form>
<?php
}else{
  $db = new Mypdo();
  $personneManager = new PersonneManager($db);
  $perNum = $personneManager->getNumByNom($_SESSION["nom"]);
  echo $perNum;
  $etudiant = new Etudiant(array(
    "per_num" => $perNum,
    "dep_num" => $_POST["dep"],
    "div_num" => $_POST["annee"]
  ));
  $etudiantManager = new EtudiantManager($db);
  $etudiantManager->add($etudiant);
  unset($_SESSION["nom"]);
}
?>
