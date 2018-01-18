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

var _funcShowList = function() {showList(this)};
var _funcHideList = function() {hideList(this)};

var _funcShowListWithInput = function() {showListWithInput(this)};

var arrow = document.getElementsByClassName('activeArrow');
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener('click', _funcShowList);
}

var getInputText = document.getElementsByClassName('getInput');
for (var i = 0; i < getInputText.length; i++) {
    getInputText[i].addEventListener('keyup', _funcShowListWithInput);
}

function showList(element) {
    var otherElements = document.getElementsByClassName(element.className);
    for (var i = 0; i < otherElements.length; i++) {
        //when opening a list, display none the others
        hideList(otherElements[i]);
    }
    element.children[0].setAttribute('style', 'width:15px; transform:rotate(180deg); transition: all ease 0.3s'); //rotate the image
    var listClass = element.parentElement.nextElementSibling;
    listClass.style.display = "block";
    listClass.style.zIndex = "1";
    element.removeEventListener('click', _funcShowList);
    element.addEventListener('click', _funcHideList);
}

function hideList(element) {
    element.children[0].setAttribute('style', 'width:15px; transform:rotate(0deg); transition: all ease 0.3s');
    var listClass = element.parentElement.nextElementSibling;
    listClass.style.display = "none";
    listClass.style.zIndex = "0";
    element.removeEventListener('click', _funcHideList);
    element.addEventListener('click', _funcShowList);
}

function showListWithInput(input) {
    var inputText = input.value.toUpperCase();
    var arrow = input.parentElement.nextElementSibling;
    var navigation = input.parentElement.parentElement.nextElementSibling.children[0]; //go to <nav>
    var li = navigation.getElementsByTagName('li');
    if (inputText.length > 0) {
        //user typed something
        showList(arrow);
        for (var i = 0; i < li.length; i++) {
            var valueOfLI = li[i].innerHTML.toUpperCase();
            //not case-sensitive
            if (valueOfLI.includes(inputText)) {
                li[i].style.display = "block";
            } else {
                li[i].style.display = "none";
            }
        }
        var count = 0;
        for (var i = 0; i < li.length; i++) {
            //if no results, show 'Aucun résultat ne correspond.'
            if (li[i].style.display == "block") {
                count += 1;
            }
        }
        if (count==0) {
            var notFound = document.getElementById('not_found');
            if (notFound!=null) {
                notFound.remove();
            }
            var element = document.createElement('LI');
            element.id = 'not_found';
            element.innerHTML = "Aucun résultat ne correspond.";
            navigation.appendChild(element);
        }
    } else {
        var notFound = document.getElementById('not_found');
        if (notFound!=null) {
            notFound.remove();
        }
        for (var i = 0; i < li.length; i++) {
            li[i].style.display = "block";
        }
        hideList(arrow);
    }
}
