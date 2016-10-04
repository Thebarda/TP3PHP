<h1>Liste des parcours </h1>
<?php
  $db = new Mypdo();
  $manager = new ParcoursManager($db);
  $manager2 = new VilleManager($db);

  $nbParcours = $manager->getNbParcours();
  $listParcours = $manager->getAll();
  echo "<p>Actuellement ".$nbParcours." parcours sont enregistrées</p>\n";
  echo "<table>\n";
  echo "<tr><th>Numéro</th><th>Nom ville</th><th>Nom ville</th><th>Nombre de Km</th></tr>\n";
  foreach($listParcours as $Parcours){
    ?><tr><?php
    echo "<td>".$Parcours->getPar_num()."</td>";
    echo "<td>".$Parcours->getVil_nom()."</td>";
    echo "<td>".$Parcours->getVil_nom()."</td>";
    echo "<td>".$Parcours->getPar_km()."</td>";
     ?></tr><?php
  }
  echo "</table>\n";
?>
