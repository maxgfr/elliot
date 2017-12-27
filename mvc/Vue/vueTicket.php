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

        <div id="container_ticket">
            <div id="container_ticket_main">
                <div class="inputText">
                    <input type="text" name="motif" id="motif" placeholder="Motif de votre problème">
                </div>
                <div class="descriptionText">
                    <textarea name="description" id="description" style="resize:none" placeholder="Description détaillée de votre problème"></textarea>
                </div>
                <div class="confirmButton">
                    <button type="submit" name="button">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
