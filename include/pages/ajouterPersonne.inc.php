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
			if((!empty($_POST["nom"]))&&(!empty($_POST["prenom"]))&&(!empty($_POST["telephone1"]))&&(!empty($_POST["mail"]))&&(!empty($_POST["login"]))&&(!empty($_POST["mdp"]))&&(!empty($_POST["categorie"]))){
				$_SESSION["nom"] = $_POST["nom"];
				$_SESSION["prenom"] = $_POST["prenom"];
				$_SESSION["telephone1"] = $_POST["telephone1"];
				$_SESSION["mail"] = $_POST["mail"];
				$_SESSION["login"] = $_POST["login"];
				$_SESSION["mdp"] = $_POST["mdp"];
				$_SESSION["categorie"] = $_POST["categorie"];
			}
			if(!empty($_SESSION["categorie"])){
				if($_SESSION["categorie"]== "etudiant"){
					$db = new Mypdo();
					$divisionManager = new DivisionManager($db);
					$listDivision = $divisionManager->getAll();
					$departementManager = new DepartementManager($db);
					$listDepartement = $departementManager->getAll();
?>
<h1>Ajouter un étudiant</h1>
<form method="post" action="#">
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
	</select>
	<input type="submit" name="name" value="Valider">
</form>
<?php 	}
				if((!empty($_POST["annee"]))&&(!empty($_POST["dep"]))){
					$personne = new Personne(array(
						"per_nom" => $_SESSION["nom"],
						"per_penom" => $_SESSION["prenom"],
						"per_tel" => $_SESSION["telephone1"],
						"per_mail" => $_SESSION["mail"],
						"per_login" => $_SESSION["login"],
						"per_pwd" => md5("48@!alsd".$_SESSION["mdp"])
					));
					$db = new Mypdo();
					$personneManager = new PersonneManager($db);
					$personneManager->add($personne);
					$_SESSION["nom"] = null;
					$_SESSION["prenom"] = null;
					$_SESSION["telephone1"] = null;
					$_SESSION["mail"] = null;
					$_SESSION["login"] = null;
					$_SESSION["mdp"] = null;
					$_SESSION["categorie"] = null;
					echo $personne->getPer_nom();
					$perNum = $personneManager->getNumByNom($personne->getPer_nom());
					echo $perNum;
					$etudiant = new Etudiant(array(
						"per_num" => $perNum,
						"dep_num" => $_POST["dep"],
						"div_num" => $_POST["annee"]
					));
					$etudiantManager = new EtudiantManager($db);
					$etudiantManager->add($etudiant);
					echo "<p>C'est bon:)</p>";
				}
				if($_SESSION["categorie"]=="personnel"){
?>
<h1>Ajouter un personnel</h1>
<form method="post" action="#">
	<input type="submit" name="name" value="Valider">
</form>
<?php 	}
			}else{
				echo "<ça va>";
			}
			?>
