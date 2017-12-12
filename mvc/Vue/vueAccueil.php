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
            <div id="img_bedroom">
                <img src="../../img/bedroomIcon.png" class="img_perso"/>
            </div>
            <div id="table_bedroom_div">
            </div>
        </div>
        <div id="Kitchen_div">
            <div id="img_kitchen">
                <img src="../../img/kitchenIcon.png" class="img_perso"/>
            </div>
            <div id="table_kitchen_div">
            </div>
        </div>
        <div id="Bathroom_div">
            <div id="img_bathroom">
                <img src="../../img/showerIcon.png" class="img_perso"/>
            </div>
            <div id="table_bathroom_div">
            </div>
        </div>
    </div>
</div>

</body>

</html>