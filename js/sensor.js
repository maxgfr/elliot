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
