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
    $sql_query = "SELECT t1.date_time AS dateTimeArray, t1.value AS valueArray
                  FROM datasensors t1
                  LEFT JOIN sensors t2 ON t2.id_sensor = t1.id_sensor
                  LEFT JOIN familysensor t3 ON t2.id_familysensor = t3.id_familysensor
                  LEFT JOIN room t4 ON t4.id_room = t2.id_room
                  LEFT JOIN accomodation t5 ON t5.id_accomodation = t4.id_accomodation
                  LEFT JOIN users t6 ON t6.id_user = ?
                  WHERE t4.name = ? AND t3.name = ? AND date_time LIKE ?";

    // Execute the query
    $query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query,[$_SESSION['id_user'], 'kitchen', 'humidity', '2017-%-01']);

    // Check if the query complies to PHP.
    echo json_encode($query);

?>
