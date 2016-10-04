<?php
if((empty($_POST["ville1"]))&&(empty($_POST["ville2"]))&&(empty($_POST["nbKm"]))){
  $db = new Mypdo();
  $villeManager = new VilleManager($db);
  $listVilles = $villeManager->getAll();
  ?>
  <form action="#" method="post">
    Ville 1 : <select name="ville1">
      <?php
        foreach ($listVilles as $ville) {
          echo '<option value="'.$ville->getVil_num().'">'.$ville->getVil_nom().'</option>';
        }
      ?>
    </select><br>
    Ville 2 : <select name="ville2">
      <?php
        foreach ($listVilles as $ville) {
          echo '<option value="'.$ville->getVil_num().'">'.$ville->getVil_nom().'</option>';
        }
      ?>
    </select><br>
    Nombre de kilomètres(s) : <input type="text" name="nbKm">
    <br><input type="submit" value="Valider">
  </form>
  <?php
}else{
  if($_POST["ville1"]==$_POST["ville2"]){
    echo "Les villes sont les mêmes";
    sleep(2);
    header('Location:http://localhost/covoiturage/index.php?page=5');
  }else{

  }
}
?>
