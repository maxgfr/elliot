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
  session_start();
  if(empty($_SESSION['email'])) {
    header("Location:vueConnexion.php");
 }
?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../../css/dashboard.css">
      <script src="../../js/dashboard.js"></script>
      <title>Tableau de bord</title>
  </head>

  <?php include ('layouts/header.php'); ?>


  <body onload="draw()">


    <div id="main">
        <canvas id="canvas_bar"></canvas>
        <canvas id="canvas_polar"></canvas>
        <canvas id="canvas_line"></canvas>
        <canvas id="canvas_pie"></canvas>
        <canvas id="canvas_doughnut"></canvas>
        <canvas id="canvas_boundary"></canvas>
    </div>

      <!--?php
          if (isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['phone_number']) && isset($_POST['birthday']) && isset($_POST['mail']) && isset($_POST['password']))  {
              $ctrl = new ControleurVisitor('inscription');
          }
      ?-->

  </body>

</html>
