// Allow notification not to be seen when the user checks them.
function show(test) {
    if (document.getElementById(test).style.display == "block") {

        document.getElementById(test).style.display = "none";
    } else {

        document.getElementById(test).style.display = "block";
    }
}