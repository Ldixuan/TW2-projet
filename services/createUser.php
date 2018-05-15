<?php
spl_autoload_register(function ($className) {
     include ("../lib/{$className}.class.php");
 });
$Argset = new ArgSetCreateUser();
if ($Argset->isValid()){
  require('../lib/initDataLayer.php');
  $success = $data->createUser($Argset->login, $Argset->password);
  if (!$success){
    $erreurCreation = 1;
    require_once("../views/pageLogin.php");
    exit();
  }
}else{
  $erreurCreation = 2;
  require_once("../views/pageLogin.php");
  exit();
}
echo "<h3>Votre compte à bien été créer. Vous pouvez vous connecter à cette page</h3>";
echo "<a href='../index.php'>Connection</a>";

?>
