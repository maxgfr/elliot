<?php
// Navigate through MVC root directory
$rootDirectory = dirname(__FILE__) . "/../../mvc/";

// Implement the "Autoload" class to load automatically all classes.
require_once($rootDirectory . 'Config/Autoload.php');
try {
    Autoload::load();
} catch (Exception $e) {
    require(Config::getVues()["default"]);
}

header("Content-Type: application/json; charset=UTF-8");

// Set the general query string to retrieve users' data from the database.
$variable = $_POST['data']['titre'];
$variable_1 = $_POST['data']['message'];

$sql_query = "SELECT last_name,first_name,roles,mail FROM users WHERE $variable=?";

// Execute the query
$query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, [$variable_1]);

// Check if the query complies to PHP.
echo json_encode($query);

?>
