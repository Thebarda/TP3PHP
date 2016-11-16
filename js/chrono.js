function redirection(){
  document.location.href="index.php?page=1";
}

function redirectionSalarie(){
  document.location.href="index.php?page=15";
}
function redirectionAccueil(){
  document.location.href="index.php?page=0";
}
function appel(){
  var compteurElt = document.getElementById("chrono");
  function diminuerCompteur() {
      var compteur = Number(compteurElt.textContent);
      if (compteur > 0) {
          compteurElt.textContent = compteur - 1;
      } else {
          clearInterval(intervalId);
      }
  }

  var intervalId = setInterval(diminuerCompteur, 1000);
}
