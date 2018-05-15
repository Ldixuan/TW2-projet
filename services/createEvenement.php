<?php
set_include_path('..');
require_once('lib/common_service.php');

$args = new ArgSetCreateEvenement();
if (! $args->isValid()){
  produceError('argument(s) invalide(s)');
  return;
}

try{
  $data = new DataLayer();
  if($args->categorie != ''){
  $evenement = $data->createEvenement($args->titre,$args->categorie,$args->description,$args->ou,$args->quand);
  }
}

catch (PDOException $e){
    produceError($e->getMessage());
  }

 ?>
