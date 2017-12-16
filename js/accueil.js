function showInitialImage(cell) {
    var child = cell.childNodes;
    var childchild = child[1];
    childchildchild = childchild.childNodes;
    childchildchild[1].style.display = "inline";
}

function showTypeOfSensor(cell) {
    var child = cell.childNodes;
    console.log(child[1].className);
    var childchild = child[1];
    childchildchild = childchild.childNodes;
    childchildchild[1].style.display = "none";
    childchildchild[1].innerHTML = "Température";
}
