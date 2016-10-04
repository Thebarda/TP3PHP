<h1>Ajouter une ville</h1>


<?php
  private $nbVille;

  if(!isset($_POST["vil_nom"])
  {
    ?>
    <form method="POST" action="ex2.php">

    nom : <input type="textarea" name="vil_nom" >
    <input type="submit" value="envoyer">

  </form>
<?php
  }
  else
  {

    echo "la ville ".$_POST["vil_nom"]." a ete ajoutée ";


  }


 ?>
