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

    <div class="navigationSensor" style="display: none">
        <nav>
            <li id="database_barometer">Baromètre</li>
            <li id="database_humidity">Humidité</li>
            <li id="database_luminosity">Luminosité</li>
            <li id="database_motion">Présence</li>
            <li id="database_temperature">Température</li>
        </nav>
    </div>

    <div class="navigationRoom" style="display: none">
        <nav>
            <li id="database_bedroom">Chambre</li>
            <li id="database_kitchen">Cuisine</li>
            <li id="database_diningroom">Salle à manger</li>
            <li id="database_bathroom">Salle de bain</li>
            <li id="database_livingroom">Salon</li>
        </nav>
    </div>

    <div class="showChange">
        <div id="information_delete">
            <div class="showChangeImage">
                <img src="../../img/informationIcon.png" alt="information icon">
            </div>
            <div class="showChangeText" >
                Cliquez sur les icônes pour sélectionner les éléments que vous voulez supprimer.
            </div>
        </div>
        <div id="success">
            <div class="showChangeImage">
                <img src="../../img/checkIcon.png" alt="success icon">
            </div>
            <div class="showChangeText" >
                Le capteur a été ajouté à la base de données.
            </div>
        </div>
        <div id="failure">
            <div class="showChangeImage">
                <img src="../../img/crossIcon.png" alt="failure icon">
            </div>
            <div class="showChangeText">
                Une erreur est survenue : le capteur n'a pas pu être supprimé de la base de données.
            </div>
        </div>
    </div>

    <div id="main_home" style="margin-top:0.8em;">
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


    <div id="add_delete_cancel" style="padding-bottom:1em;">
        <button id="add_sensor_room" type="button" name="button" style="margin-left:0">
            Ajouter des capteurs et des pièces
        </button>
        <button id="delete_sensor_room" type="button" name="button" style="margin-left:2%">
            Supprimer des capteurs et des pièces
        </button>
        <button id="cancel_modifications" type="button" name="button" style="margin-left:2%; display:none;">
            Annuler les modifications
        </button>
    </div>

    <script>
        document.getElementById('add_sensor_room').addEventListener('click', _funcAddSensorRoom);
        document.getElementById('delete_sensor_room').addEventListener('click', _funcDeleteSensorRoom);
        document.getElementById('cancel_modifications').addEventListener('click', _funcCancelModifications);
    </script>

    <script>
        /******************************AJAX AND JSON PART*******************************/

        var dbParam, xmlhttp, myObj, x = "";
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText);
                for (x in myObj) {
                    addRoom(false, myObj[x].nameOfRoom, myObj[x].idOfRoom);
                    var idRoom = myObj[x].nameOfRoom + '_' + myObj[x].idOfRoom;
                    setTablePart(idRoom, myObj[x].idOfSensor, myObj[x].nameOfFamilysensor, myObj[x].valueOfSensor);
                }
            }
        };
        xmlhttp.open("POST", "../Modeles/AccueilAjaxQuery.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("x=" + dbParam);

        /*******************************************************************************/
    </script>


</div>

</body>

</html>
