<?php
    // Répertoire racine du MVC
    $rootDirectory = dirname(__FILE__)."/../../mvc/";
    // chargement de la classe Autoload pour autochargement des classes
    require_once($rootDirectory.'Config/Autoload.php');
    try {
      Autoload::load();
    } catch(Exception $e){
      require (Config::getVues()["default"]) ;
    }
    session_start();

    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST["z"], false);

    $sql_query = "";
    $arrayForQuery = [];

    $roomsToDelete = $obj->deletedRooms;
    $countRoom = sizeof($roomsToDelete);
    $roomsToDelete = implode(',', $roomsToDelete);

    $sensorsToDelete = $obj->deletedSensors;
    $countSensor = sizeof($sensorsToDelete);
    $sensorsToDelete = implode(',', $sensorsToDelete);

    if ($countSensor > 0) {
        $sql_query .= "DELETE t1, t2 FROM datasensors AS t1
                       INNER JOIN sensors AS t2 ON t2.id_sensor = t1.id_sensor
                       WHERE t2.id_sensor IN (?);";

        array_push($arrayForQuery, $sensorsToDelete);
    }
    if ($countRoom > 0) {
        $sql_query .= "DELETE FROM room
                       WHERE id_room IN (?);";

        array_push($arrayForQuery, $roomsToDelete);
    }

    $query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, $arrayForQuery);

    echo json_encode($sensorsToDelete);
?>
