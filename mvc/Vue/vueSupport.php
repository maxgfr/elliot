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
