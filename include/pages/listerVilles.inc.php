<?php
if(!empty($_SESSION["statusPersConnected"])){
 ?>
<h1>Liste des villes </h1>
<?php
$file = fopen("./log/covoiturage.log","a");
fputs($file, "<span>".date('l jS \of F Y h:i:s A')." : Le pc ".$_SERVER["REMOTE_ADDR"]." a affiché la liste des villes</span><br>\n");
  $db = new Mypdo();
  $managerVille = new VilleManager($db);
  $nbVilles = $managerVille->getNbVille();
  $listVilles = $managerVille->getAll();
  echo "<p>Actuellement ".$nbVilles." villes sont enregistrées</p>\n";
  echo "<table>\n";
  echo "<tr><th>Numéro</th><th>Nom</th></tr>\n";
  foreach($listVilles as $ville){
    ?><tr class="borderTr"><?php
    ?><td class="borderTd"><?php echo $ville->getVil_num(); ?></td>
    <td class="borderTd"><?php echo $ville->getVil_nom(); ?></td>
     </tr><?php
  }
  echo "</table>\n";
}else{
  echo "Vous n'avez accès à cette page";
}
?>
