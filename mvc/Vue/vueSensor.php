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

    <link rel="stylesheet" href="../../css/Sensor.css">
    <title>Capteurs/actionneurs</title>
    <script type="text/javascript" src="../../js/sensor.js"></script>


</head>

  <?php include("./layouts/header.php"); ?>

<body>

  <div id="main">


<h2>Tableau des capteurs</h2>

<table id="sensor">
	<tr id = 'header'>
    	<th>Nom du capteur</th>
    	<th>Pièce</th>
    	<th>Type de capteur</th>
      <th>Supprimer</th>
  </tr>
  <tr>
		<td>Chambre parents</td>
    	<td>Chambre parents</td>
    	<td>Température</td>
      <td>
        <input type="checkbox" id="chk_1"/>
      </td>


  </tr>
 <tr>
		<td>Chambre parents</td>
    	<td>Chambre parents</td>
    	<td>Luminosité</td>
      <TD><INPUT type="checkbox" id="chk_2"/></TD>

  </tr>
 <tr>
		<td>Chambre parents</td>
    	<td>Chambre parents</td>
    	<td>Température infrarouge</td>
      <TD><INPUT type="checkbox" id="chk_3"/></TD>
  </tr>
</table>
<br>


<input type=button name=type id='formulaire' value='Créer un capteur' onclick="setVisibility('nom');";>
<button onclick="myDelete1Function()">Supprimer</button>




  <div id="nom" style = 'display:none'>

    <fieldset>
      <legend>Nom</legend>
        <label for="Nom">Nom du capteur :</label>
        <input id="Nom" placeholder="" autofocus="" required="">
        <label for="lieu">Pièce :</label>
        <input id="lieu" placeholder="" autofocus="" required=""><br><br>
        <label for="type">Type du capteur :</label>
        <select name="type" id="type">
                <option value="temperature">Température</option>
                <option value="luminosite">Luminosité</option>
                <option value="temperature-infra">Température infrarouge</option>
          </select>
    </fieldset>
    <button id="test" onclick="fakedb(Nom,lieu,type)">Créer un capteur</button>
   </div>

 </div>



</body>
</html>
