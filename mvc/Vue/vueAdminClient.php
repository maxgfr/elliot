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
    <link href="../../css/admin.css" rel="stylesheet" type="text/css"/>

</head>

  <?php include("layouts/header.php"); ?>

<body>

    <div id="main">
        <div class="clientID">
            Fiche client (n°345675)
        </div>
        <div class="mainPart">
            <div class="leftSide">
                <div class="tabletable">
                    <div class="headerTable">
                        DomISEP
                    </div>
                    <div>
                        Adresse : 28 rue Notre-Dame des Champs
                    </div>
                    <div>
                        Adresse mail : domisep@isep.fr
                    </div>
                    <div>
                        Date de naissance : 10 juin 1957
                    </div>
                    <div id="footer_table">
                        Surface de la maison : 100m²
                    </div>
                </div>
                <div class="sendEmail">
                    <button type="button" name="button">Envoyer un mail</button>
                </div>
            </div>
            <div class="rightSide">
                <div class="tabletable">
                    <div class="headerTable">
                        Notifications
                    </div>
                    <div>
                        La batterie du capteur 25643 doit être rechargée (10%).
                    </div>
                    <div>
                        La connexion entre deux capteurs n'est plus assurée.
                    </div>
                    <div>
                        Le capteur 23 n'est plus fonctionnel.
                    </div>
                    <div id="footer_table">
                        Le capteur 6544 n'est plus fonctionnel.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
