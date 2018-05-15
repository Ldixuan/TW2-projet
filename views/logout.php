<?php
set_include_path('..');
spl_autoload_register(function ($className){
  include("lib/{$className}.class.php");
});


require_once('services/getFindevenement.php');
unset($_SESSION['ident']);
session_destroy();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Deconnect</title>
</head>
<body>
  <p><a href="../index.php">Retourner a la recherche des evenements</a></p>
</body>
</html>
