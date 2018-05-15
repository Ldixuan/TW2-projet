<?php
if (isset($_SESSION['echec']))
  echo "<p class='message'>error</p>";
if (isset($_SESSION['ident'])) // l'utilisateur est authentifié
  $dataPersonne = 'data-personne="'.htmlentities(json_encode($_SESSION['ident'])).'"';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Authentifiez-vous</title>
    <script src="js/gestion_log.js"></script>
    <script src="js/fetchUtils.js"></script>
    <script src="js/utils.js"></script>
</head>
<?php
echo "<body $dataPersonne>";
?>
  <section id="gestion_log">
    <div id="div_login" class="deconnecte">
      <form method="POST" action="services/login.php" id="form_login">
        <fieldset>
          <label for="login">Login :</label>
          <input type="text" name="login" id="login" required="required" autofocus/>
          <label for="password">Mot de passe :</label>
          <input type="password" name="password" id="password" required="required" />
          <button type="submit" name="valid">OK</button>
          <output for="login password" name="message"></output>
        </fieldset>
      </form>
    </div>
    <div id="div_inscrire" class="deconnecte" style="display: none;" hidden="">
      <form method="POST" action="services/createUser.php" id="form_inscrire">
        <p>Pas encore inscrit ?</p>
        <fieldset>
          <legend>Créer un compte</legend>
          <input placeholder="Login : 20 caractères max. Lettre chiffres ou _" maxlength="20" name="login" id="create_user" required="" type="text"><br>
          <input placeholder="Votre mot de passe" name="password" id="create_user_password" required="required" type="password"><br>
          <output for="login password" name="message"></output>
        </fieldset>
        <button type="submit" name="valid">Envoyer</button><br>
      </form>
    </div>
    <div id="info_profil" class="connecte">
      <span id="info_login">
      </span>
      <button id="button_logout" action="services/logout.php" class="connecte">se déconnecter</button>
    </div>
  </section>

  <div id="findEvenement">
    <legend>choisissez un evenement </legend>
    <form method="POST" action="services/findEvenement.php">
      <fieldset>
        <input placeholder="Category d'événement" maxlength="50" type="text" name="category" id="categorie" required="required" autofocus/>
        <br/>
        <input placeholder="Description d'événement" maxlength="300" type="text" name="key" id="key" required="required" autofocus/>
        <br/>
        <input name="date" type="date" id="find_date" placeholder="depuis date : YYYY-MM-DD hh:mm:ss" required="" pattern="^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" ><br>
        <br/>
        <button type="submit" name="valid">OK</button>
      </fieldset>
    </form>
  </div>

  <section id="menu" class="connecte">
    <a id="event_recent" class="nav_750">Evenements récents</a>
    <a id="modif_profil" class="nav_750">Modifier votre profil</a>
    <a id="create_event" class="nav_750">Créer un événement</a>
    <a id="manage_abonnement" class="nav_750">Gérer vos abonnements</a>
    <a id="consult_my_events" class="nav_750">Consulter vos événements</a>
  <section>
  <section id="create_event" class="connecte">
    <legend>Créer un evenement </legend>
    <form method="POST" action="services/createEvenement.php">
      <fieldset>
        <input placeholder="Titre" maxlength="50" type="text" name="create_titre" id="create_titre" required="required" autofocus/>
        <br/>
        <input placeholder="Description d'événement" maxlength="300" type="id" name="create_description" id="create_description" required="required" autofocus/>
        <br/>
        <select name="create_category" id="create_category">
          <option value="sport">Sport</option>
          <option value="loisir">Loisir</option>
          <option value="culture">Culture</option>
          <option value="sortir">Sortir</option>
        </select>
        <br/>
        <input name="create_ou" type="text" id="create_ou" placeholder="Lieu" required=""><br>
        <br/>
        <input name="create_date" type="date" id="find_date" placeholder="depuis date : YYYY-MM-DD hh:mm:ss" required="" pattern="^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" type="text"><br>
        <br/>
        <button type="submit" name="valid">OK</button>
        <output for="create_titre create_description create_category create_ou create_date" name="message"></output>
      </fieldset>
    </form>
  </section>


</body>
</html>

<?php
?>
