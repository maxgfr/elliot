<!DOCTYPE html>
<html>
<head>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color:rgb(38, 67, 120)}

th {
    background-color: rgb(38, 67, 120);
    color: white;
}
</style>
<style>
table{
    border-collapse: collapse;
    width: 100%;
}
th, td {
     text-align: left;
     padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: rgb(46, 117, 181);
    color: white;
}

</style>
</head>
<body>


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
<button onclick="ouvre_popup()">create formulaire</button>
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




<script>
function myFunction() {
    var table = document.getElementById("sensor");
    var row = table.insertRow(table.rows.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = "NEW CELL1";
    cell2.innerHTML = "NEW CELL2";
}

function myDeleteFunction() {
	var table = document.getElementById("sensor");
  	var rowCount = table.rows.length;
  	if (rowCount > 1) {
  		table.deleteRow(rowCount -1);
  	} else {
  		window.open('sensor.html','nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=300, height=200');
  	} 

	}	

 






function setVisibility(id) {
if(document.getElementById('formulaire').value=='cree un capteur'){
document.getElementById('formulaire').value = 'pas cree un capteur';
document.getElementById(id).style.display = 'inline';
}else{
document.getElementById('formulaire').value = 'pas cree un capteur';
document.getElementById(id).style.display = 'none';
document.getElementById('formulaire').value = 'cree un capteur';
}

}

</script>

</body>
</html>
