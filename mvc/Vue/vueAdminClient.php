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
    <title> DomISEP </title>
    <link rel="stylesheet" href="../../css/profil.css">
    <link href="../../css/notification.css" rel="stylesheet" type="text/css"/>

</head>

  <?php include("layouts/header.php"); ?>

<body>

    <div id="main">
        <div id='container_profile'>
            <!-- Display/Set the user informations request. -->
            <div id="container_contact_details">
                <div id="contact_details_text">
                    Fiche client
                </div>
                <div id="contact_details">
                    <div class="profileData">
                        <div class="textFromDatabase" style="margin-bottom:12px;">
                            <div class="headerTable" id="headerTable"></div>
                        </div>
                        <div class="textFromDatabase" style="margin-bottom:12px;">
                            <div id="addressTable"></div>
                        </div>
                        <div class="textFromDatabase" style="margin-bottom:12px;">
                            <div id="mailTable"></div>
                        </div>
                        <div class="textFromDatabase" style="margin-bottom:12px;">
                            <div id="birthdayTable"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="container_change_password">
                <div id="change_password_text">
                    Notifications
                </div>
                <div id="contact_details_input">
                    <table>
                        <tr>
                            <td>La batterie du capteur 25643 doit être rechargée (10%).</td>
                        </tr>
                        <tr>
                            <td>La connexion entre deux capteurs n'est plus assurée.</td>
                        </tr>
                        <tr>
                            <td>Le capteur 23 n'est plus fonctionnel.</td>
                        </tr>
                        <tr>
                            <td>Le capteur 6544 n'est plus fonctionnel.</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="../../js/AdminClient.js"></script>
<script>
if (getCookie("cookie_toggle_state")==1) {
    // if we are inside vueAdmin set the grey color
    $('#container_profile').css({"background-image":"linear-gradient(rgb(46,50,62), rgb(66,70,82))"})
}
if (getCookie("cookie_toggle_state")==0) {
    // set the blue color
    $('#container_profile').css({"background-image":"linear-gradient(rgb(25, 50, 100), rgb(38, 67, 120))"})
}

</script>
