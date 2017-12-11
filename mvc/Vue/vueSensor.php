<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Sensor.css">
    <script type="text/javascript" src="../../js/sensor.js"></script>

</head>

  <?php include("./layouts/header.php"); ?>

<body>

  <div id="main">


<p>Click the button to add a new row at the first position of the table and then add cells and content.</p>

<table id="sensor">
	<tr>
    	<th>Nom du capteur</th>
    	<th>Localisation</th> 
    	<th>Valeur</th>
  </tr>
  <tr>
		<td>Température lit</td>
    	<td>chambre parent</td> 
    	<td>10 °C</td>
  </tr>
 <tr>
		<td>chambre parent</td>
    	<td>chambre parent</td> 
    	<td>10 Csssss</td>
  </tr>
 <tr>
		<td>chambre parent</td>
    	<td>chambre parent</td> 
    	<td>10 Csssss</td>
  </tr>
</table>
<br>

<button onclick="myFunction()">Créer</button>
<button onclick="myDeleteFunction()">Supprimer</button>
<input type=button name=type id='formulaire' value='cree un capteur' onclick="setVisibility('nom');";> 


  <div id="nom" style = 'display:none'>

    <fieldset>
      <legend>Nom</legend>
        <label for="Nom">Nom</label>
        <input id="Nom" placeholder="Cuissine" autofocus="" required="">  
        <label for="lieu">Localisation</label>
        <input id="lieu" placeholder="Cuissine" autofocus="" required=""><br><br>
        <label for="type">Quel type de capteur ? </label>
        <select name="type" id="type">
              <option value="temperature">Température</option>
                <option value="luminosite">Luminosité</option>
                <option value="temperature-infra">Infrarouge</option>
          </select>
    </fieldset>
   </div> 

 </div>



</body>
</html>
