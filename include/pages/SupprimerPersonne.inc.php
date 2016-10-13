
<h1>Supprimer des personnes enregistrées</h1>
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
			echo "<td>".$Personnes->getPer_num()."</td>";
			echo "<td>".$Personnes->getPer_nom()."</td>";
			echo "<td>".$Personnes->getPer_prenom()."</td>";
			?>
		<td>
			<form method="GET" action="#">
			<a href="index.php?page=4&num=<?php echo $Personnes->getPer_num(); ?> ">
				<img src="../../image/erreur.png" alt="Bouton supprimer" title="Bouton supprimer"/>
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
		echo "la personne ".$num." a été supprimé";*/

		if ($manager->estSalarie($num))
		{
			echo $num ;
			echo "est un salarie";
		}
		else
		{
			echo $num;
			echo "est un etudiant";
		}

	}


		 ?>
