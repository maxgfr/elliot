<?php
// Authorize errors to be displayed.
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

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



<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!--
  This view displays an interface to help resolving a problem.
  The user may choose to submit a ticket to the support or check
  if his current problem has already been resolved.
-->
<!-- //////////////////////////////////////////////////////////// -->



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Support </title>
    <link href="../../css/Support.css" rel="stylesheet" type="text/css"/>
</head>


<?php include("layouts/header.php"); ?>


<body>

    <div id="main">

        <div id="blockSupport">
            <div id="blockSupport_header">
                Besoin d'aide ?
            </div>
            <!-- Display the Ticket/FAQ options. -->
            <div id="blockSupport_main">
                <div class="blockSupportTable" id="ticket" onclick="window.location.href='vueTicket.php'" style="margin-right:2em">
                    <div class="blockSupportTableImage">
                        <img src="../../img/supportTicket.png" alt="Support ticket">
                    </div>
                    <div class="blockSupportTableText">
                        <h3>Soumettre un ticket</h3>
                        <p style="text-align:left">
                          Un problème spécifique est survenu ? <br>
                          Notre équipe est à votre disposition pour vous renseigner et vous accompagner dans votre démarche. <br>
                          Nous vous répondrons dans les plus brefs délais.
                      </p>
                  </div>
              </div>
              <div class="blockSupportTable" id="faq" onclick="window.location.href='vueFAQ.php'">
                <div class="blockSupportTableImage">
                    <img src="../../img/FAQ.png" alt="FAQ">
                </div>
                <div class="blockSupportTableText">
                    <h3>Foire aux questions</h3>
                    <p style="text-align:left">
                      Veuillez trouver ici les problématiques les plus récurrentes des utilisateurs.<br>
                      Un client a probablement déjà constaté la même situation que vous !
                  </p>
              </div>
          </div>
      </div>
  </div>

</div>

</body>
</html>
