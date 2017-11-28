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
<html lang="fr">
<head>

    <meta charset="utf-8">
    <title> Support </title>
    <style>
        button {background-color: rgb(46, 117, 181); width: 100px;  height: 30px; color: white;}
        button:hover {filter:contrast(100%);}
        img {width: 20%; height: auto; filter:invert(90%);}
    </style>

</head>

<?php include ('layouts/header.php'); ?>
<?php include ('layouts/iconBar.php'); ?>

<div id="Support">
    <body>
    <?php include ('layouts/sidebar.php'); ?>

    <label>Motif</label> : <input type="Text" name="Motif" id="Motif" placeholder=" Mon capteur ne fonctionne pas" size="30" />
    <br />
    <br />
    <label>Description detaillee de votre probleme</label>
    <br />
    <textarea name="Description" id="Description" rows="10" cols="50" placeholder="Merci de décrire votre problème dans les moindres détails !">
	</textarea>
    <br />
    <button>
        <img src="../../img/Envoyer_Support.png">
        Envoyer
    </button>

    </body>
</html>
