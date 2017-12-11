function myFunction() {
    var table = document.getElementById("sensor");
    var row = table.insertRow(table.rows.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = "NEW dsdsds";
    cell2.innerHTML = "NEW fdsfsdfsfsd";
    cell3.innerHTML = "NEW ";
}

function fakedb(Nom,lieu,type) {
    var e = document.getElementById("type");
    var type1 = e.options[e.selectedIndex].text;
    var table = document.getElementById("sensor");
    var row = table.insertRow(table.rows.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = Nom.value;
    cell2.innerHTML = lieu.value;
    cell3.innerHTML = type1;
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
