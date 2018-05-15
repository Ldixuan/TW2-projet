<?php
  /*
    Utilise le contenu de $_SESSION (en particulier $_SESSION['ident'])
  */
  if ( ! isset($_SESSION['evenement'])){  // si la page était protégée, on ne devrait même pas faire ce test
      echo("l'evenement n'a pas été creé");
      exit();
  }
   if(($_SESSION['evenement'])){
  echo("l'evenement a été creé avec succés !");
  exit();
}
