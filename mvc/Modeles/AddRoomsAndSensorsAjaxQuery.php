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
    $obj = json_decode($_POST["y"], false);

    $existentRoom = $obj->arrayForExistentRoom;
    $createdRoom = $obj->arrayForCreatedRoom;
    //the part above works perfectly

    $lengthOfExistentRoom = sizeof($existentRoom);
    $lengthOfCreatedRoom = sizeof($createdRoom);

    $sql_query = "";
    $arrayForQuery = [];

    for ($i=0; $i < $lengthOfExistentRoom; $i++) {
        $sensorToAdd = $existentRoom[$i];
        $name = $sensorToAdd->name;
        $familySensor = $sensorToAdd->familysensor;
        $idRoom = $sensorToAdd->id_room;
        $dataOfSensor = $sensorToAdd->data;

        $sql_query .= "INSERT INTO sensors(id_sensor, name, state, id_familysensor, id_user, id_room)
                       SELECT MAX(id_sensor)+1, ?, 1, (SELECT id_familysensor FROM familysensor WHERE name = ?), ?, ? FROM sensors;

                       INSERT INTO datasensors(id_datasensor, date_time, value, id_sensor)
                       SELECT MAX(id_datasensor)+1, ?, ?, (SELECT MAX(id_sensor) FROM sensors) FROM datasensors;";

        array_push($arrayForQuery, $name, $familySensor, $_SESSION['id_user'], $idRoom, date('Y-m-d'), $dataOfSensor);
    }

    for ($i=0; $i < $lengthOfCreatedRoom; $i++) {
        $roomToAdd = $createdRoom[$i][0];
        $lengthOfSensorsInRoom = sizeof($createdRoom[$i]);

        $sql_query .= "INSERT INTO room(id_room, name, id_accomodation)
                       SELECT MAX(id_room)+1, ?, ? FROM room;";

        array_push($arrayForQuery, $roomToAdd, $_SESSION['id_accomodation']);

        for ($j=1; $j < $lengthOfSensorsInRoom; $j++) {
            $sensorToAdd = $createdRoom[$i][$j];
            $name = $sensorToAdd->name;
            $familySensor = $sensorToAdd->familysensor;
            $dataOfSensor = $sensorToAdd->data;

            $sql_query .= "INSERT INTO sensors(id_sensor, name, state, id_familysensor, id_user, id_room)
                           SELECT MAX(id_sensor)+1, ?, 1, (SELECT id_familysensor FROM familysensor WHERE name = ?), ?,
                           (SELECT MAX(id_room) FROM room) FROM sensors;

                           INSERT INTO datasensors(id_datasensor, date_time, value, id_sensor)
                           SELECT MAX(id_datasensor)+1, ?, ?, (SELECT MAX(id_sensor) FROM sensors) FROM datasensors;";

           array_push($arrayForQuery, $name, $familySensor, $_SESSION['id_user'], date('Y-m-d'), $dataOfSensor);
        }

    }

    /*$sql_query = "CREATE PROCEDURE P()
                  BEGIN
                      DECLARE index INT DEFAULT 0;
                      for_loop_label: LOOP
                          IF index < $lengthOfExistentRoom THEN
                              INSERT INTO sensors(id_sensor, name, state, id_familysensor, id_user, id_room)
                              SELECT MAX(id_sensor)+1,
                              $existentRoom[index][:familyOfSensor],
                              1,
                              (SELECT id_familysensor FROM familysensor WHERE name = $existentRoom[index][:familyOfSensor]),
                              :idOfUser,
                              $existentRoom[index][:idOfRoom]
                              FROM sensors
                              SET index = index + 1;
                          ITERATE for_loop_label;
                          END IF;
                          LEAVE for_loop_label;
                      END LOOP
                  END";

    $arrayForQuery = array("nameOfSensor" => "name",
                           "familyOfSensor" => "familysensor",
                           "idOfUser" => $_SESSION["id_user"],
                           "idOfRoom" => "id_room");*/

    $query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, $arrayForQuery);

    echo json_encode($query);
?>
