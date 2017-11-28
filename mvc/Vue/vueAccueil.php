<?php
  // Répertoire racine du MVC
  $rootDirectory = dirname(__FILE__)."/../../mvc/";
  // chargement de la classe Autoload pour autochargement des classes
  require_once($rootDirectory.'Config\Autoload.php');
  try {
      Autoload::load();
  } catch(Exception $e) {
      require (Config::getVues()["default"]) ;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../../js/animation.js"></script>
    <title>Test for the header</title>
  </head>

  <?php include ('layouts/header.php'); ?>

  <?php include ('layouts/iconBar.php'); ?>

  <body>

	<?php include ('layouts/sidebar.php'); ?>

      <div id="main">

          <img style="width:95%;" src="../../img/internet_of_things.png" alt="Dashboard example">
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
          <p>SOMETHING COOL WILL HAPPEN NEXT</p>
      </div>

  </body>

</html>
