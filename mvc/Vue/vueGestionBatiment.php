<?php
  //Voir les erreurs
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  // Répertoire racine du MVC
  $rootDirectory = dirname(__FILE__)."/../../mvc/";
  // chargement de la classe Autoload pour autochargement des classes
  require_once($rootDirectory.'Config/Autoload.php');
  try {
      Autoload::load();
  } catch(Exception $e){
      require (Config::getVues()["default"]) ;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico"/>
    <script src="../../js/animation.js"></script>
    <title>Tableau de bord</title>
  </head>

  <?php include ('layouts/header.php'); ?>


  <body>


      <div id="main">

          <?php
          /*$query_familysensor = createQuery("SELECT * FROM familysensor", array());
          for ($i=0; $i <count($query_familysensor) ; $i++) {
              print_r($query_familysensor[$i]);
              echo '<br>';
              foreach($query_familysensor[$i] as $key => $element) {
                  $array_familysensor = array();
                  if ($key == 'id_familysensor') { //Selecting only the id_familysensor from all the tables from familysensor
                      $array_familysensor[]=$element; //Put all the values of id_familysensor inside an array
                      print_r($array_familysensor);
                      echo '<br>';
                      foreach ($array_familysensor as $value_of_id_familysensor) {
                          if ($value_of_id_familysensor==1) {
                              $query_sensor = createQuery("SELECT * FROM sensors WHERE id_familysensor=$value_of_id_familysensor", array());
                              print_r($query_sensor);
                              echo '<br>';
                              foreach ($query_sensor[0] as $key_sensor => $value_of_id_sensor) {
                                  if ($key_sensor=='id_sensor') {
                                      $query_datasensors = createQuery("SELECT * FROM datasensors WHERE id_sensor=$value_of_id_sensor", array());
                                      print_r($query_datasensors);
                                      echo '<br>';
                                      foreach ($query_datasensors[0] as $key_value => $value) {
                                          if ($key_value=='value') {
                                              echo 'La valeur du sensor dans la database est '. $value;
                                              echo '<br>';
                                          }
                                      }
                                  }
                              }
                          }
                      }
                  }
              }
          }*/

          $query_familysensor = createQuery('SELECT name FROM familysensor', array());
          print_r($query_familysensor);

          ?>

        <h2>Gérer les bâtiments</h2>
        <form id="BuildingAddingForm" method="post">
          <label for="building_name">Nom du bâtiment</label>
          <input class="text" id="last_name" type="text" name="building_name" value="" />
          <button id="registerNew" type="submit">Ajouter</button>
        </form>
      </div>

      <?php
          if (isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['phone_number']) && isset($_POST['birthday']) && isset($_POST['mail']) && isset($_POST['password']))  {
              $ctrl = new ControleurVisitor('inscription');
          }
      ?>

  </body>

</html>
