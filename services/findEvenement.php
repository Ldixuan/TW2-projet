<?php
set_include_path('..');
require_once('lib/common_service.php');

$args = new ArgSetFindEvenement();

if (! $args->isValid()){
  produceError('argument(s) invalide(s)');
  return;
}

try{
  if($args->categorie != ''){
    $data = new DataLayer();
    $evenement = $data->findEvenement($args->categorie,$args->key,$args->date);
    if ($evenement)
        produceResult($evenement);
    else
        produceError("equipe {$evenement} not found");
    }else {
      produceError('argument(s) invalide(s)');
    }
  }catch(PDOException $e){
    produceError($e->getMessage());
}

 ?>
