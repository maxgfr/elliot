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
    $ctrl = new ControleurAuth('afficheBat');
?>
