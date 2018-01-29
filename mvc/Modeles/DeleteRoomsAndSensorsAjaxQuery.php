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
    $obj = json_decode($_POST["z"], false);


    // Set the general query string to remove sensor's parameters data from the database.
    $sql_query = "";

    $roomsToDelete = $obj->deletedRooms;
    $countRoom = sizeof($roomsToDelete);
    $roomsToDelete = implode(',', $roomsToDelete);

    $sensorsToDelete = $obj->deletedSensors;
    $countSensor = sizeof($sensorsToDelete);
    $sensorsToDelete = implode(',', $sensorsToDelete);

    if ($countSensor > 0) {
        $sql_query .= "DELETE t1, t2 FROM datasensors AS t1
                       INNER JOIN sensors AS t2 ON t2.id_sensor = t1.id_sensor
                       WHERE t2.id_sensor IN ($sensorsToDelete);";

    }
    if ($countRoom > 0) {
        $sql_query .= "DELETE FROM room
                       WHERE id_room IN ($roomsToDelete);";

    }

    // Execute the query
    $query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, array());

    // Check if the query complies to PHP.
    echo json_encode($sensorsToDelete);

?>
