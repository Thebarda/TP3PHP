
<h1>Liste des personnes </h1>
<?php
//$file = fopen("./log/covoiturage.log","a");
//fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a affiché la liste des personnes</span><br>\n");
  $db = new Mypdo();
  $manager = new PersonneManager($db);

	if (empty($_GET["num"]))
  {
    $nbPersonne=$manager->getNbPersonnes();
    $listPersonnes = $manager->getAll();
    echo "<p>Actuellement ".$nbPersonne." personnes sont enregistrées</p>\n";
    echo "<table>\n";
    echo "<tr><th>Numéro</th><th>Nom </th><th>Prenom</th></tr>\n";
    foreach($listPersonnes as $Personnes){
      ?><tr><?php
      echo"<td>" ;
      echo"<a href='index.php?page=2&num=".$Personnes->getPer_num()."'>";
      echo $Personnes->getPer_num();
      echo"</a>";
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
      $db = new Mypdo();
      $managerSalarie=new SalarieManager($db);
      $test = $managerSalarie->getSalarieByNum($_GET["num"]);
      echo $test;
    }
    else
    {

    }

  }
?>
