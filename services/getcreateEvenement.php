<?php

session_start();
if(isset($_SESSION['find'])){
return;
}
require_once("../lib/ArgSetCreateEvenement.class.php");
$args = new ArgSetCreateEvenement();
if($args->isValid() && $args->categorie != ''){
  require_once('../lib/initDataLayer.php');
  $evenement = $data->createEvenement($args->id,$args->auteur,$args->titre,$args->categorie,$args->description,$args->ou,$args->quand,$args->nbparticipants,$args->datecreation);
  if($evenement){
  $_SESSION['find'] = $evenement;
  unset($_SESSION['lose']);
  return;
}else {
  // echec de l'authentification
  $_SESSION['lose'] = true;
}
}
//tous les autres cas: on propose la page de login.....
require_once('../views/pageLogin.php');
exit();

 ?>
<?php
/*

set_include_path('..'.PATH_SEPARATOR);
require_once('common_service.php');

$args = new ArgSetCreateEvenement();
if (! $args->isValid() && $args->categorie != ''){
  produceError('argument(s) invalide(s)');
  return;
}

try{
  require_once('initDataLayer.php');
  $data = new DataLayer();
  $evenement = $data->createEvenement($args->id,$args->auteur,$args->titre,$args->categorie,$args->description,$args->ou,$args->quand,$args->nbparticipants,$args->datecreation);
  produceResult($evenement);
}
catch (PDOException $e){
    produceError($e->getMessage());
}
*/

?>
