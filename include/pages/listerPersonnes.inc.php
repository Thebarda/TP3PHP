
<h1>Liste des personnes </h1>
<?php
  $db = new Mypdo();
  $manager = new PersonneManager($db);

	if (!isset($_GET["num"]))
  {
    $nbPersonne=$manager->getNbPersonnes();
    $listPersonnes = $manager->getAll();
    echo "<p>Actuellement ".$nbPersonne." personnes sont enregistrées</p>\n";
    echo "<table>\n";
    echo "<tr><th>Numéro</th><th>Nom </th><th>Prenom</th></tr>\n";
    foreach($listPersonnes as $Personnes){
      ?><tr><?php
      echo"<td>" ;
      echo'<form method="GET" action="#">';
      echo"<a href='index.php?page=2&num=".echo $Personnes->getPer_num();."'>";
      echo$Personnes->getPer_num();
      echo"</a>";
      echo "</form>"
      echo"</td>";
      echo "<td>".$Personnes->getPer_nom()."</td>";
      echo "<td>".$Personnes->getPer_prenom()."</td>";
       ?></tr><?php
     }
  echo "</table>\n";
  }
  else {
  	$num=$_GET["num"];

    if ($manager->estSalarie($num))
    {
      $managerSalarie=new SalarieManager($db);
      
    }
    else
    {

    }

  }
?>
