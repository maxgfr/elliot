// Reference to the sidebar dynamic.
var sideBarIsOpen = 1;
var elements_text_of_sidebar = document.getElementsByClassName("textOfSidebar");
var elements_sidebar_container = document.getElementsByClassName("sidebarContainer");


// Check the visual state of the sidebar.
function setSideBarStatus() {
    if (sideBarIsOpen == 0) {
        openSideBar();
    } else {
        closeSideBar();
    }
}


// Expand the sidebar to the fullest, as icons and name of the views.
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


// Retract the sidebar to the tiniest, as icons only.
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


// Reference to the notification dynamic.
var notificationIsOpen = 0;


// Check the visual state of the notifications.
function setNotificationPopupStatus() {
    if (notificationIsOpen == 0) {
        showNotifications();
    } else {
        hideNotifications();
    }
}


// Prepare query strings.
var dbParam, xmlhttp, myObj, t = "";
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        for (x in myObj) {
            var idmessage = myObj[x];
            console.log(idmessage['contenu']);
        }
    }
};

xmlhttp.open("POST", "../Modeles/MessageAjaxQuery.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("t=" + dbParam);


// Expand the whole window displaying the notifications.
function showNotifications() {
    document.getElementById("container_notification").style.display = "block";
    document.getElementById("how_many_notif").style.display = "none";
    notificationIsOpen = 1;
}


// Withdraw the whole window displaying the notifications.
function hideNotifications() {
    document.getElementById("container_notification").style.display = "none";
    notificationIsOpen = 0;
}