// Allow notification not to be seen when the user checks them.
function show(test) {
    if (document.getElementById(test).style.display == "block") {

        document.getElementById(test).style.display = "none";
    } else {

        document.getElementById(test).style.display = "block";
    }
}

if (getCookie("cookie_toggle_state")==1) {
    // if we are inside vueAdmin set the grey color
    $('#container_notif').css({"background-image":"linear-gradient(rgb(46,50,62), rgb(66,70,82))"})
}
if (getCookie("cookie_toggle_state")==0) {
    // set the blue color
    $('#container_notif').css({"background-image":"linear-gradient(rgb(25, 50, 100), rgb(38, 67, 120))"})
}
