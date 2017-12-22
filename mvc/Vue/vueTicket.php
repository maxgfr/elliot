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
    <link rel="stylesheet" href="../../css/style.css">
    <link href="../../css/Support.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico" />
    <script src="../../js/animation.js"></script>


</head>

  <?php include("layouts/header.php"); ?>

<body>

    <div id="main">
        <div id="Support" class="centre">
            <label>Motif</label> : <input type="Text" name="Motif" id="Motif" placeholder=" Mon capteur ne fonctionne pas" size="70" />
            <br />
            <br />
            <label>Description detaillée de votre problème</label>
            <br />
            <textarea name="Description" id="Description" rows="10" cols="65" style="resize:none" placeholder="Merci de décrire votre problème dans les moindres détails !"></textarea>
            <br />
            <br />
            <button id="Button_support">
                Envoyer
            </button>
        </div>
    </div>
</body>
</html>
