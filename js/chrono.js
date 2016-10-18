function redirection(){
  document.location.href="index.php?page=1";
}

function redirectionSalarie(){
  document.location.href="index.php?page=15";
}
function appel(){
  chrono(2);
  sleep(1000);
  chrono(1);
  sleep(1000);
}
function chrono(rest){
  document.getElementById('chrono').textContent="Redirection dans "+rest+" secondes";
  return true;
}

function sleep(delay) {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay);
}
