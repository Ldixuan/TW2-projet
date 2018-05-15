<?php
  /*
    Utilise le contenu de $_SESSION (en particulier $_SESSION['ident'])
  */
  if ( ! isset($_SESSION['evenement'])){  // si la page était protégée, on ne devrait même pas faire ce test
      require('../views/pageErreur.php');
      exit();
  }
  $evenement = $_SESSION['evenement'];
  //$avatarURL = "images/avatar_def.png";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Page à accès contrôlé</title>
    <link rel="stylesheet" type="text/css" href="style_authent.css" />
  </head>
<body>
<header>
<h1>

<?php
$p=count($evenement);
$i=-1;
while($i<$p){
echo ("{$evenement[$i]->titre} {$evenement[$i]->id} {$evenement[$i]->categorie}"); echo '<br>';
$i++;
}
?>
</h1>
</header>
<footer><a href="../views/logout.php">finir la recherche</a>
</footer>
</body>
</html>
