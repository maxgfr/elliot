<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!-- 
  This view displays a dashboard of sensors' data through time.
  The user may check the evolution of its parameters with graphs.
-->
<!-- //////////////////////////////////////////////////////////// -->



<?php
// Authorize errors to be displayed.
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
*
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
    <!-- Display the graphs. -->
    <div id="main">
        <canvas id="canvas_bar"></canvas>
        <canvas id="canvas_polar"></canvas>
        <canvas id="canvas_line"></canvas>
        <canvas id="canvas_pie"></canvas>
        <canvas id="canvas_doughnut"></canvas>
        <canvas id="canvas_boundary"></canvas>
    </div>

</body>
</html>
