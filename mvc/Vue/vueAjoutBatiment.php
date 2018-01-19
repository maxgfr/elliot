<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!--
  This view
-->
<!-- //////////////////////////////////////////////////////////// -->



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
    session_start();
    if(empty($_SESSION['email'])) {
    header("Location:vueConnexion.php");
    }
// Navigate through MVC root directory
$rootDirectory = dirname(__FILE__)."/../../mvc/";

// Implement the "Autoload" class to load automatically all classes.
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
    <title>Ajout bâtiment</title>
</head>


<?php include ('layouts/header.php'); ?>


      <div id="main">

        <h2>Ajouter un bâtiment</h2>
        <form id="BuildingAddingForm" method="post">
          <label for="name">Nom du bâtiment</label>
          <input class="text" id="name" type="text" name="name"/>
          <input class="text" id="address" type="text" name="address"/>
          <button id="buildingAdd" type="submit">Ajouter</button>

        </form>

    </div>


      <?php
          if (isset($_POST['name']) && isset($_POST['address'])) {
              $ctrl = new ControleurAuth('ajoutBat');
          }
      ?>


</body>
</html>
