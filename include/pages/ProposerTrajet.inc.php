<h1>Proposer un trajet</h1>
<?php
$db = new Mypdo();
  if(!empty($_SESSION["vilDep"])){
    $villeManager = new VilleManager($db);
    $parcoursManager = new ParcoursManager($db);
    $proposeManager = new ProposeManager($db);
    $par_num=1212;
    $listParcours = $parcoursManager->getAll();
    foreach ($listParcours as $key => $parcours) {
      if(($_SESSION["vilDep"]==$parcours->getVil_num1())&($_POST["VilArr"]==$parcours->getVil_num2())){
        $par_num = $parcours->getPar_num();
      }else if (($_SESSION["vilDep"]==$parcours->getVil_num2())&($_POST["VilArr"]==$parcours->getVil_num1())){
        $par_num = $parcours->getPar_num();
      }
    }
    $membres = explode('/', $_POST["dateDep"]);
		$date = $membres[2].'-'.$membres[1].'-'.$membres[0];

    $propose = new Propose(array(
      "par_num" => $par_num,
      "per_num" => $_SESSION["numPersConnected"],
      "pro_date" => $date,
      "pro_time" => $_POST["timeDate"],
      "pro_place" => $_POST["nbPlaces"],
      "pro_sens" => $_SESSION["proSens"]
    ));
    $proposeManager->add($propose);
    echo "<img src='./image/valid.png' alt='ok'> Trajet ajouté ";
    unset($_SESSION["proSens"]);
    unset($_SESSION["vilDep"]);
    echo "<br>Redirection dans <span id='chrono'>3</span> secondes";
    echo "<script>document.location.href='index.php?page=0';</script>";
  }else
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
          if($parcoursManager->vilExisteDansV1($_SESSION["vilDep"])!=0){
            $_SESSION["proSens"]=1;
            $vils2 = $parcoursManager->getVil2ByVil1($_SESSION["vilDep"]);
            foreach ($vils2 as $key => $value) {
              echo "<option value='".$value->getVil_num2()."'>".$villeManager->getNomByNum($value->getVil_num2())."</option>";
            }
          }else{
            $_SESSION["proSens"]=0;
            $vils1 = $parcoursManager->getVil1ByVil2($_SESSION["vilDep"]);
            foreach ($vils1 as $key => $value) {
              echo "<option value='".$value->getVil_num1()."'>".$villeManager->getNomByNum($value->getVil_num1())."</option>";
            }
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
