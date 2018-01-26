// Create an empty table with 3 "None" cells.
function myFunction() {
    var table = document.getElementById("sensor");
    var row = table.insertRow(table.rows.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = "None";
    cell2.innerHTML = "None";
    cell3.innerHTML = "None";
}


// Create a template to insert data in cells.
function fakedb(Nom, lieu, type) {
    var e = document.getElementById("type");
    var type1 = e.options[e.selectedIndex].text;
    var table = document.getElementById("sensor");
    var row = table.insertRow(table.rows.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = Nom.value;
    cell2.innerHTML = lieu.value;
    cell3.innerHTML = type1;
    var temp = table.rows.length - 1
    var chkv = "chk_" + temp
    //chkv --;
    cell4.innerHTML = '<input type="checkbox" id="' + chkv + '">';
    Nom.value = null;
    lieu.value = null;
}


// Remove a table by withdrawal of its rows.
function myDelete1Function() {
    var table = document.getElementById("sensor");
    var rowCount = table.rows.length;
    for (i = 1; i < rowCount; i++) {
        var cell = "chk_" + i.toString();
        var chkCell = document.getElementById(cell);
        if (chkCell.checked) {
            table.deleteRow(i);
            rowCount -= 1;
            for (j = 0; j < rowCount; j++) {
                var cell_1 = table.rows[j].cells[3];
                cell_1.id = "case_" + j.toString();
                var chkCell_1 = document.getElementById(cell_1.id).childNodes[0];
                chkCell_1.id = "chk_" + j.toString();
            }
        }
    }
}


// Change the button option for ergonomy.
function setVisibility(id) {
    if (document.getElementById('formulaire').value == 'Créer un capteur') {
        document.getElementById('formulaire').value = 'Fermer';
        document.getElementById(id).style.display = 'inline';
    } else {
        document.getElementById('formulaire').value = 'Fermer';
        document.getElementById(id).style.display = 'none';
        document.getElementById('formulaire').value = 'Créer un capteur';
    }

}