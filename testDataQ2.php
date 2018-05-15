<?php
/*
 Script de test de la question 2
 */

header('Content-type: text/plain;charset=utf-8');

require_once("db_parms.php");
require_once("DataLayer.class.php");
$data = new DataLayer();
var_dump ($data->createEvenement(youva,yyy,idd,iddd,idddd,idddcdddfqfqd,oooo,pppp,mmmmm));
?>
