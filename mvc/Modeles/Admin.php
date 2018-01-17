<?php
// Répertoire racine du MVC
$rootDirectory = dirname(__FILE__) . "/../../mvc/";
// chargement de la classe Autoload pour autochargement des classes
require_once($rootDirectory . 'Config/Autoload.php');
try {
    Autoload::load();
} catch (Exception $e) {
    require(Config::getVues()["default"]);
}

header("Content-Type: application/json; charset=UTF-8");

$variable = $_POST['data']['titre'];

$variable_1 = $_POST['data']['message'];

$sql_query = "SELECT last_name,first_name,roles,mail FROM users WHERE $variable=?";

$query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, [$variable_1]);

echo json_encode($query);
?>