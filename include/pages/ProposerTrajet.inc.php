<h1>Proposer un trajet</h1>
<?php
$db = new Mypdo();
  if((empty($_POST["vilDep"]))&&(!empty($_POST["vilArr"]))&&(!empty($_POST["dateDep"]))&&(!empty($_POST["timeDep"]))&&(!empty($_POST["nbPlaces"]))){
    $villeManager = new VilleManager($db);
    $parcoursManager = new ParcoursManager($db);
    $proposeManager = new ProposeManager($db);
    if($_SESSION["proSens"]==1){
      $par_num = $parcoursManager->getParNumByVil1($_POST["vilArr"], $_SESSION["vilDep"]);
    }else{
      $par_num = $parcoursManager->getParNumByVil1($_SESSION["vilDep"], $_POST["vilArr"]);
    }
    $propose = new Propose(array(
      "par_num" => $par_num,
      "per_num" => $_SESSION["numPersConnected"],
      "pro_date" => $_POST["pro_date"],
      "pro_time" => $_POST["pro_time"],
      "pro_place" => $_POST["nbPlace"],
      "pro_sens" => $_SESSION["proSens"]
    ));
    $proposeManager->add($propose);
  }
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
    ?>
    <form method="post" action="#">
      <label class="label">Ville de départ : <?php echo $villeManager->getNomByNum($_POST["vilDep"]);?></label>
      <label class="label"> Ville d'arrivée : </label><select class="text" name="VilArr">
        <?php
          $_SESSION["proSens"]=1;
          if($parcoursManager->vilExisteDansV1($_SESSION["vilDep"])!=0){
            $vils2 = $parcoursManager->getVil2ByVil1($_SESSION["vilDep"]);
            $_SESSION["proSens"]=0;
            foreach ($vils2 as $key => $value) {
              echo "<option value='".$value->getVil_num2()."'>".$villeManager->getNomByNum($value->getVil_num2())."</option>";
            }
          }//else{
            $vils1 = $parcoursManager->getVil1ByVil2($_SESSION["vilDep"]);
            foreach ($vils1 as $key => $value) {
              echo "<option value='".$value->getVil_num1()."'>".$villeManager->getNomByNum($value->getVil_num1())."</option>";
            //}
          }
         ?>
      </select>
      <br><br>
      <label class="label"> Date de départ : </label><?php echo "<input type='text' class='text' name='dateDep' value='".date("d/m/Y")."'>";?>
      <label class="label"> Heure de départ : </label><?php echo "<input type='text' class='text' name='timeDate' value='".date("h:i:s")."'>"; ?>
      <br><br>
      <label class="label"> Nombre de places :</label> <input type="text" class="text" name="nbPlaces">
        <br><br>
        <input type="submit" class="valider" value="Valider">
    </form>
    <?php
  }
 ?>
