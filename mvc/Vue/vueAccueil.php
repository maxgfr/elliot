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
                Température : 20°C
                Humditié : 45%
            </div>
        </div>
        <div id="Kitchen_div">
            <div class="iconPart" id="kitchen_icon">
                <img src="../../img/kitchenIcon.png"/>
            </div>
            <div class="tablePart">
            </div>
        </div>
        <div id="Bathroom_div">
            <div class="iconPart" id="bathroom_icon">
                <img src="../../img/showerIcon.png"/>
            </div>
            <div class="tablePart">
            </div>
        </div>
    </div>
</div>

</body>

</html>
