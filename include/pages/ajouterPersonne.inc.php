<?php
if((empty($_POST["nom"]))&&(empty($_POST["prenom"]))&&(empty($_POST["telephone1"]))&&(empty($_POST["mail"]))&&(empty($_POST["login"]))&&(empty($_POST["mdp"]))&&(empty($_POST["categorie"]))){ ?>
<h1>Ajouter une personne</h1>
<form method="post" action="#">
	Nom : <input type="text" name="nom"> Prenom : <input type="text" name="prenom"><br>
	Téléphone : <input type="text" name="telephone1"> Mail : <input type="text" name="mail"><br>
	Login : <input type="text" name="login"> Mot de passe : <input type="password" name="mdp"><br>
	Catégorie : <input type="radio" name="categorie" value="etudiant" checked="true">Etudiant</input> <input type="radio" value="personnel" name="categorie">Personnel</input><br>
	<input type="submit" name="ok" value="Valider">
</form>
<?php
}else{
	$_SESSION['nom'] = $_POST["nom"];
	$personne = new Personne(array(
		"per_nom" => $_POST["nom"],
		"per_prenom" => $_POST["prenom"],
		"per_tel" => $_POST["telephone1"],
		"per_mail" => $_POST["mail"],
		"per_login" => $_POST["login"],
		"per_pwd" => md5("48@!alsd".$_POST["mdp"])
	));
	$db = new Mypdo();
	$personneManager = new PersonneManager($db);
	$personneManager->add($personne);
	if ($_POST["categorie"]=="etudiant") {
		header('Location: index?page=13');
	}
	if($_POST["categorie"]=="personnel"){
		header('Location: index?page=14');
	}
}

			?>
