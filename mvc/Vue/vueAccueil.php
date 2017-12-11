<?php
<<<<<<< HEAD
  //Voir les erreurs
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  session_start();
  // Répertoire racine du MVC
  $rootDirectory = dirname(__FILE__)."/../../mvc/";
  // chargement de la classe Autoload pour autochargement des classes
  require_once($rootDirectory.'Config/Autoload.php');
  try {
      Autoload::load();
  } catch(Exception $e){
      require (Config::getVues()["default"]) ;
  }
=======
//Voir les erreurs
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
// Répertoire racine du MVC
$rootDirectory = dirname(__FILE__) . "/../../mvc/";
// chargement de la classe Autoload pour autochargement des classes
require_once($rootDirectory . 'Config/Autoload.php');
try {
    Autoload::load();
} catch (Exception $e) {
    require(Config::getVues()["default"]);
}
>>>>>>> fb088643bd4430f4621a97dc6ad51bcc03d93b2d
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

        <div id="table_capteur">
            <div id="img_bedroom">
                <img src="../../img/bedroomIcon.png" class="img_perso"/>
            </div>
            <div id="table_bedroom_div">
                <table id="Table_chambre" class="auto_top_margin">
                    <tr>
                        <th colspan="3">
                            Chambre
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Capteur
                        </td>
                        <td>
                            Température / luminosité
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <table id="Table_Salle" class="auto_top_margin">
            <tr>
                <th colspan="2">
                    Salle de bain
                </th>
            </tr>
            <tr>
                <td>
                    Capteur
                </td>
                <td>
                    Température / luminosité
                </td>
            </tr>
        </table>
        <table id="Table_Salon" class="auto_top_margin">
            <tr>
                <th colspan="2">
                    Salon
                </th>
            </tr>
            <tr>
                <td>
                    Capteur
                </td>
                <td>
                    Température / luminosité
                </td>
            </tr>
        </table>
        <table id="Table_Cuisine" class="auto_top_margin">
            <tr>
                <th colspan="2">
                    Cuisine
                </th>
            </tr>
            <tr>
                <td>
                    Capteur
                </td>
                <td>
                    Température / luminosité
                </td>
            </tr>
        </table>
    </div>
</div>

</body>

</html>