<?php
if($_SESSION["statusPerConnected"]==2){
  ?><h1>Log</h1><?php
  $file = fopen("./log/covoiturage.log", "r");
  while(($line = fgets($file, 4096))!==false){
    echo "".$line."<br>";
  }
}else{
  echo "Vous n'avez pas accès à cette page";
}
?>
