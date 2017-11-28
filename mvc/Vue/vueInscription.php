<?php
  // Répertoire racine du MVC
  $rootDirectory = dirname(__FILE__)."/../../mvc/";
  // chargement de la classe Autoload pour autochargement des classes
  require_once($rootDirectory.'Config\Autoload.php');
  try {
      Autoload::load();
  } catch(Exception $e){
      require (Config::getVues()["default"]) ;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../../js/animation.js"></script>
    <title>Test for the header</title>
  </head>

  <?php include ('layouts/header.php'); ?>

  <?php include ('layouts/iconBar.php'); ?>

  <body>

	<?php include ('layouts/sidebar.php'); ?>

      <div id="main">

        <h2>Créer un compte</h2>
        <form id="RegisterUserForm" method="post">
          <label for="last_name">Nom</label>
          <input class="text" id="last_name" type="text" name="last_name" value="" />
          <label for="first_name">Prénom</label>
          <input class="text" id="first_name" type="text" name="first_name" value="" />
          <label for="phone_number">Téléphone</label>
          <input class="text" id="phone_number" type="tel" name="phone_number" value="" />
          <label for="birthday">Date de naissance</label>
          <input class="text" id="birthday" type="text" name="birthday" value="" />
          <label for="mail">E-mail</label>
          <input class="text" id="mail" type="email" name="mail" value="" />
          <label for="password">Mot de passe</label>
          <input class="text" id="password" type="password" name="password" />
          <button id="registerNew" type="submit">Ajouter</button>
        </form>
      </div>


      <?php
          if (isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['phone_number']) && isset($_POST['birthday']) && isset($_POST['mail']) && isset($_POST['password']))  {
                  $ctrl = new ControleurVisitor('inscription');
          }
      ?>

  </body>

</html>
