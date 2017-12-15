<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Sensor.css">
    <script type="text/javascript" src="../../js/sensor.js"></script>
    <script src="../../js/animation.js"></script>


</head>

  <?php include("./layouts/header.php"); ?>

<body>

  <div id="main">


<p>Tableau des capteurs</p>

<table id="sensor">
	<tr id = 'header'>
    	<th>sensor name</th>
    	<th>localisation</th> 
    	<th>type de capteur</th>
      <th>deleted</th>
  </tr>
  <tr>
		<td>chambre parent</td>
    	<td>chambre parent</td> 
    	<td>temperature</td>
      <td>
        <input type="checkbox" id="chk_1"/>
      </td>


  </tr>
 <tr>
		<td>chambre parent</td>
    	<td>chambre parent</td> 
    	<td>luminosite</td>
      <TD><INPUT type="checkbox" id="chk_2"/></TD>

  </tr>
 <tr>
		<td>chambre parent</td>
    	<td>chambre parent</td> 
    	<td>temperature infrarouge</td>
      <TD><INPUT type="checkbox" id="chk_3"/></TD>
  </tr>
</table>
<br>

<input type=button name=type id='formulaire' value='cree un capteur' onclick="setVisibility('nom');";> 
<button onclick="myDelete1Function()">delete</button>



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
