<?php
 require_once('common_service.php');
 session_name('s8_bogaert');
 session_start();

 if (isset($_SESSION['ident']))
  return;

 produceError('non authentifié');
 exit();
?>
