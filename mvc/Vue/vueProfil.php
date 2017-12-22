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

        <form method="post">
          <h1>Bonjour Lama Sticot !</h1>
          <h3>Avez-vous changé de coordonnées ? N'hésitez pas à nous le faire savoir !</h3>

          <label for="tel_fixe"> Téléphone fixe :
          <input class="text" id="tel_fixe" type="tel" name="tel_fixe" value="" placeholder="0101010101"/>
          <br>
          <label for="tel_port"> Téléphone portable :
          <input class="text" id="tel_port" type="tel" name="tel_port" value="" placeholder="0606060606"/>
          <br>
          <label for="adress"> Adresse :
          <input class="text" id="adress" type="text" name="adress" value="" placeholder="82 Boulevard de Clichy, 75018 Paris"/>

          <br><br>
          <h3>Souhaitez-vous changer d'identifiants ? Attention aux yeux indiscrets !</h3>
          <label for="mail"> E-mail :
          <input class="text" id="mail" type="email" name="mail" value="" placeholder="lama.sticot@yahoo.fr"/>
          <br>
          <label for="mdp"> Mot de passe :
          <input class="text" id="password" type="password" name="password" value="" placeholder="********"/>
          <br>
          <label for="mdp2"> Confirmation du mot de passe :
          <input class="text" id="password2" type="password" name="password2" value="" placeholder="********"/>


          <br><br>
          <button type="button" name="button">Enregistrer les modifications</button>
        </form>


    </div>
</body>

</html>
