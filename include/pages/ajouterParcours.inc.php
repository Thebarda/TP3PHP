  <h1>Ajouter un parcours</h1>
<?php
  $db = new Mypdo();
if((empty($_POST["ville1"]))&&(empty($_POST["ville2"]))&&(empty($_POST["nbKm"]))){
  $villeManager = new VilleManager($db);
  $listVilles = $villeManager->getAll();
  ?>
  <form action="#" method="post">
    <label class="label">Ville 1 :</label> <select name="ville1" class="text">
      <?php
        foreach ($listVilles as $ville) {
          echo '<option value="'.$ville->getVil_num().'">'.$ville->getVil_nom().'</option>';
        }
      ?>
    </select>
    <label class="label">Ville 2 :</label> <select name="ville2" class="text">
      <?php
        foreach ($listVilles as $ville) {
          echo '<option value="'.$ville->getVil_num().'">'.$ville->getVil_nom().'</option>';
        }
      ?>
    </select>
    <label class="label">Nombre de kilomètres(s) :</label> <input type="text" name="nbKm" class="text">
    <br><br><input type="submit" value="Valider" class="valider">
  </form>
  <?php
}else{
  if($_POST["ville1"]==$_POST["ville2"]){
    echo "Les villes sont les mêmes \n";
  }else{
    if((is_numeric($_POST["nbKm"]))&&($_POST["nbKm"])>0){
      $parcoursManager = new ParcoursManager($db);
      $parcours = new Parcours(array(
        'par_num' => 0,
        'par_km' => $_POST["nbKm"],
        'vil_num1' => $_POST["ville1"],
        'vil_num2' => $_POST["ville2"]
      ));
      $parcoursManager->add($parcours);
      $file = fopen("./log/covoiturage.log","a");
      fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a ajouté le parcours de ".$parcours->getVil_num1()." à ".$parcours->getVil_num2()."</span><br>\n");
      echo "<img src='./image/valid.png' alt='valid'> Le parcours a été ajouté";
    }else{
      echo "Le nombre kilomètrage est inférieur à zéro ou n'est pas un nombre";
      echo "<br><span id='chrono'>Redirection dans 2 secondes</span>";
      echo "<script>appel();
      redirectionAccueil();</script>";
    }
  }
}
?>
