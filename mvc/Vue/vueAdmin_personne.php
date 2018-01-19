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
    <title> Administration </title>
    <link href="../../css/admin.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/admin_personne.css" rel="stylesheet" type="text/css"/>
    <script src="../../js/jquery-3.2.1.min.js"></script>
    <script src="../../js/admin_personne.js"></script>
</head>
<?php include("layouts/header.php"); ?>
<body>
<div id="main">

    <form method="post">
        <fieldset>
            <legend>Recherchez un utilisateur</legend>
            <label for="type">Type :</label>
            <select name="type" id="type">
                <option value="last_name">Nom</option>
                <option value="first_name">Prénom</option>
                <option value="mail">Mail</option>
                <option value="0">Client</option>
                <option value="1">Admin</option>
            </select>
            <label for="input_search">Recherche :</label>
            <input name="input_search" id="input_search">
            <button type="button" id="search">Envoyer</button>
        </fieldset>
    </form>
    <div id="result">
        <table id="table_result">
            <thead>
            <tr>
                <th>
                    Nom
                </th>
                <th>
                    Prénom
                </th>
                <th>
                    Role
                </th>
                <th>
                    Mail
                </th>
            </tr>
            </thead>
        </table>

    </div>
    <button type="submit" name="send_button" id="send_button">Submit</button>
</div>
</body>
</html>
