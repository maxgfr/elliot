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
session_start();
if (empty($_SESSION['email'])) {
    header("Location:vueConnexion.php");
}
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title> Administrateur </title>
    <link href="../../css/notification.css" rel="stylesheet" type="text/css"/>
    <script src="../../js/jquery-3.2.1.min.js"></script>
    <script src="../../js/Admin.js"></script>

</head>

<?php include("layouts/header.php");

$sql_query = "SELECT t1.id_user, t1.first_name, t1.last_name, t1.mail, t2.address, t4.contenu
              FROM users t1
              LEFT JOIN accomodation t3 ON t3.id_user = t1.id_user
              LEFT JOIN building t2 ON t2.id_building = t3.id_building
              LEFT JOIN message t4 ON t4.id_user = t1.id_user
              WHERE t4.date IS NULL OR t4.date = (SELECT MAX(t5.date) AS max_date FROM message t5 WHERE t4.id_user = t5.id_user)
              ORDER BY t1.last_name";

// Execute the query
$query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, array());
?>

<body>
    <style>
    #container_user {
        background-image: linear-gradient(rgb(46,50,62), rgb(66,70,82));
        width: 85%;
        height:auto;
        padding: 2%;
        font-family: sans-serif;
        border-radius: 2px;
        margin-left: 5%;
        margin-top: 1%;
        color: white;
        display: flex;
    }
    </style>

<div id="main">
    <div id="container_user">
        <table id="table">
            <tr>
                <th>ID Client</th>
                <th>Nom Prénom</th>
                <th>Adresse mail</th>
                <th>Adresse du domicile</th>
                <th>Dernière notification</th>
            </tr>
            <?php
            for ($i = 0; $i < count($query); $i++) {
                echo "<tr id=$i onclick='fiche_client(". json_encode($query[$i]["last_name"]). ")'>
                            <td>".$query[$i]['id_user']."</td>
                            <td id='client_$i'>" . $query[$i]["last_name"]. " " .$query[$i]["first_name"]."</td>
                            <td>".$query[$i]["mail"]."</td>
                            <td>".$query[$i]["address"]."</td>
                            <td>".$query[$i]["contenu"]."</td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
