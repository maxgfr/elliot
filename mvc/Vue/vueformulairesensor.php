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
</head>
<body>

<h2>Enregistrer un nouveau capteur</h2>
<form action="#">
  <p><i>Complétez le formulaire.</i></p>

  <div class="nom">
	  <fieldset>
	    <legend>Nom</legend>
	      <label for="Nom">Nom</label>
	      <input id="Nom" placeholder="Cuissine" autofocus="" required="">
	      <label for="lieu">lieu</label>
	      <input id="lieu" placeholder="Cuissine" autofocus="" required=""><br><br>
	      <label for="type">le sensor est ? </label>
   		  <select name="type" id="type">
   		        <option value="temperature"> temperature</option>
                <option value="luminosite"> luminosite</option>
                <option value="temperature-infra"> temperature infrarouge</option>
          </select>
	  </fieldset>
	 </div>
  <p><input type="submit" value="Connecter le capteur"></p>
</form>
<style>

label{
	display: block;
	text-align: left;
}

input[type=button], input[type=submit], input[type=reset] {
    background-color: rgb(46, 117, 181);
    display: inline;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;

}
</style>
</body>
