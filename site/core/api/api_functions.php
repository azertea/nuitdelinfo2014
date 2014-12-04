<?php

/**

FONCTIONS

**/

function errorBadRequest($msg) {
  // Renvoyer erreur
  header('HTTP/1.1 400 Bad Request : '.$msg);
  
  // Mourir
  die();
}

function errorForbidden() {
  // Renvoyer erreur
  header('HTTP/1.1 403 Forbidden');
  
  // Mourir
  die();
}

function errorNotAcceptable ($msg) {
  // Renvoyer erreur
  header('HTTP/1.1 406 Not Acceptable : '.$msg);
  
  // Mourir
  die();
}

function errorInternal () {
  // Renvoyer erreur
  header('HTTP/1.1 500 Internal Error');
  
  // Mourir
  die();
}



/*

function error<ERRNAME> ($msg) {
  // Renvoyer erreur
  header('HTTP/1.1 <ERRNO> <ERRTAG> : '.$msg);
  
  // Mourir
  die();
}


*/

?>