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
    	<th>sensor name</th>
    	<th>localisation</th> 
    	<th>temperature</th>
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
 <tr>
		<td>chambre parent</td>
    	<td>chambre parent</td> 
    	<td>10 Csssss</td>
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

 </div>



</body>
</html>
