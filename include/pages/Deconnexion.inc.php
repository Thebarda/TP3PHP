<?php
$file = fopen("./log/covoiturage.log","a");
fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." s'est déconnecté du compte de ".$_SESSION["loginPersConnected"]."<br>\n");

unset($_SESSION["statusPersConnected"]);
unset($_SESSION["loginPersConnected"]);
echo "<script>redirectionAccueil();</script>";
?>
