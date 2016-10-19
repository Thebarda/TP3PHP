<h1>Liste des parcours </h1>
<?php
  $file = fopen("./log/covoiturage.log","a");
  fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a affiché la liste des parcours</span><br>\n");
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
    $vil1 = $manager2->getNomByNum($Parcours->getVil_num1());
    $vil2 = $manager2->getNomByNum($Parcours->getVil_num2());
    echo "<td>".$Parcours->getPar_num()."</td>";
    echo "<td>".$vil1."</td>";
    echo "<td>".$vil2."</td>";
    echo "<td>".$Parcours->getPar_km()."</td>";
     ?></tr><?php
  }
  echo "</table>\n";
?>
