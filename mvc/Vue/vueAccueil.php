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

    <label for="selection_room">Choisir une pièce</label>
    <select name="selection_room" id="select_the_room">
        <option value="bedroom">CHAMBRE</option>
        <option value="kitchen">CUISINE</option>
        <option value="bathroom">SALLE DE BAIN</option>
        <option value="winecellar">CAVE A VIN</option>
        <option value="livingroom">SALON</option>
    </select>

    <label for="selection_sensor">Choisir un capteur</label>
    <select name="selection_sensor" id="select_the_sensor">
        <option value="temperature">TEMPERATURE</option>
        <option value="luminosity">LUMINOSITE</option>
        <option value="motion">PRESENCE</option>
        <option value="humidity">HUMIDITE</option>
        <option value="barometer">BAROMETRE</option>
    </select>

    <button type="button" name="button" onclick="setNamesOfRoomAndSensor()">Ajouter le capteur</button>

    <div class="bedroom parent">
        <div class="iconPart listOfSensorsColorBlue">
            <div class="iconPartImage">
                <img src="../../img/bedroomIcon.png"/>
            </div>
            <div class="iconPartText">
                CHAMBRE PARENT
            </div>
        </div>
        <div class="tablePart">

        </div>
    </div>

    <div class="kitchen">
        <div class="iconPart listOfSensorsColorRed">
            <div class="iconPartImage">
                <img src="../../img/kitchenIcon.png"/>
            </div>
            <div class="iconPartText">
                CUISINE
            </div>
        </div>
        <div class="tablePart">

        </div>
    </div>

    <div class="bathroom">
        <div class="iconPart listOfSensorsColorGreen">
            <div class="iconPartImage">
                <img src="../../img/bathroomIcon.png"/>
            </div>
            <div class="iconPartText">
                SALLE DE BAIN
            </div>
        </div>
        <div class="tablePart">

        </div>
    </div>

    <div class="livingroom">
        <div class="iconPart listOfSensorsColorOrange">
            <div class="iconPartImage">
                <img src="../../img/livingroomIcon.png"/>
            </div>
            <div class="iconPartText">
                SALON
            </div>
        </div>
        <div class="tablePart">

        </div>
    </div>

    <div class="bedroom Serge">
        <div class="iconPart listOfSensorsColorBrown">
            <div class="iconPartImage">
                <img src="../../img/bedroomIcon.png"/>
            </div>
            <div class="iconPartText">
                CHAMBRE SERGE
            </div>
        </div>
        <div class="tablePart">

        </div>
    </div>

    <div class="winecellar">
        <div class="iconPart listOfSensorsColorDarkGrey">
            <div class="iconPartImage">
                <img src="../../img/winecellarIcon.png"/>
            </div>
            <div class="iconPartText">
                CAVE A VIN
            </div>
        </div>
        <div class="tablePart">

        </div>
    </div>



                    <div id="sensorElements" style="display:none">

                        <div id="sensorElementsTemperature">
                            <div class="tablePartCells listOfSensorsColor">
                                <div class="tablePartCellsImage">
                                    <img src="../../img/temperatureIcon.png" alt="Temperature Icon">
                                </div>
                                <div class="tablePartCellsText">
                                    Température 20°C
                                </div>
                            </div>
                        </div>

                        <div id="sensorElementsLuminosity">
                            <div class="tablePartCells listOfSensorsColor">
                                <div class="tablePartCellsImage">
                                    <img src="../../img/luminosityIcon.png" alt="Luminosity Icon">
                                </div>
                                <div class="tablePartCellsText">
                                    Luminosité 40%
                                </div>
                            </div>
                        </div>

                        <div id="sensorElementsHumidity">
                            <div class="tablePartCells listOfSensorsColor" >
                                <div class="tablePartCellsImage">
                                    <img src="../../img/humidityIcon.png" alt="Humidity Icon">
                                </div>
                                <div class="tablePartCellsText">
                                    Humidité 35%
                                </div>
                            </div>
                        </div>

                        <div id="sensorElementsMotion">
                            <div class="tablePartCells listOfSensorsColor">
                                <div class="tablePartCellsImage">
                                    <img src="../../img/motionIcon.png" alt="Motion Icon">
                                </div>
                                <div class="tablePartCellsText">
                                    Présence NON
                                </div>
                            </div>
                        </div>

                        <div id="sensorElementsBarometer">
                            <div class="tablePartCells listOfSensorsColor">
                                <div class="tablePartCellsImage">
                                    <img src="../../img/barometerIcon.png" alt="Motion Icon">
                                </div>
                                <div class="tablePartCellsText">
                                    Pression atm 1013hPa
                                </div>
                            </div>
                        </div>

                    </div>

</div>

</body>

</html>
