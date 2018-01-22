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

    // Set the general query string to retrieve sensor's parameters data from the database.
    $sql_query = "SELECT t1.name AS nameOfRoom, t1.id_room AS idOfRoom, t3.name AS nameOfFamilysensor, t4.value AS valueOfSensor, t2.id_sensor AS idOfSensor
                  /* It is important to rename the columns to avoid duplication */
                  FROM room t1
                  LEFT JOIN sensors t2 ON t2.id_room = t1.id_room
                  LEFT JOIN familysensor t3 ON t2.id_familysensor = t3.id_familysensor
                  LEFT JOIN datasensors t4 ON t2.id_sensor = t4.id_sensor
                  WHERE (t4.date_time = ? OR t4.date_time IS NULL) AND t1.id_accomodation = ?
                  ORDER BY t1.name";

    // Execute the query
    $query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, [date('Y-m-d'), $_SESSION['id_accomodation']]);

    // Check if the query complies to PHP.
    echo json_encode($query);
    
?>
