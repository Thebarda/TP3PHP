<?php
if(!empty($_SESSION["statusPersConnected"])){
  $file = fopen("./log/covoiturage.log","a");
  fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a affiché la liste des personnes</span><br>\n");
    $db = new Mypdo();
    $manager = new PersonneManager($db);

  	if (empty($_GET["num"]))
    {
      ?><h1>Liste des personnes </h1><?php
      $nbPersonne=$manager->getNbPersonnes();
      $listPersonnes = $manager->getAll();
      echo "<p>Actuellement ".$nbPersonne." personnes sont enregistrées</p>\n";
      echo "<table>\n";
      echo "<tr><th>Numéro</th><th>Nom </th><th>Prenom</th></tr>\n";
      foreach($listPersonnes as $Personnes){
        ?><tr class="borderTr"><?php
        echo"<td class='borderTd'>" ;
        echo"<a href='index.php?page=2&num=".$Personnes->getPer_num()."'>";
        echo "<b>".$Personnes->getPer_num()."</b>";
        echo"</a>";
        echo"</td>";
        echo "<td class='borderTd'>".$Personnes->getPer_nom()."</td>";
        echo "<td class='borderTd'>".$Personnes->getPer_prenom()."</td>";
         ?></tr><?php
       }
    echo "</table>\n";
    }
    else {
    	$num=$_GET["num"];
      if ($manager->estSalarie($num))
      {
        $file = fopen("./log/covoiturage.log","a");
        fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a affiché les détails du salarié ".$_GET["num"]."</span><br>\n");
        $managerSalarie=new SalarieManager($db);
        $salarie = $managerSalarie->getSalarieByNum($_GET["num"]);
        echo "<h1>Détail sur le salarié ".$salarie->per_nom."</h1>";
        echo "<table>";
        echo "<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Tel pro</th><th>Fonction</th></tr>";
        echo "<tr class='borderTr'>";
        echo "<td class='borderTd'>".$salarie->per_prenom."</td><td class='borderTd'>".$salarie->per_mail."</td><td class='borderTd'>".$salarie->per_tel."</td><td class='borderTd'>".$salarie->sal_telprof."</td><td class='borderTd'>".$salarie->fon_libelle."</td>";
        echo "</tr>";
        echo "</table>";
      }
      else
      {
        $file = fopen("./log/covoiturage.log","a");
        fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a affiché les détails de l'étudiant ".$_GET["num"]."</span><br>\n");
        $etudiantManager = new EtudiantManager($db);
        $etudiant = $etudiantManager->getEtudiantByNum($_GET["num"]);
        echo "<h1>Détail sur l'étudiant ".$etudiant->per_nom."</h1>";
        echo "<table>";
        echo "<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Département</th><th>Ville</th></tr>";
        echo "<tr class='borderTr'>";
        echo "<td class='borderTd'>".$etudiant->per_prenom."</td><td class='borderTd'>".$etudiant->per_mail."</td><td class='borderTd'>".$etudiant->per_tel."</td><td class='borderTd'>".$etudiant->dep_nom."</td><td class='borderTd'>".$etudiant->vil_nom."</td>";
        echo "</tr>";
        echo "</table>";
      }

    }
  }else{
    echo "Vous n'avez pas accès à cette page";
  }
?>
