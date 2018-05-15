<?php
require('../lib/common_service.php');

if( isset($_SESSION['ident'])){
	$_SESSION['echec'] = True;
	produceError('already logged in');
	return ;
}


session_name("s8_bogaert");
session_start();

require('../lib/ArgSetAuthent.class.php');
$argSet = new ArgSetAuthent();
require('../lib/initDataLayer.php');

if( $argSet->isValid() ){
	$temp = $data->authentifier($argSet->login, $argSet->password);
	if ($temp){
		unset($_SESSION['echec']);
		$_SESSION['ident'] = $temp;
		produceResult($temp);
		return;
		}
	else{
		$_SESSION['echec'] = True;
		produceError('mauvais arguments');
		return;
		}
	}

produceError('argset non valides');
exit();

?>
