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

    $sql_query = "SELECT t1.date_time AS dateTimeArray, t1.value AS valueArray
                  FROM datasensors t1
                  LEFT JOIN sensors t2 ON t2.id_sensor = t1.id_sensor
                  LEFT JOIN familysensor t3 ON t2.id_familysensor = t3.id_familysensor
                  LEFT JOIN room t4 ON t4.id_room = t2.id_room
                  WHERE t4.name = ? AND t3.name = ? AND date_time LIKE ?";

    $query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query,['kitchen', 'humidity', '2017-%-01']);

    echo json_encode($query);
?>
