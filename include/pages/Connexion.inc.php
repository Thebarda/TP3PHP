<h1>Pour vous connecter</h1>
<?php if((empty($_POST["login"]))&&(empty($_POST["pwd"]))&&(empty($_POST["calcule"]))){ ?>
<form method="post" action="#">
  Nom d'utilisateur : <br>
  <input type="text" name="login"><br>
  Mot de passe :<br>
  <input type="password" name="pwd"><br>
  <?php
  $oper1 = rand(1, 9);
  $oper2 = rand(1, 9);
  $_SESSION["operation"] = $oper1 + $oper2;
  ?>
  <span><img src="./image/nb/<?php echo $oper1; ?>.jpg"/></span><span> + </span><span><img src="./image/nb/<?php echo $oper2; ?>.jpg"/></span><span> = </span>
   <br><input type="text" name="calcule">
  <input type="submit" value="Valider">
</form>
<?php
}else{
  if($_SESSION["operation"]==$_POST["calcule"]){
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $_POST["pwd"] = sha1(sha1($_POST["pwd"])."48@!asld");
    if(($personneManager->checkLogin($_POST["login"])==true)&&($personneManager->checkPassword($_POST["pwd"])==true)){
      $_SESSION["loginPersConnected"] = $_POST["login"];
      $per_num = $personneManager->getNumByLogin($_POST["login"]);
      if($personneManager->estSalarie($per_num)){
        $_SESSION["statusPersConnected"]=2;
      }else{
        $_SESSION["statusPersConnected"]=1;
      }
      echo "<script>redirectionAccueil();</script>";
    }else{
      if($personneManager->checkLogin($_POST["login"])==false){
        echo "Login incorrecte\n";
      }
      if($personneManager->checkPassword($_POST["pwd"])==false){
        echo "Mot de passe incorrecte\n";
      }
      echo "<br><span id='chrono'>Redirection dans 2 secondes</span>";
    }
  }else{
    echo "Vous êtes nul en math";
  }
  echo "<script>appel();
  redirectionAccueil();</script>";
}
 ?>
