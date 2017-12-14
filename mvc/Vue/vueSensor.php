<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Sensor.css">
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico"/>
    <title>Capteurs/actionneurs</title>
    <script type="text/javascript" src="../../js/sensor.js"></script>
    <script type="text/javascript"src="../../js/animation.js"></script>

</head>

  <?php include("./layouts/header.php"); ?>

<body>

  <div id="main">


<p>Click the button to add a new row at the first position of the table and then add cells and content.</p>

<table id="sensor">
	<tr>
    	<th>sensor name</th>
    	<th>localisation</th>
    	<th>type de capteur</th>
  </tr>
  <tr>
		<td>chambre parent</td>
    	<td>chambre parent</td>
    	<td>temperature</td>
  </tr>
 <tr>
		<td>chambre parent</td>
    	<td>chambre parent</td>
    	<td>luminosite</td>
  </tr>
 <tr>
		<td>chambre parent</td>
    	<td>chambre parent</td>
    	<td>temperature infrarouge</td>
  </tr>
</table>
<br>

<button onclick="myFunction()">create</button>
<button onclick="myDeleteFunction()">delete</button>
<input type=button name=type id='formulaire' value='cree un capteur' onclick="setVisibility('nom');";>




  <div id="nom" style = 'display:none'>

    <fieldset>
      <legend>Nom</legend>
        <label for="Nom">Nom</label>
        <input id="Nom" placeholder="Cuisine" autofocus="" required="">
        <label for="lieu">lieu</label>
        <input id="lieu" placeholder="Cuisine" autofocus="" required=""><br><br>
        <label for="type">le capteur est</label>
        <select name="type" id="type">
                <option value="temperature"> temperature</option>
                <option value="luminosite"> luminosite</option>
                <option value="temperature-infra"> temperature infrarouge</option>
          </select>
    </fieldset>
    <button id="test" onclick="fakedb(Nom,lieu,type)">create</button>
   </div>

 </div>



</body>
</html>
