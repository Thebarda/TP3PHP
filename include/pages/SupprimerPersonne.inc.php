<?php
if(!empty($_SESSION["statusPersConnected"])){
 ?>
<h1>Supprimer des personnes enregistrées</h1>
<?php
  $db = new Mypdo();
  $manager = new PersonneManager($db);
  $managerSalarie=new SalarieManager($db);
  $managerEtudiant=new EtudiantManager($db);

	if (!isset($_GET["num"]))
	{
		$nbPersonne=$manager->getNbPersonnes();
		$listPersonnes = $manager->getAll();
		echo "<p>Actuellement ".$nbPersonne." personnes sont enregistrées</p>\n";
		echo "<table>\n";
		echo "<tr><th>Numéro</th><th>Nom </th><th>Prenom</th></tr>\n";
		foreach($listPersonnes as $Personnes){
			?><tr class="borderTr"><?php
			echo "<td class='borderTd'>".$Personnes->getPer_num()."</td>";
			echo "<td class='borderTd'>".$Personnes->getPer_nom()."</td>";
			echo "<td class='borderTd'>".$Personnes->getPer_prenom()."</td>";
			?>
		<td class='borderTd'>
			<form method="GET" action="#">
			<a href="index.php?page=4&num=<?php echo $Personnes->getPer_num(); ?> ">
				<img src="./image/erreur.png" alt="Bouton supprimer" title="Bouton supprimer"/>
			</a>
		</form>
		</td><?php
		}
		echo "</table>\n";

	}

	else
	{
		$num=$_GET["num"];
		/*
		$manager->supprPersonnes($num);
    $nom=$manager->getNomByNum($num)
		echo "la personne ".$nom." a été supprimé";*/

		if ($manager->estSalarie($num))
		{
      $nom=$manager->getNomByNum($num);
      $managerSalarie->supprSalarie($num);
      $manager->supprPersonnes($num);
      $file = fopen("./log/covoiturage.log","a");
      fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a supprimé l'étudiant n°".$num."</span><br>\n");
  		echo " ".$num." ".$nom." a été supprimé";

		}
		else
		{
      $nom=$manager->getNomByNum($num);
      $managerEtudiant->supprEtudiant($num);
      $manager->supprPersonnes($num);
      $file = fopen("./log/covoiturage.log","a");
      fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a supprimé le salarié n°".$num."</span><br>\n");
  		echo " ".$num." ".$nom." a été supprimé";
		}
    echo "<br><span id='chrono'>Redirection dans 2 secondes</span>";
    echo "<script>appel();
    redirectionAccueil();</script>";
	}
}else{
  echo "Vous n'avez pas accès à cette page";
}
		 ?>
