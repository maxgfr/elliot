
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
<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!--
  This view
-->
<!-- //////////////////////////////////////////////////////////// -->





<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/login.css">
    <title>Ajout bâtiment</title>
</head>


<?php include ('layouts/header.php'); ?>


      <div id="main">
          <div id="container_login" style="background-image:linear-gradient(rgb(46,50,62), rgb(66,70,82))">
            <div id="login_box" class="box">
                <div id="login_box_textandicon" class="box_textandicon">
                    <div id="login_box_text">
                        <h2 align="center">Ajouter un bâtiment</h2>
                    </div>
                    <div id="login_box_icon" class="iconImage">
                        <img src="../../img/buildingicon.png" style="width:60px;margin-top:10px" alt="building icon">
                    </div>
                </div>
                <!-- Set the login request. -->
                <div id="login_box_input" class="inputText">
                    <form method="post">
                        <input class="text" id="name" type="text" name="name" placeholder="Nom du bâtiment"/>
                        <input class="text" id="address" type="text" name="address" placeholder="Adresse du bâtiment"/>
                    </form>
                    <div id="login_box_login" class="confirmButton">
                        <button id="buildingAdd" type="submit" name="button">Ajouter le bâtiment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


      <?php
          if (isset($_POST['name']) && isset($_POST['address'])) {
              $ctrl = new ControleurAuth('ajoutBat');
          }
      ?>


</body>
</html>
