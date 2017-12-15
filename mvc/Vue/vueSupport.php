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
    <title> Support </title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="../../css/Support.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico" />
    <script src="../../js/animation.js"></script>


</head>

  <?php include("layouts/header.php"); ?>

<body>

    <div id="main">
        <a href="vueTicket.php"><img src="../../img/ticket_support.png" alt="image du ticket support"></a>
        <a href="vueFAQ.php"><img src="../../img/FAQ.png" alt="image du FAQ"></a>
    </div>
</body>
</html>
