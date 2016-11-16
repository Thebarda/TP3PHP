<h1>Rechercher un trajet</h1>
<?php
    $db = new Mypdo();
  $manager = new ParcoursManager($db);
  $managerVille=new VilleManager($db);
  $_SESSION["vilDep"];
  if(!isset($_POST["villeDep"]) && !isset($_POST["villeAriv"]))
  {

      $listVilleDep=$manager->getVillDep();
      ?>
      <h2>ville de depart : </h2>
        <form method="POST" action="#">
          <select name="villeDep" class="text">

          <?php
        foreach ($listVilleDep as $ville) {
          echo "<option value='".$ville->getVil_num1()."'>".$managerVille->getNomByNum($ville->getVil_num1())."</option>";
        }?>
        </select>
          <input type="submit" value="Valider" class="valider">
        </form>
        <?php

  }

  if(isset($_POST["villeDep"]) && !isset($_POST["villeAriv"]))
  {
    $villeDep=$_POST["villeDep"];
    $_SESSION["vilDep"]=$_POST["villeDep"];
    ?><form method="POST" action="#">
    <?php
    echo "Ville de depart : ".$managerVille->getNomByNum($villeDep)."<br></br>";
    echo "Date de depart :  ";
    ?> <input type="text" name="date" id="" class="calendrier" size="8" /><br></br> <?php
    echo "A partir de : ";
    ?><select name="heureDep" class="text"><?php
    for ($i=0;$i<24;$i++) {
      echo "<option value='".$i."'>".$i."h </option>";
  }
  echo "</select> <br> </br>";
  echo "Ville d'arrivée : ";

    $listVilleArriv2=$manager->getVill2Arriv($villeDep);
    $listVilleArriv1=$manager->getVill1Arriv($villeDep);


  ?>  <select name="villeArriv" class="text"><?php
  foreach ($listVilleArriv1 as $ville) {

        echo "<option value='".$ville->getVil_num1()."'>".$managerVille->getNomByNum($ville->getVil_num1())."</option>";

    }
  foreach ($listVilleArriv2 as $ville) {

          echo "<option value='".$ville->getVil_num2()."'>".$managerVille->getNomByNum($ville->getVil_num2())."</option>";

        }
  echo "</select> <br> </br>";

  echo "Précision : ";
  ?><select name="precision" class="text">
      <option value="0">Ce jour </option>
      <option value="1">+/- 1 jour </option>
      <option value="2">+/- 2 jours</option>
      <option value="3">+/- 3 jours </option>
  <?php
  echo "</select>";
  echo "</form>";
}
if(!isset($_POST["villeDep"]) && isset($_POST["villeAriv"]))
{
  echo "<tr>";
  echo "<td> ".$managerVille->getNomByNum($_SESSION["vilDep"])."";
  echo "<td> ".$managerVille->getNomByNum($_POST["villeArriv"])."";
  

}

   ?>
