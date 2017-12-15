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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico" />
    <script src="../../js/animation.js"></script>

    <title>UserPage</title>
</head>

    <?php include("layouts/header.php"); ?>

<body>
    <div id="main">

        <p>Utilisateur</p>
        <label for="Name">Nom : </label><input type="text" name="Name" id="Name">
        <label for="Prenom">Prénom : </label><input type="text" name="Prenom" id="Prenom">
        <label for="Telephone">Numéro de téléphone : </label><input type="text" name="Telephone" id="Telephone">
        <button type="button" name="button">Enregistrer les modifications</button>
        
    </div>
</body>

</html>
