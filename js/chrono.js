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
  sleep(2000);
}
function chrono(rest){
  document.getElementById('chrono').textContent="Redirection dans "+rest+" secondes";
  return true;
}

function sleep(delay) {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay);
}
