var sideBarIsOpen = 1;
var elements_text_of_sidebar = document.getElementsByClassName("textOfSidebar");
var elements_sidebar_container = document.getElementsByClassName("sidebarContainer");

function setSideBarStatus() {
    if (sideBarIsOpen == 0) {
        openSideBar();
    }
    else {
        closeSideBar();
    }
}

function openSideBar() {
    document.getElementById("small_icon").style.display = "none";
    document.getElementById("big_icon").style.display = "block";
    document.getElementById("hamburger_button").style.marginLeft = "9em";
    document.getElementById("main").style.transform = "scale(1,1)";
    document.getElementById("main").style.paddingLeft = "17em";
    document.getElementById("main").style.paddingTop = "6em";


    for (var i = 0; i < elements_text_of_sidebar.length; i++) {
        elements_text_of_sidebar[i].style.transitionDelay = "0.5s";
        elements_text_of_sidebar[i].style.display = "block";
    }

    for (var i = 0; i < elements_sidebar_container.length; i++) {
        elements_sidebar_container[i].style.width = "16em";
    }

    sideBarIsOpen = 1;
}

function closeSideBar() {

    document.getElementById("small_icon").style.display = "block";
    document.getElementById("big_icon").style.display = "none";
    document.getElementById("hamburger_button").style.marginLeft = "3em";
    document.getElementById("main").style.transform = "scale(1.1,1.1)";
    document.getElementById("main").style.paddingLeft = "12em";
    document.getElementById("main").style.paddingTop = "7em";


    for (var i = 0; i < elements_text_of_sidebar.length; i++) {
        elements_text_of_sidebar[i].style.display = "none";
    }

    for (var i = 0; i < elements_sidebar_container.length; i++) {
        elements_sidebar_container[i].style.width = "4.5em";
    }

    sideBarIsOpen = 0;
}


var notificationIsOpen = 0;

function setNotificationPopupStatus() {
    if (notificationIsOpen == 0) {
        showNotifications();
    }
    else {
        hideNotifications();
    }
}

var dbParam, xmlhttp, myObj, t = "";
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        /*for (x in myObj) {
            //var idmessage = myObj[x];
            //console.log(idmessage);
        }*/
    }
};
xmlhttp.open("POST", "../Modeles/MessageAjaxQuery.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("t=" + dbParam);

function showNotifications() {
    document.getElementById("container_notification").style.display = "block";
    document.getElementById("how_many_notif").style.display = "none";
    notificationIsOpen = 1;
}

function hideNotifications() {
    document.getElementById("container_notification").style.display = "none";
    notificationIsOpen = 0;
}
