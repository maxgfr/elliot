<?php
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
    <div id="table_capteur">
        <table id="Table_capteur_table">
            <tr>
                <th>
                    Salle
                </th>
                <th>
                    Etat
                </th>
            </tr>
            <tr>
                <td>
                    Chambre
                </td>
                <td>
                    Température / luminosité
                </td>
            </tr>
            <tr>
                <td>
                    Salle de bain
                </td>
                <td>
                    Température / luminosité
                </td>
            </tr>
            <tr>
                <td>
                    Salon
                </td>
                <td>
                    Température / luminosité
                </td>
            </tr>
            <tr>
                <td>
                    Cuisine
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


<script>
    var list_room = ["Chambre", "Salle de bain", "Salon", "Cuisine"]
</script>