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

    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST["x"], false);

    $sql_query = "SELECT room.name AS nameOfRoom, room.id_room AS idOfRoom, familysensor.name AS nameOfFamilysensor, datasensors.value AS valueOfSensor, sensors.id_sensor AS idOfSensor
                  /* It is important to rename the columns to avoid duplication */
                  FROM (((sensors
                  INNER JOIN familysensor ON sensors.id_familysensor = familysensor.id_familysensor)
                  INNER JOIN room ON sensors.id_room = room.id_room)
                  INNER JOIN datasensors ON sensors.id_sensor = datasensors.id_sensor)
                  WHERE id_user=2
                  ORDER BY room.name";

    $query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query,array());

    echo json_encode($query);
?>
