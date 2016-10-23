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
    ?><tr class="boderTr"><?php
    echo"<td class='borderTd'>" ;
    echo $Personnes->getPer_num();
    echo"</td>";
    echo "<td class='borderTd'>".$Personnes->getPer_nom()."</td>";
    echo "<td class='borderTd'>".$Personnes->getPer_prenom()."</td>";
    echo "<td class='borderTd'>";
    echo"<a href='index.php?page=3&num=".$Personnes->getPer_num()."'><img src='./image/modifier.png'></a>";
    echo "</td>";
     ?></tr><?php
   }
echo "</table>\n";
}
if(!empty($_GET["num"])&&(empty($_POST["nom"]))&&(empty($_POST["prenom"]))&&(empty($_POST["telephone1"]))&&(empty($_POST["mail"]))&&(empty($_POST["login"]))&&(empty($_POST["mdp"]))&&(empty($_POST["categorie"]))){
  if($manager->estSalarie($_GET["num"])){
    $file = fopen("./log/covoiturage.log","a");
    fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." veut modifier le salarié ".$_GET["num"]."</span><br>\n");
    $nom = $manager->getNomByNum($_GET["num"]);
    echo "<h1>Modification du salarié ".$nom."</h1>";
    $fonctionManager = new FonctionManager($db);
    $listFonctions = $fonctionManager->getAll();
    ?>
    <form method="post" action="#">
      <table id="left">
      	<tr><td><label class="label">Nom : </label></td><td><input type="text" name="nom" class="text"></td><td> <label class="label">Prenom : </label></td><td><input type="text" name="prenom" class="text"></td></tr>
      	<tr><td><label class="label">Téléphone : </label></td><td><input type="text" name="telephone1" class="text"> </td><td><label class="label"> Mail : </label></td><td><input type="text" name="mail" class="text"></td></tr>
      	<tr><td><label class="label">Login : </label></td><td><input type="text" name="login" class="text"></td><td> <label class="label">Mot de passe : </label></td><td><input type="password" name="mdp" class="text"></td></tr>
        <tr><td><label class="label">Tel pro : </label></td><td><input type="text" name="telephone2" class="text"></td><td><label class="label">Fonction : </label></td><td><select name="fonction" class="text">
          <?php
          foreach ($listFonctions as $value) {
            echo "<option value='".$value->getFon_num()."'>".$value->getFon_libelle()."</option>";
          }
          ?>
        </select></tr>
      </table><br><br>
      <input type="submit" value="Valider" class="valider">
    </form>
    <?php
  }else{
    $file = fopen("./log/covoiturage.log","a");
    fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." veut modifier l'étudiant ".$_GET["num"]."</span><br>\n");
    $nom = $manager->getNomByNum($_GET["num"]);
    echo "<h1>Modification de l'étudiant ".$nom."</h1>";
    $divisionManager = new DivisionManager($db);
    $listDivision = $divisionManager->getAll();
    $departementManager = new DepartementManager($db);
    $listDepartement = $departementManager->getAll();
    ?>
    <form method="post" action="#">
      <table id="left">
      	<tr><td><label class="label">Nom : </label></td><td><input type="text" name="nom" class="text"></td><td> <label class="label">Prenom : </label></td><td><input type="text" name="prenom" class="text"></td></tr>
      	<tr><td><label class="label">Téléphone : </label></td><td><input type="text" name="telephone1" class="text"> </td><td><label class="label"> Mail : </label></td><td><input type="text" name="mail" class="text"></td></tr>
      	<tr><td><label class="label">Login : </label></td><td><input type="text" name="login" class="text"></td><td> <label class="label">Mot de passe : </label></td><td><input type="password" name="mdp" class="text"></td></tr>
        <tr><td><label class="label">Année : </label></td><td><select name="annee" class="text">
        <?php
        foreach ($listDivision as $value) {
          echo "<option value=".$value->getDiv_num().">".$value->getDiv_nom()."</option>";
        }
        ?>
      </select></td><td><label class="label">Département</label></td><td><select name="dep" class="text">
        <?php
        foreach ($listDepartement as $value) {
          echo "<option value=".$value->getDep_num().">".$value->getDep_nom()."</option>";
        }
        ?>
      </select></td></tr>
    </table><br><br>
      <input type="submit" name="name" value="Valider" class="valider">
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
