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
    <title>Accueil</title>
</head>

<?php include('./layouts/header.php'); ?>

<body>


<div id="main">
    <div>
        <div id="Bedroom_div">
            <div class="iconPart" id="bedroom_icon">
                <img src="../../img/bedroomIcon.png"/>
            </div>
            <div class="tablePart">
                <div class="tablePartCells tablePartCellsColorBlue" style="margin-left:5%">
                    <div class="tablePartCellsImage">
                        <img src="../../img/temperatureIcon.png" alt="Temperature Icon">
                    </div>
                    <div class="tablePartCellsText">
                        20°C
                    </div>
                </div>
                <div class="tablePartCells tablePartCellsColorBlue">
                    <div class="tablePartCellsImage">
                        <img src="../../img/luminosityIcon.png" alt="Luminosity Icon">
                    </div>
                    <div class="tablePartCellsText">
                        40%
                    </div>
                </div>
                <div class="tablePartCells tablePartCellsColorBlue" >
                    <div class="tablePartCellsImage">
                        <img src="../../img/humidityIcon.png" alt="Humidity Icon">
                    </div>
                    <div class="tablePartCellsText">
                        35%
                    </div>
                </div>
                <div class="tablePartCells tablePartCellsColorBlue">
                    <div class="tablePartCellsImage">
                        <img src="../../img/motionIcon.png" alt="Motion Icon">
                    </div>
                    <div class="tablePartCellsText" style="font-size:12px;margin-top:75%">
                        Présence : NON
                    </div>
                </div>
                <div class="tablePartCells tablePartCellsColorBlue">
                    <div class="tablePartCellsImage">
                        <img src="../../img/barometerIcon.png" alt="Motion Icon">
                    </div>
                    <div class="tablePartCellsText">
                        1013hPa
                    </div>
                </div>
            </div>
        </div>
        <div id="Kitchen_div">
            <div class="iconPart" id="kitchen_icon">
                <img src="../../img/kitchenIcon.png"/>
            </div>
            <div class="tablePart">
                <div class="tablePartCells tablePartCellsColorRed" style="margin-left:5%">
                    <div class="tablePartCellsImage">
                        <img src="../../img/humidityIcon.png" alt="Humidity Icon">
                    </div>
                    <div class="tablePartCellsText">
                        29%
                    </div>
                </div>
                <div class="tablePartCells tablePartCellsColorRed">
                    <div class="tablePartCellsImage">
                        <img src="../../img/luminosityIcon.png" alt="Luminosity Icon">
                    </div>
                    <div class="tablePartCellsText">
                        80%
                    </div>
                </div>
                <div class="tablePartCells tablePartCellsColorRed" >
                    <div class="tablePartCellsImage">
                        <img src="../../img/temperatureIcon.png" alt="Temperature Icon">
                    </div>
                    <div class="tablePartCellsText">
                        17°C
                    </div>
                </div>
            </div>
        </div>
        <div id="Bathroom_div">
            <div class="iconPart" id="bathroom_icon">
                <img src="../../img/showerIcon.png"/>
            </div>
            <div class="tablePart">
                <div class="tablePartCells tablePartCellsColorGreen" style="margin-left:5%">
                    <div class="tablePartCellsImage">
                        <img src="../../img/humidityIcon.png" alt="Humidity Icon">
                    </div>
                    <div class="tablePartCellsText">
                        80%
                    </div>
                </div>
                <div class="tablePartCells tablePartCellsColorGreen">
                    <div class="tablePartCellsImage">
                        <img src="../../img/luminosityIcon.png" alt="Luminosity Icon">
                    </div>
                    <div class="tablePartCellsText">
                        80%
                    </div>
                </div>
                <div class="tablePartCells tablePartCellsColorGreen">
                    <div class="tablePartCellsImage">
                        <img src="../../img/temperatureIcon.png" alt="Temperature Icon">
                    </div>
                    <div class="tablePartCellsText">
                        35°C
                    </div>
                </div>
                <div class="tablePartCells tablePartCellsColorGreen">
                    <div class="tablePartCellsImage">
                        <img src="../../img/barometerIcon.png" alt="Motion Icon">
                    </div>
                    <div class="tablePartCellsText">
                        1000hPa
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
