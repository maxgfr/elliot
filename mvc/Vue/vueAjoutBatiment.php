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
  session_start();
  if(empty($_SESSION['email'])) {
    header("Location:vueConnexion.php");
 }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico" />
    <script src="../../js/animation.js"></script>
    <title>Ajout bâtiments</title>
  </head>

  <?php include ('layouts/header.php'); ?>


  <body>


      <div id="main">

        <h2>Ajouter un bâtiment</h2>
        <form id="BuildingAddingForm" method="post">
          <label for="building_name">Nom du bâtiment</label>
          <input class="text" id="last_name" type="text" name="building_name" value="" />
          <label for="street_number">Numéro</label>
          <input class="text" id="street_number" type="smallint" name="street_number" value="" />
          <label for="street_name">Nom de la rue</label>
          <input class="text" id="street_name" type="text" name="street_name" value="" />
          <label for="postal_code">Code postal</label>
          <input class="text" id="postal_code" type="mediumint" name="postal_code" value="" />
          <button id="buildingAdd" type="submit">Ajouter</button>
        </form>
      </div>


      <?php
          if (isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['phone_number']) && isset($_POST['birthday']) && isset($_POST['mail']) && isset($_POST['password'])) {
                  $ctrl = new ControleurVisitor('inscription');
          }
      ?>

  </body>

</html>
