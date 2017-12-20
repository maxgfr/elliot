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

    <label for="creating_room">Créer une pièce</label>
    <select name="creating_room" id="create_the_room">
        <option value="bedroom">Chambre</option>
        <option value="kitchen">Cuisine</option>
        <option value="bathroom">Salle de bain</option>
        <option value="livingroom">Salon</option>
        <option value="diningroom">Salle à manger</option>
    </select>
    <button type="button" name="button" onclick="setCreatingRoom()">Créer la pièce</button>

    <br><br>

    <label for="selection_room">Choisir une pièce</label>
    <select name="selection_room" id="select_the_room">

    </select>

    <label for="selection_sensor">Choisir un capteur</label>
    <select name="selection_sensor" id="select_the_sensor">
        <option value="temperature">Température</option>
        <option value="luminosity">Luminosité</option>
        <option value="motion">Présence</option>
        <option value="humidity">Humidité</option>
        <option value="barometer">Baromètre</option>
    </select>

    <button type="button" name="button" onclick="setSensor()">Ajouter le capteur</button>

    <br><br>

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
