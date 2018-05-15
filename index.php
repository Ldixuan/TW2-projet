<?php
spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });
 if (isset($_SESSION['ident'])){
     $personne = $_SESSION['ident'];
 }

require('views/pageLogin.php');

?>
