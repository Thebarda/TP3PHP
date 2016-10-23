<h1>Ajouter une ville</h1>
<?php

  $db = new Mypdo();
  $manager = new VilleManager($db);

  if(!isset($_POST["vil_nom"]))
  {
    ?>
    <form method="POST" action="#">

    <label class="label">Nom :</label> <input type="text" name="vil_nom" class="text">
    <input type="submit" value="Valider" class="valider">

  </form>
<?php
  }
  else
  {
    $ville = new Ville( array('vil_nom' => $_POST["vil_nom"] ));
    $manager->add($ville);
    $file = fopen("./log/covoiturage.log","a");
    fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a affiché la ville".$_POST["vil_nom"]."</span><br>\n");
    echo "<img src='./image/valid.png' alt='valid'>la ville <b>".$_POST["vil_nom"]."<b> a ete ajoutée ";
    echo "<br><span id='chrono'>Redirection dans 2 secondes</span>";
    echo "<script>appel();
    redirectionAccueil();</script>";

  }


 ?>
