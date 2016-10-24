<h1>Proposer un trajet</h1>
<?php
$db = new Mypdo();
  if(empty($_POST["vilDep"])){
    ?>
    <form method="post" action="#">
      <label class="label">Ville de départ : </label><br>
      <br><select class="text" name="vilDep">
        <?php
          $parcoursManager = new ParcoursManager($db);
          $villeManager = new VilleManager($db);
          $vils1 = $parcoursManager->getVil1();
          foreach ($vils1 as $key => $value) {
            echo "<option value='".$value->getVil_num1()."'>".$villeManager->getNomByNum($value->getVil_num1())."</option>";
          }
          $vils2 = $parcoursManager->getVil2();
          foreach ($vils2 as $key => $value) {
            echo "<option value='".$value->getVil_num2()."'>".$villeManager->getNomByNum($value->getVil_num2())."</option>";
          }
         ?>
       </select><br><br>
       <input type="submit" value="Valider" class="valider">
    </form>
    <?php
  }
  if(!empty($_POST["vilDep"])){
    $_SESSION["vilDep"] = $_POST["vilDep"];
    $villeManager = new VilleManager($db);
    $parcoursManager = new ParcoursManager($db);
    echo $parcoursManager->vilExisteDansV1($_SESSION["vilDep"]);
    ?>
    <form method="post" action="#">
      <label class="label">Ville de départ : <?php echo $villeManager->getNomByNum($_POST["vilDep"]);?></label>
      <label class="label"> Ville d'arrivée : </label><select class="text">
        <?php

          if($parcoursManager->vilExisteDansV1($_SESSION["vilDep"])!=NULL){
            $vils2 = $parcoursManager->getVil2ByVil1($_SESSION["vilDep"]);
            foreach ($vils2 as $key => $value) {
              echo "<option value='".$value->getVil_num2()."'>".$villeManager->getNomByNum($value->getVil_num2())."</option>";
            }
          }else{
            $vils1 = $parcoursManager->getVil1ByVil2($_SESSION["vilDep"]);
            foreach ($vils1 as $key => $value) {
              echo "<option value='".$value->getVil_num1()."'>".$villeManager->getNomByNum($value->getVil_num1())."</option>";
            }
          }
         ?>
      </select>
    </form>
    <?php
  }
 ?>
