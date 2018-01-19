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

$name = $_POST['head'];

$sql_query = "SELECT last_name,first_name,birthday,mail,address FROM users WHERE last_name=?;";

$query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, [$name]);

echo json_encode($query);
?>
