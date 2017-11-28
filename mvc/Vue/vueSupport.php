<?php
  // Répertoire racine du MVC
  $rootDirectory = dirname(__FILE__)."/../../mvc/";
  // chargement de la classe Autoload pour autochargement des classes
  require_once($rootDirectory.'Config\Autoload.php');
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
    <script src="../../js/animation.js"></script>

    <?php include ('layouts/header.php'); ?>

    <?php include ('layouts/iconBar.php'); ?>

</head>

<body>

        <?php include ('layouts/sidebar.php'); ?>
        <div id="main">
        <div id="Support" class="centre">
        <label>Motif</label> : <input type="Text" name="Motif" id="Motif" placeholder=" Mon capteur ne fonctionne pas" size="25" />
        <br />
        <br />
        <label>Description detaillée de votre problème</label>
        <br />
        <textarea name="Description" id="Description" rows="10" cols="65" placeholder="Merci de décrire votre problème dans les moindres détails !"></textarea>
        <br />
        <br />
        <button id="Butto_support">
            <img id="Envoyer" src="../../img/Envoyer_Support.png">
            Envoyer
        </button>
        </div>
    </div>
</body>
</html>
