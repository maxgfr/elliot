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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Accueil.css">
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico"/>
    <script src="../../js/animation.js"></script>
    <script src="../../js/accueil.js">

    </script>
    <title>Accueil</title>
</head>

<?php include('./layouts/header.php'); ?>

<body>


<div id="main">

    <div class="showChange" style="width:100%; height:40px; background-color:#52D0A8;opacity:0.8; border-radius:10px">
        <div class="showChangeImage" style="border-radius:100%;margin-left:10px;margin-top:5px;width:30px; height:30px; background-color:#F8F8F8;text-align:center">
            <img src="../../img/checkIcon.png" alt="dashboardIcon" style="width:20px; height:20px; margin-top:5px;">
        </div>
        <div class="showChangeText" style="margin-left:10px;margin-top:10px; color:white;">
            Le capteur a été ajouté à la base de données.
        </div>
    </div>
    <div class="showChange" style="width:100%; height:40px; background-color:#D86677;opacity:0.8; border-radius:10px">
        <div class="showChangeImage" style="border-radius:100%;margin-left:10px;margin-top:5px;width:30px; height:30px; background-color:#F8F8F8; text-align:center">
            <img src="../../img/crossIcon.png" alt="dashboardIcon" style="width:20px; height:20px; margin-top:5px;">
        </div>
        <div class="showChangeText" style="margin-left:10px;margin-top:10px; color:white;">
            Le capteur a été supprimé de la base de données.
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

</div>

</body>

</html>
