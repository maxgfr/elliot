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
                Comment pouvons-nous vous aider?
            </div>
            <div id="blockSupport_main">
                <div class="blockSupportTable" id="ticket" onclick="window.location.href='vueTicket.php'">
                    <div class="blockSupportTableImage">
                        <img src="../../img/supportTicket.png" alt="Support ticket">
                    </div>
                    <div class="blockSupportTableText">
                        Go to support ticket <br>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                </div>
                <div class="blockSupportTable" id="faq" onclick="window.location.href='vueFAQ.php'">
                    <div class="blockSupportTableImage">
                        <img src="../../img/FAQ.png" alt="FAQ">
                    </div>
                    <div class="blockSupportTableText">
                        Go to FAQ <br>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                </div>
                <div class="blockSupportTable" id="faq" onclick="window.location.href='vueFAQ.php'" style="margin-right:0">
                    <div class="blockSupportTableImage">
                        <img src="../../img/supportGearIcon.png" alt="FAQ" style="width:5em">
                    </div>
                    <div class="blockSupportTableText">
                        Go to parameter page <br>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
