<?php
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
    ?><tr><?php
    echo"<td>" ;
    echo"<a href='index.php?page=3&num=".$Personnes->getPer_num()."'>";
    echo $Personnes->getPer_num();
    echo"</a>";
    echo"</td>";
    echo "<td>".$Personnes->getPer_nom()."</td>";
    echo "<td>".$Personnes->getPer_prenom()."</td>";
     ?></tr><?php
   }
echo "</table>\n";
}
if(!empty($_GET["num"])&&(empty($_POST["nom"]))&&(empty($_POST["prenom"]))&&(empty($_POST["telephone1"]))&&(empty($_POST["mail"]))&&(empty($_POST["login"]))&&(empty($_POST["mdp"]))&&(empty($_POST["categorie"]))){
  if($manager->estSalarie($_GET["num"])){
    $file = fopen("./log/covoiturage.log","a");
    fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." veut modifier le salarié ".$_GET["num"]."</span><br>\n");
    echo "<h1>Modification du salarié ".$_GET["num"]."</h1>";
    $fonctionManager = new FonctionManager($db);
    $listFonctions = $fonctionManager->getAll();
    ?>
    <form method="post" action="#">
      Nom : <input type="text" name="nom"> Prenom : <input type="text" name="prenom"><br>
    	Téléphone : <input type="text" name="telephone1"> Mail : <input type="text" name="mail"><br>
    	Login : <input type="text" name="login"> Mot de passe : <input type="password" name="mdp"><br>
      Tel pro : <input type="text" name="telephone2">
      Fonction : <select name="fonction">
        <?php
        foreach ($listFonctions as $value) {
          echo "<option value='".$value->getFon_num()."'>".$value->getFon_libelle()."</option>";
        }
        ?>
      </select><br>
      <input type="submit" value="Valider">
    </form>
    <?php
  }else{
    $file = fopen("./log/covoiturage.log","a");
    fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." veut modifier l'étudiant ".$_GET["num"]."</span><br>\n");
    $divisionManager = new DivisionManager($db);
    $listDivision = $divisionManager->getAll();
    $departementManager = new DepartementManager($db);
    $listDepartement = $departementManager->getAll();
    ?>
    <form method="post" action="#">
      Nom : <input type="text" name="nom"> Prenom : <input type="text" name="prenom"><br>
      Téléphone : <input type="text" name="telephone1"> Mail : <input type="text" name="mail"><br>
      Login : <input type="text" name="login"> Mot de passe : <input type="password" name="mdp"><br>
      Année : <select name="annee">
      <?php
      foreach ($listDivision as $value) {
        echo "<option value=".$value->getDiv_num().">".$value->getDiv_nom()."</option>";
      }
      ?>
      </select>
      Département : <select name="dep">
      <?php
      foreach ($listDepartement as $value) {
        echo "<option value=".$value->getDep_num().">".$value->getDep_nom()."</option>";
      }
      ?>
    </select><br>
      <input type="submit" name="name" value="Valider">
    </form>
  <?php
  }
}
if ((!empty($_GET["num"]))&&(!empty($_POST["nom"]))&&(!empty($_POST["prenom"]))&&(!empty($_POST["telephone1"]))&&(!empty($_POST["mail"]))&&(!empty($_POST["login"]))&&(!empty($_POST["mdp"]))){
  $erreur = "";
	if(strlen($_POST["telephone1"])!=10){
		$erreur += "Numéro de téléphone incorrecte\n";
		echo "Numéro de téléphone incorrecte\n";
	}
	if((stripos($_POST["mail"], "@")===false)&&(stripos($_POST["mail"], ".")===false)){
		$erreur += "Mail incorrecte\n";
		echo "Mail incorrecte\n";
	}
	if(strlen($erreur)>0){
		echo "<br><span id='chrono'>Redirection dans 2 secondes</span>";
		echo "<script>appel();
		redirectionAccueil();</script>";
	}else{
    $personne = new Personne(array(
      "per_num" => $_GET["num"],
			"per_nom" => $_POST["nom"],
			"per_prenom" => $_POST["prenom"],
			"per_tel" => $_POST["telephone1"],
			"per_mail" => $_POST["mail"],
			"per_login" => $_POST["login"],
			"per_pwd" => sha1(sha1($_POST["mdp"])."48@!alsd")
		));
    $manager->updatePersonne($personne);

    if($manager->estSalarie($_GET["num"])){
      $salarie = new Salarie(array(
        "per_num" => $_GET["num"],
        "sal_telprof"=> $_POST["telephone2"],
        "fon_num"=>$_POST["fonction"]
      ));
      $salarieManager = new SalarieManager($db);
      $salarieManager->updateSalarie($salarie);
      $file = fopen("./log/covoiturage.log","a");
      fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a modifié le salarié ".$_GET["num"]."</span><br>\n");
    }else{
      $etudiant = new Etudiant(array(
        "per_num" => $_GET["num"],
        "dep_num"=> $_POST["annee"],
        "div_num"=>$_POST["dep"]
      ));
      $etudiantManager = new EtudiantManager($db);
      $etudiantManager->updateEtudiant($etudiant);
      $file = fopen("./log/covoiturage.log","a");
      fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a modifié l'étudiant ".$_GET["num"]."</span><br>\n");
    }
    echo "<p>Modification terminée</p>";
    echo "<br><span id='chrono'>Redirection dans 2 secondes</span>";
		echo "<script>appel();
		redirectionAccueil();</script>";
  }
}
?>
