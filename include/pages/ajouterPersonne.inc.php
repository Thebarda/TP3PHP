<?php
if((empty($_POST["nom"]))&&(empty($_POST["prenom"]))&&(empty($_POST["telephone1"]))&&(empty($_POST["mail"]))&&(empty($_POST["login"]))&&(empty($_POST["mdp"]))&&(empty($_POST["categorie"]))){ ?>
<h1>Ajouter une personne</h1>
<form method="post" action="#">
	Nom : <input type="text" name="nom"> Prenom : <input type="text" name="prenom"><br>
	Téléphone : <input type="text" name="telephone1"> Mail : <input type="text" name="mail"><br>
	Login : <input type="text" name="login"> Mot de passe : <input type="password" name="mdp"><br>
	Catégorie : <input type="radio" name="categorie" value="etudiant" checked="true">Etudiant</input> <input type="radio" value="salarie" name="categorie">Personnel</input><br>
	<input type="submit" name="ok" value="Valider">
</form>
<?php
}else{
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
		redirection();</script>";
	}else{
		$_SESSION['nom'] = $_POST["nom"];
		$personne = new Personne(array(
			"per_nom" => $_POST["nom"],
			"per_prenom" => $_POST["prenom"],
			"per_tel" => $_POST["telephone1"],
			"per_mail" => $_POST["mail"],
			"per_login" => $_POST["login"],
			"per_pwd" => sha1(sha1($_POST["mdp"])."48@!alsd")
		));
		$_SESSION["personne"] = $personne;

		if ($_POST["categorie"]=="etudiant") {
			echo "<script type='text/javascript'>document.location.replace('index.php?page=13');</script>";
		} else{
			echo "<script type='text/javascript'>document.location.href='index.php?page=15';</script>";
		}
	}
}

			?>
