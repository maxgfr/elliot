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

// Set the general query string to update users' status in the database.
$name = $_POST['name'];
$role = $_POST['role'];

$sql_query = "UPDATE users SET roles=? WHERE last_name=?;";

// Execute the query
$query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, [$role,$name]);

// Check if the query complies to PHP.
echo json_encode($query);

?>
