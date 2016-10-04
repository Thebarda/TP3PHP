<h1>Ajouter une ville</h1>
<?php

  $db = new Mypdo();
  $manager = new VilleManager($db);

  if(!isset($_POST["vil_nom"]))
  {
    ?>
    <form method="POST" action="#">

    nom : <input type="textarea" name="vil_nom" >
    <input type="submit" value="envoyer">

  </form>
<?php
  }
  else
  {
    $ville = new Ville( array('vil_nom' => $_POST["vil_nom"] ));
    $manager->add($ville);

    echo "la ville ".$_POST["vil_nom"]." a ete ajoutée ";


  }


 ?>
