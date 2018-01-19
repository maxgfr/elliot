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
    $obj = json_decode($_POST["x"], false);

    $sql_query = "SELECT *, t2.name, t3.name FROM users t1
                  LEFT JOIN accomodation t2 ON t1.id_user = t2.id_user
                  LEFT JOIN building t3 ON t2.id_building = t3.id_building

                  ";

    $query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, array());

    echo json_encode($query);
?>
