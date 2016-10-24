<?php
if(!empty($_SESSION["statusPersConnected"])){
	if((empty($_POST["nom"]))&&(empty($_POST["prenom"]))&&(empty($_POST["telephone1"]))&&(empty($_POST["mail"]))&&(empty($_POST["login"]))&&(empty($_POST["mdp"]))&&(empty($_POST["categorie"]))){ ?>
	<h1>Ajouter une personne</h1>
	<form method="post" action="#">
	<table id="left">
		<tr><td><label class="label">Nom : </label></td><td><input type="text" name="nom" class="text"></td><td> <label class="label">Prenom : </label></td><td><input type="text" name="prenom" class="text"></td></tr>
		<tr><td><label class="label">Téléphone : </label></td><td><input type="text" name="telephone1" class="text"> </td><td><label class="label"> Mail : </label></td><td><input type="text" name="mail" class="text"></td></tr>
		<tr><td><label class="label">Login : </label></td><td><input type="text" name="login" class="text"></td><td> <label class="label">Mot de passe : </label></td><td><input type="password" name="mdp" class="text"></td></tr>
	</table>
		<label class="label">Catégorie : </label><input type="radio" name="categorie" value="etudiant" checked="true"><label class="label">Etudiant</label></input> <input type="radio" value="salarie" name="categorie"><label class="label">Personnel</label></input><br>
		<br><input type="submit" name="ok" value="Valider" class="valider">
	</form>
	<?php
	}else{
		$erreur = "";
		if((strlen($_POST["nom"])==0)&&(strlen($_POST["prenom"])==0)&&(strlen($_POST["telephone1"])==0)&&(strlen($_POST["mail"])==0)&&(strlen($_POST["login"])==0)&&(strlen($_POST["mdp"])==0)){
			$erreur += "Champs vide\n";
			echo "Champs vide\n";
		}
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
}else{
	echo "Vous n'avez pas accès à cette page";
}
			?>
