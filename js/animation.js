var sideBarIsOpen = 1;
var elements_text_of_sidebar = document.getElementsByClassName("textOfSidebar");
var elements_sidebar_container = document.getElementsByClassName("sidebarContainer");

function setSideBarStatus(){
  if(sideBarIsOpen==0){
    openSideBar();
  }
  else{
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


  for(var i = 0; i < elements_text_of_sidebar.length; i++) {
    elements_text_of_sidebar[i].style.transitionDelay = "0.5s";
    elements_text_of_sidebar[i].style.display = "block";
  }

  for(var i = 0; i<elements_sidebar_container.length; i++) {
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


  for(var i = 0; i < elements_text_of_sidebar.length; i++) {
    elements_text_of_sidebar[i].style.display = "none";
  }

  for(var i = 0; i<elements_sidebar_container.length; i++) {
      elements_sidebar_container[i].style.width = "4.5em";
  }

  sideBarIsOpen = 0;
}


var notificationIsOpen = 0;

function setNotificationPopupStatus(){
  if(notificationIsOpen==0){
    showNotifications();
  }
  else{
    hideNotifications();
  }
}

function showNotifications() {
    document.getElementById("container_notification").style.display = "block";
    document.getElementById("how_many_notif").style.display = "none";
    notificationIsOpen = 1;
}

function hideNotifications() {
    document.getElementById("container_notification").style.display = "none";
    notificationIsOpen = 0;
}


/*************************PART OF CHECKING STRENGTH OF PASSWORD**************************/
/* To be improved : when longpress on key the strength bar is not modified.
   The goal is to make it in live */

var counter_space = 0;
var counter_normal = 0;
var counter_capitalize = 0;
var counter_numbers = 0;
var counter_special = 0;
var lengthText=0;
var last_text = "";
var passwordText = "";
var initial_lengthText = 0;

/**********CREATE THE FUNCTIONS OF DETECTION OF CHARACTERS**********/
function detectSpace(character) {
    return (character.indexOf(" ") != -1);
}

function detectNumber(character) {
    return (/[0-9]/.test(character));
}

function detectNormal(character) {
    return (/[a-z]/.test(character));
}

function detectCapitalize(character) {
    return (/[A-Z]/.test(character));
}

function setCounters(condition, character) {
    if (lengthText!=0) {
        if (detectNormal(character)) {
            if (condition) {
                counter_normal++;
            }
            else {
                counter_normal--;
            }
        }
        else if (detectNumber(character)) {
            if (condition) {
                counter_numbers++;
            }
            else {
                counter_numbers--;
            }
        }
        else if (detectSpace(character)) {
            if (condition) {
                counter_space++;
            }
            else {
                counter_space--;
            }
        }
        else if (detectCapitalize(character)) {
            if (condition) {
                counter_capitalize++;
            }
            else {
                counter_capitalize--;
            }
        }
        else {
            /* It's just a trick to determine the special characters by elimination.
               For ease of implementation, it will work for Latin, Greek, Armenian and Cyrillic scripts.
               We don't take into account Chinese, Japanese, Arabic, Hebrew and most other scripts.
               Keep calm, it's not racism.
            */
            if (condition) {
                counter_special++;
            }
            else {
                counter_special--;
            }
        }
    }
    else {
        // If empty text set the default values.
        counter_space = 0;
        counter_normal = 0;
        counter_capitalize = 0;
        counter_numbers = 0;
        counter_special = 0;
    }
}


function setStrength() {
    /*************************************************************************************************\
    |*                                                                                               *|
    |*  It returns a value between 0 and 5, depending on the strength                                *|
    |*  of the password written by the user.                                                         *|
    |*                                                                                               *|
    |*  0 : no word is typed                                                                         *|
    |*  1 : the password's length is less than 4 characters (even with special characters).          *|
    |*  2 : the password's length is higher than 5 characters (not considering special characters).  *|
    |*  3 : the password contains at least 2 capitalize characters or at least 2 numbers or          *|
    |*  at least 2 special characters.                                                               *|
    |*  4 : the password contains at least 2 of the criterias quoted above.                          *|
    |*  5 : the password contains all the criterias (at least 2 capitalize characters, 2 numbers     *|
    |*  and 2 special characters).                                                                   *|
    |*                                                                                               *|
    \*************************************************************************************************/


    passwordText = document.getElementById("password").value;
    lengthText = document.createTextNode(passwordText).length;

    var add_character = lengthText > initial_lengthText; /*returns True if the user adds a character*/
    var remove_character = lengthText < initial_lengthText;

    if (add_character) {
        number_of_character_added = lengthText - initial_lengthText;
        text_added = passwordText.slice(-number_of_character_added);
        for (var i = 0; i < text_added.length; i++) {
            setCounters(add_character, text_added[i]);
        }
    }
    else if (remove_character) {
        number_of_character_removed = initial_lengthText - lengthText;
        text_removed = last_text.slice(-number_of_character_removed);
        for (var i = 0; i < text_removed.length; i++) {
            setCounters(add_character, text_removed[i]);
        }
    }

    initial_lengthText = lengthText;
    last_text = passwordText;

    /*console.log("counter_space=", counter_space);
    console.log("counter_normal=", counter_normal);
    console.log("counter_numbers=", counter_numbers);
    console.log("counter_capitalize=", counter_capitalize);
    console.log("counter_special=", counter_special);*/



    /**********DETERMINE THE STRENGTH OF THE PASSWORD**********\
    |*                                                        *|
    |*    Put here how you want the password to be strong.    *|
    |*                                                        *|
    \**********************************************************/

    if (lengthText==0) {
        strength = 0;
    }
    else if (lengthText <= 4) {
        strength = 1;
    }
    else if (lengthText > 4) {
        /* The order of the if conditions is very important here ! */
        if (counter_capitalize>=2 && counter_numbers>=2 && counter_special>=2) {
            strength = 5;
        }
        else if ((counter_capitalize>=2 && counter_numbers>=2) ||
                 (counter_capitalize>=2 && counter_special>=2) ||
                 (counter_numbers>=2 && counter_special>=2)) {
            strength = 4;
        }
        else if ((counter_capitalize>=2 || counter_numbers>=2 || counter_special>=2)) {
            strength = 3;
        }
        else {
            strength = 2;
        }
    }

    return strength;
}

function setBackgroundColorBar(strength) {
    /*************************************************************************************************\
    |*                                                                                               *|
    |*  This function takes in parameter the value return by the setStrength                         *|
    |*  function to set the bars' color.                                                             *|
    |*                                                                                               *|
    \*************************************************************************************************/

    var firstBarColor = document.getElementById("show_strength_bar_weakest");
    var secondBarColor = document.getElementById("show_strength_bar_weak");
    var thirdBarColor = document.getElementById("show_strength_bar_medium");
    var fourthBarColor = document.getElementById("show_strength_bar_good");
    var fifthBarColor = document.getElementById("show_strength_bar_excellent");
    var displayText = document.getElementById("type_of_strength");
    var strengthBox = document.getElementById("show_strength_box");
    var warning = document.getElementById("show_warning");

    if (counter_space >= 1) {
        warning.style.display = "flex";
        strengthBox.style.display = "none";
    }
    else {
        strengthBox.style.display = "flex";
        warning.style.display = "none";
        if (strength==0) {
            strengthBox.style.display="none";
        }
        else if (strength==1) {
            strengthBox.style.display="flex";
            displayText.innerHTML="Médiocre";

            firstBarColor.style.backgroundColor = "#C00000";
            secondBarColor.style.backgroundColor = thirdBarColor.style.backgroundColor = fourthBarColor.style.backgroundColor
            = fifthBarColor.style.backgroundColor = "#D3D3D3";
            /* This line forces the other bars to be grey because, when a color is set,
               it stays at its previous color.
               Example : The password is medium, so the first three bars are set yellow. Now the user
                         removes the password and it becomes a weak password. At this moment, the first
                         two bars are set to red but the third bar is still set to yellow and not grey.
            */
        }
        else if (strength==2) {
            displayText.innerHTML="Mauvaise";

            firstBarColor.style.backgroundColor = secondBarColor.style.backgroundColor = "#C75566";
            thirdBarColor.style.backgroundColor = fourthBarColor.style.backgroundColor = fifthBarColor.style.backgroundColor = "#D3D3D3";
        }
        else if (strength==3) {
            displayText.innerHTML="Moyenne";

            firstBarColor.style.backgroundColor = secondBarColor.style.backgroundColor = thirdBarColor.style.backgroundColor = "#DDAC26";
            fourthBarColor.style.backgroundColor = fifthBarColor.style.backgroundColor = "#D3D3D3";
        }
        else if (strength==4) {
            displayText.innerHTML="Elevée";

            firstBarColor.style.backgroundColor = secondBarColor.style.backgroundColor = thirdBarColor.style.backgroundColor
            = fourthBarColor.style.backgroundColor = "#219D75";
            fifthBarColor.style.backgroundColor = "#D3D3D3";
        }
        else if (strength==5) {
            displayText.innerHTML="Excellente";

            firstBarColor.style.backgroundColor = secondBarColor.style.backgroundColor = thirdBarColor.style.backgroundColor
            = fourthBarColor.style.backgroundColor = fifthBarColor.style.backgroundColor = "#548235";
        }
    }
}
