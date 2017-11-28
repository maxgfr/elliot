<?php
  //Voir les erreurs
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  // Répertoire racine du MVC
  $rootDirectory = dirname(__FILE__)."/../../mvc/";
  // chargement de la classe Autoload pour autochargement des classes
  require_once($rootDirectory.'Config/Autoload.php');
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
    <link rel="stylesheet" href="../../css/login.css">
    <script src="../../js/animation.js"></script>
    <title>Test for the header</title>
  </head>

  <?php include ('layouts/header.php'); ?>

  <?php include ('layouts/iconBar.php'); ?>

  <body>

	<?php include ('layouts/sidebar.php'); ?>

    <div id="container_register">
        <div id="register_box" class="box">
            <div id="register_box_textandicon" class="box_textandicon">
                <div id="register_box_text">
                    <h2>INSCRIPTION</h2>
                </div>
                <div id="register_box_icon" class="iconImage">
                    <img src="../../img/login_icon.png" alt="Login Icon">
                </div>
            </div>
            <div id="register_box_input" class="inputText">
                <input class="text" id="last_name" type="text" name="last_name" value="" placeholder="Nom de famille"/>
                <input class="text" id="first_name" type="text" name="first_name" value="" placeholder="Prénom"/>
                <input class="text" id="phone_number" type="tel" name="phone_number" value="" placeholder="Téléphone"/>
                <input class="text" id="birthday" type="text" name="birthday" value="" placeholder="Date de naissance"/>
                <input class="text" id="mail" type="email" name="mail" value="" placeholder="Email"/>
                <input class="text" id="password" type="password" name="password" placeholder="Mot de passe"/>
            </div>
            <div id="register_box_register" class="confirmButton">
                <button type="button" name="button">S'enregistrer</button>
            </div>
        </div>
    </div>


      <?php
          if (isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['phone_number']) && isset($_POST['birthday']) && isset($_POST['mail']) && isset($_POST['password']))  {
                  $ctrl = new ControleurVisitor('inscription');
          }
      ?>

  </body>

</html>
