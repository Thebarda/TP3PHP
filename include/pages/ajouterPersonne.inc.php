<?php if((empty($_POST["nom"]))&&(empty($_POST["prenom"]))&&(empty($_POST["telephone1"]))&&(empty($_POST["mail"]))&&(empty($_POST["login"]))&&(empty($_POST["mdp"]))&&(empty($_POST["categorie"]))){ ?>
<h1>Ajouter une personne</h1>
<form method="post" action="#">
	Nom : <input type="text" name="nom"> Prenom : <input type="text" name="prenom"><br>
	Téléphone : <input type="text" name="telephone1"> Mail : <input type="text" name="mail"><br>
	Login : <input type="text" name="login"> Mot de passe : <input type="password" name="mdp"><br>
	Catégorie : <input type="radio" name="categorie" value="etudiant" checked="true">Etudiant</input> <input type="radio" value="personnel" name="categorie">Personnel</input><br>
	<input type="submit" name="ok" value="Valider">
</form>
<?php }

			?>
