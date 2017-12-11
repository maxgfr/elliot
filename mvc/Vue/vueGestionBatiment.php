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
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../../js/animation.js"></script>
    <title>Gestion bâtiments</title>
  </head>

  <?php include ('layouts/header.php'); ?>


  <body>


      <div id="main">

        <h2>Gérer les bâtiments</h2>
        <form id="BuildingAddingForm" method="post">
          <label for="building_name">Nom du bâtiment</label>
          <input class="text" id="last_name" type="text" name="building_name" value="" />
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
