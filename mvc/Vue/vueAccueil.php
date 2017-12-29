<?php
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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/Accueil.css">
    <script src="../../js/accueil.js"></script>
    <title>Accueil</title>
</head>

<?php include('./layouts/header.php'); ?>

<body>


<div id="main">

    <div class="showChange" id="success" style="display: none">
        <div class="showChangeImage">
            <img src="../../img/checkIcon.png" alt="dashboardIcon">
        </div>
        <div class="showChangeText" >
            <!--Le capteur a été ajouté à la base de données.-->
        </div>
    </div>
    <div class="showChange" id="failure" style="display: none">
        <div class="showChangeImage">
            <img src="../../img/crossIcon.png" alt="dashboardIcon">
        </div>
        <div class="showChangeText">
            <!--Une erreur est survenue : le capteur n'a pas pu être supprimé de la base de données.-->
        </div>
    </div>

    <div class="room" style="display:none;">
        <div class="iconPart">
            <div class="iconPartImage">
                <img src="../../img/roomIcon.png"/>
            </div>
            <div class="iconPartText">
                name_of_room
            </div>
        </div>
        <div class="tablePart">
            <div id="sensor_elements_type_of_sensor" style="display:none">
                <div class="tablePartCells">
                    <div class="tablePartCellsImage">
                        <img src="../../img/type_of_sensorIcon.png" alt="type_of_sensor icon">
                    </div>
                    <div class="tablePartCellsText">
                        type_of_sensor value_of_sensor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add_delete_cancel">
        <button id="add_sensor_room" onclick="add_sensor_room()" type="button" name="button" style="margin-left:0">
            Ajouter des capteurs et des pièces
        </button>
        <button id="delete_sensor_room" onclick="delete_sensor_room()" type="button" name="button" style="margin-left:2%">
            Supprimer des capteurs et des pièces
        </button>
        <button id="cancel_modifications" onclick="cancel_modifications()" type="button" name="button" style="margin-left:2%; display:none;">
            Annuler les modifications
        </button>
    </div>

    <?php


    ?>

</div>

</body>

</html>
