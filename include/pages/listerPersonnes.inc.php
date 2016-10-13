
<h1>Liste des personnes </h1>
<?php
  $db = new Mypdo();
  $manager = new PersonneManager($db);

  $nbPersonne=$manager->getNbPersonnes();
  $listPersonnes = $manager->getAll();
  echo "<p>Actuellement ".$nbPersonne." personnes sont enregistrées</p>\n";
  echo "<table>\n";
  echo "<tr><th>Numéro</th><th>Nom </th><th>Prenom</th></tr>\n";
  foreach($listPersonnes as $Personnes){
    ?><tr><?php
    echo "<td>".$Personnes->getPer_num()."</td>";
    echo "<td>".$Personnes->getPer_nom()."</td>";
    echo "<td>".$Personnes->getPer_prenom()."</td>";
     ?></tr><?php
  }
  echo "</table>\n";
?>
