/******************************AJAX AND JSON PART*******************************/

/*var dbParam, xmlhttp, myObj, a = "";
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        for (x in myObj) {
        }
    }
};
xmlhttp.open("POST", "../Modeles/ProfileAjaxQuery.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("a=" + dbParam);*/

/*******************************************************************************/

// Set the general model to a user's data display.
var _funcShowList = function() { showList(this) };
var _funcHideList = function() { hideList(this) };

var _funcShowListWithInput = function() { showListWithInput(this) };

var arrow = document.getElementsByClassName('activeArrow');
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener('click', _funcShowList);
}

var getInputText = document.getElementsByClassName('getInput');
for (var i = 0; i < getInputText.length; i++) {
    getInputText[i].addEventListener('keyup', _funcShowListWithInput);
}


// Display a user's data.
function showList(element) {
    var otherElements = document.getElementsByClassName(element.className);
    for (var i = 0; i < otherElements.length; i++) {
        // When opening a list, display "none" the others.
        hideList(otherElements[i]);
    }
    element.children[0].setAttribute('style', 'width:15px; transform:rotate(180deg); transition: all ease 0.3s'); // Rotate the image.
    var listClass = element.parentElement.nextElementSibling;
    listClass.style.display = "block";
    listClass.style.zIndex = "1";
    element.removeEventListener('click', _funcShowList);
    element.addEventListener('click', _funcHideList);
}


// Withdraw a user's data.
function hideList(element) {
    element.children[0].setAttribute('style', 'width:15px; transform:rotate(0deg); transition: all ease 0.3s');
    var listClass = element.parentElement.nextElementSibling;
    listClass.style.display = "none";
    listClass.style.zIndex = "0";
    element.removeEventListener('click', _funcHideList);
    element.addEventListener('click', _funcShowList);
}


//Display a user's input.
function showListWithInput(input) {
    var inputText = input.value;
    var arrow = input.parentElement.nextElementSibling;
    var navigation = input.parentElement.parentElement.nextElementSibling.children[0]; //Go to <nav>.
    var li = navigation.getElementsByTagName('li');
    init();
    if (inputText.length > 0) {
        // The user typed something.
        showList(arrow);
        for (var i = 0; i < li.length; i++) {
            var valueOfLI = li[i].innerHTML;
            // Not case-sensitive.
            if (valueOfLI.toUpperCase().includes(inputText.toUpperCase())) {
                li[i].style.display = "block";
                //InstantSearch.highlight(li[i], inputText);
            } else {
                li[i].style.display = "none";
            }
        }
        var count = 0;
        for (var i = 0; i < li.length; i++) {
            // If no results, show 'Aucun résultat ne correspond.'.
            if (li[i].style.display == "block") {
                count += 1;
            }
        }
        if (count == 0) {
            var notFound = document.getElementById('not_found');
            if (notFound != null) {
                notFound.remove();
            }
            var element = document.createElement('LI');
            element.id = 'not_found';
            element.innerHTML = "Aucun résultat ne correspond.";
            navigation.appendChild(element);
        }
    } else {
        for (var i = 0; i < li.length; i++) {
            li[i].style.display = "block";
            li[i].backgroundColor = "transparent";
        }
        hideList(arrow);
    }
}


// Display the existing user's data.
function init() {
    var notFound = document.getElementById('not_found');
    if (notFound != null) {
        notFound.remove();
    }
    for (var i = 0; i < document.getElementsByTagName('li').length; i++) {
        document.getElementsByTagName('li')[i].style.display = "block";
    }
}

if (getCookie("cookie_toggle_state")==1) {
    // if we are inside vueAdmin set the grey color
    $('#container_profile').css({"background-image":"linear-gradient(rgb(46,50,62), rgb(66,70,82))"})
}
if (getCookie("cookie_toggle_state")==0) {
    // set the blue color
    $('#container_profile').css({"background-image":"linear-gradient(rgb(25, 50, 100), rgb(38, 67, 120))"})
}

var _funcModifyInformations = function() {modifyUserInfo(this)};
var modify_button = document.getElementById('modify_button');
var cancel_button = document.getElementById('cancel_button');
modify_button.addEventListener('click', _funcModifyInformations);
cancel_button.addEventListener('click', cancel_modifications);

function modifyUserInfo(element) {
    element.nextElementSibling.style.display = 'block';
    element.previousElementSibling.style.display = 'none';
    element.style.display = 'none';
}

function cancel_modifications() {
    var confirm_modifications = confirm("Voulez-vous vraiment annuler les modifications?");
    if (confirm_modifications) {
        document.getElementById('change_data_user').style.display = 'none';
        document.getElementsByClassName('profileData')[0].style.display = 'block';
        modify_button.style.display = 'block';
    }
}
