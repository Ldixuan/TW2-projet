<?php
  /*
    Utilise le contenu de $_SESSION (en particulier $_SESSION['ident'])
  */
  if ( ! isset($_SESSION['find'])){  // si la page était protégée, on ne devrait même pas faire ce test
      echo("l'evenement n'a pas été creé");
      exit();
  }
   if(($_SESSION['find'])){
  echo("l'evenement a été creé avec succés !");
  exit();
}
