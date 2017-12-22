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

        <div id="blockSupport">
            <div id="blockSupport_header">
                Besoin d'aide ?
            </div>
            <div id="blockSupport_main">
                <div class="blockSupportTable" id="ticket" onclick="window.location.href='vueTicket.php'">
                    <div class="blockSupportTableImage">
                        <img src="../../img/supportTicket.png" alt="Support ticket">
                    </div>
                    <div class="blockSupportTableText">
                        <h3>Soumettre un ticket</h3>
                        <p>
                          Un problème spécifique est survenu ? 
                          <br>Un commentaire sur notre équipement ? 
                          <br>Une idée pour améliorer notre service ? 
                          <br>Ou voulez-vous tout simplement en savoir plus sur Domisep ?
                          <br>Notre équipe est à votre disposition pour vous renseigner et vous accompagner dans votre démarche. Ecrivez-nous <strong>ici</strong> !
                          <br>Nous vous répondrons dans les plus brefs délais.
                        </p>
                    </div>
                </div>
                <div class="blockSupportTable" id="faq" onclick="window.location.href='vueFAQ.php'">
                    <div class="blockSupportTableImage">
                        <img src="../../img/FAQ.png" alt="FAQ">
                    </div>
                    <div class="blockSupportTableText">
                        <h3>FAQ</h3><br>
                        <p>
                          Un incident vient entraver le bon fonctionnement de votre système HAN et vous voulez une réponse immédiate ?
                          <br>Veuillez trouver <strong>ici</strong> les problématiques les plus récurrentes des utilisateurs. Un client a probablement déjà constaté la même situation que vous !
                        </p>
                    </div>
                </div>
                <div class="blockSupportTable" id="faq" onclick="window.location.href='vueFAQ.php'" style="margin-right:0">
                    <div class="blockSupportTableImage">
                        <img src="../../img/supportGearIcon.png" alt="FAQ" style="width:5em">
                    </div>
                    <div class="blockSupportTableText">
                        <h3>Guide d'utilisation Client</h3> <p>
                          Est-ce la première fois que vous vous connectiez sur votre compte ?
                          <br>Avez-vous oublié le fonctionnement de notre site ?
                          <br>Nous vous répertorions <strong>ici</strong> l'intégralité de notre service. N'hésitez pas à aller consulter cette page afin de découvrir les nombreuses fonctionnalités qu'offre Domisep !
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
