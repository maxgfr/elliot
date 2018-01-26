<?php
    // Navigate through MVC root directory
    $rootDirectory = dirname(__FILE__)."/../../mvc/";

    // Implement the "Autoload" class to load automatically all classes.
    require_once($rootDirectory.'Config/Autoload.php');
    try {
      Autoload::load();
    } catch(Exception $e){
      require (Config::getVues()["default"]) ;
    }

    session_start();

    // Adapt the variable to an appropriate data understandable by PHP.
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST["x"], false);


    // Set the general query string to retrieve notifications from the database.
    $sql_query = "SELECT contenu FROM message WHERE id_user = ?;";

    // Execute the query
    $query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query,[$_SESSION['id_user']]);

    // Check if the query complies to PHP.
    echo json_encode($query);
    
?>
