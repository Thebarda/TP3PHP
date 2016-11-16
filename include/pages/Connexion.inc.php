<h1>Pour vous connecter</h1>
<?php if((empty($_POST["login"]))&&(empty($_POST["pwd"]))&&(empty($_POST["calcule"]))){ ?>
<form method="post" action="#">
  <label class="label">Nom d'utilisateur : </label><br>
  <input type="text" name="login" class="text"><br>
  <label class="label">Mot de passe :</label><br>
  <input type="password" name="pwd" class="text"><br>
  <?php
  $oper1 = rand(1, 9);
  $oper2 = rand(1, 9);
  $_SESSION["operation"] = $oper1 + $oper2;
  ?>
  <span><img src="./image/nb/<?php echo $oper1; ?>.jpg" class="img" alt="nb1"/></span><span> <span><img src="./image/nb/plus.png" alt="plus"></span><span><img src="./image/nb/<?php echo $oper2; ?>.jpg" alt="nb2" class="img"/></span><span><img src="./image/nb/equal.png" alt="equal" /></span>
   <br><input type="text" name="calcule" class="text"><br><br>
  <input type="submit" value="Valider" class="valider">
</form>
<?php
}else{
  if($_SESSION["operation"]==$_POST["calcule"]){
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $_POST["pwd"] = sha1(sha1($_POST["pwd"])."48@!alsd");
    if(($personneManager->checkLogin($_POST["login"])==true)&&($personneManager->checkPassword($_POST["pwd"])==true)){
      $_SESSION["loginPersConnected"] = $_POST["login"];
      $per_num = $personneManager->getNumByLogin($_POST["login"]);
      $_SESSION["numPersConnected"] = $per_num;
      if($personneManager->estSalarie($per_num)){
        $_SESSION["statusPersConnected"]=2;
      }else{
        $_SESSION["statusPersConnected"]=1;
      }
      $file = fopen("./log/covoiturage.log","a");
      fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." s'est connecté via le compte de ".$_POST["login"]."<br>\n");
    }else{
      if($personneManager->checkLogin($_POST["login"])==false){
        echo "Login incorrecte\n";
      }
      if($personneManager->checkPassword($_POST["pwd"])==false){
        echo "Mot de passe incorrecte\n";
      }
    }
  }else{
    echo "Avez-vous brûlez vos cours de maths ??\n";
    $file = fopen("./log/covoiturage.log","a");
    fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." au nom de ".$_POST["login"]." a brûlé ses cours de maths <br>\n");
  }
  echo "<br>Redirection dans <span id='chrono'>2</span> secondes";
  echo "<script>appel;</script>";
  echo "<script>redirectionAccueil();</script>";
}
 ?>
