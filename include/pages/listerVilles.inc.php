<h1>Liste des villes </h1>
<?php
  $db = new MyPdo();
  $managerVille = new VilleManager($db);
  $nbVilles = $managerVille->getNbVille();
  $listVilles = $managerVille->getAll();
  echo "<p>Actuellement ".$nbVilles." villes sont enregistrées</p>\n";
  echo "<table>\n";
  echo "<tr><th>Numéro</th><th>Nom</th></tr>\n";
  foreach($listVilles as $ville){
    ?><tr><?php
    echo "<td>".$ville->getVil_num()."</td>";
    echo "<td>".$ville->getVil_nom()."</td>";
     ?></tr><?php
  }
  echo "</table>\n";
?>
