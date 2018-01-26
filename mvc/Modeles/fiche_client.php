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

$sql_query = "SELECT t1.last_name, t1.first_name, t1.birthday, t1.mail, t3.address
FROM users t1
LEFT JOIN accomodation t2 on t1.id_user = t2.id_user
LEFT JOIN building t3 on t2.id_building = t3.id_building WHERE last_name=?;";

$query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, [$name]);

echo json_encode($query);
?>
