/****************************************ACCUEIL.JS*******************************************\
|*                                                                                           *|
|*  The name of the rooms has to be in lowercase and in english (bedroom, kitchen, etc.).    *|
|*  The name of the sensors has to be in lowercase and in english (temperature,              *|
|*  motion, humidity, etc.).                                                                 *|
|*                                                                                           *|
|*  If we want to add rooms or sensors, keep in mind these rules.                            *|
|*  In this case, the associative tables below have to be set correctly.                     *|
|*  Also, all the images' names will be like <room or sensor>Icon.png                        *|
|*  (e.g. bathroomIcon.png, temperatureIcon.png)                                             *|
|*                                                                                           *|
\*********************************************************************************************/



/******************************AJAX AND JSON PART*******************************/

var dbParam, xmlhttp, myObj, x = "";
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        for (x in myObj) {
            addRoom(false, myObj[x].nameOfRoom, myObj[x].idOfRoom);
            var idRoom = myObj[x].nameOfRoom + '_' + myObj[x].idOfRoom;
            setTablePart(idRoom, myObj[x].idOfSensor, myObj[x].nameOfFamilysensor, myObj[x].valueOfSensor);
        }
    }
};
xmlhttp.open("POST", "../Modeles/AccueilAjaxQuery.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("x=" + dbParam);

/*******************************************************************************/

color_of_cells = {'bedroom_0' : '#264376',
                  'bedroom_1' : '#DDAC26',
                  'bedroom_2' : '#5F3F5D',
                  'bedroom_3' : '#2E323E',
                  'kitchen_0' : '#C75566',
                  'bathroom_0' : '#0DBEC8',
                  'bathroom_1' : '#219D75',
                  'livingroom_0' : '#E38A21',
                  'diningroom_0' : '#50240B',
                  'default' : '#2E75B5'};

name_of_room = {'bedroom' : 'Chambre',
                'livingroom' : 'Salon',
                'bathroom' : 'Salle de bain',
                'kitchen' : 'Cuisine',
                'diningroom' : 'Salle à manger'};

name_of_sensor = {'temperature' : 'Température',
                  'barometer' : 'Pression atm',
                  'luminosity' : 'Luminosité',
                  'motion' : 'Présence',
                  'humidity' : 'Humidité'};

unit_of_sensor = {'temperature' : '°C',
                  'barometer' : 'hPa',
                  'luminosity' : '%',
                  'motion' : '',
                  'humidity' : '%'};


function addRoom(plusPart, room, id_room_db) {
    /*********************************DOCUMENTATION**************************************\
    |*                                                                                  *|
    |*  This function takes in parameter the type of room (e.g. bathroom or bedroom)    *|
    |*  and the id of room in the database (for ease of implementation).                *|
    |*                                                                                  *|
    |*  At the beginning, the function tests if the room we want to add exist. In this  *|
    |*  case, we do nothing.                                                            *|
    |*  If it does not exist, we clone the code in <div id="main"> (it is a model) and  *|
    |*  set the icon part (icon, text and color relative to the room we are creating).  *|
    |*                                                                                  *|
    \************************************************************************************/

                        /*\
                       / * \
                      /  *  \
                     /   *   \
                    /         \
                   /     *     \
                  /_____________\*/


    var roomID = document.getElementById(room+'_'+id_room_db);
    if (roomID==null) {
        var mainId = document.getElementById('main'); //we set to it to append child after

        /*************DUPLICATE ALL THE ELEMENTS IN <div class='room'>*******************/

        var roomClass = document.getElementsByClassName('room');
        roomClass = roomClass[0]; //the class contains only one element
        var duplicatedRoomClass = roomClass.cloneNode([true]);
        //if we do not clone the  <div class='room'> , it is the model class that will be mofified
        //in fact, for example, roomIcon.png will be replaced by bedroomIcon.png and, after that, we will not be able to create other rooms

        duplicatedRoomClass.className = plusPart ? 'addingRoom' : room;
        if (!plusPart) {
            duplicatedRoomClass.id = room+'_'+id_room_db;
        }
        duplicatedRoomClass.style.display = "flex";

        /**********************************ICON PART*********************************/
        setIconPart(plusPart, duplicatedRoomClass);

        /******************CREATE THE TABLE WITH THE ROOM WE WANT********************/
        mainId.appendChild(duplicatedRoomClass);
        if (plusPart) {
            duplicatedRoomClass.addEventListener('click', _funcAddRoom);
            duplicatedRoomClass.children[0].style.cursor = 'pointer';
        }
    }
}

function setIconPart(plusPart, parentNode) {
    var rootDirectoryImages = '../../img/';

    // go to Icon Part
    iconPartNode = parentNode.children[0];

    if (plusPart) {
        iconPartNode.style.backgroundColor = color_of_cells['default'];
    } else {
        var testExistentRoom = document.getElementsByClassName(parentNode.className);
        var lengthExistentRoom = testExistentRoom.length;

        var nameRoom = parentNode.className;

        // set the color for a specific room
        parameter = nameRoom+'_'+lengthExistentRoom;
        var color = color_of_cells[parameter]!=null ? color_of_cells[parameter] : color_of_cells['default'];
        iconPartNode.style.backgroundColor = color;
    }

    // set the icon for the specific room
    var imagePartNode = iconPartNode.children[0]; // go to iconPartImage
    imagePartNode.style.height = plusPart ? '100%' : '70%';
    var setImage = imagePartNode.children[0];
    setImage.src = plusPart ? rootDirectoryImages + 'plusIcon.png' : rootDirectoryImages + nameRoom + 'Icon.png';
    setImage.alt = plusPart ? 'add icon' : nameRoom + ' icon';

    if (plusPart) {
        setImage.style.minWidth = '70%';
        setImage.style.height = '70%';
        setImage.style.marginTop = '15%';
    }

    //set the text for the specific room
    var textPart = iconPartNode.children[1]; // go to iconPartText
    if (plusPart) {
        textPart.remove();
    }
    textPart.innerHTML = setTextRoom(parameter,true,'');
}

function setTablePart(id_room, id_sensor_db, type_of_sensor, value_of_sensor) {
    var rootDirectoryImages = '../../img/';

    var getRoom = document.getElementById(id_room);
    if (getRoom!=null) {
        var tablePartNode = getRoom.children[1]; // go to tablePart

        var idNode = tablePartNode.children[0]; //go to id="sensor_elements_type_of_sensor"

        var duplicatedNode = idNode.cloneNode([true]);
        duplicatedNode.style.display = "flex";
        duplicatedNode.id = duplicatedNode.id.replace('type_of_sensor', type_of_sensor); // change the id to specific type_of_sensor
        duplicatedNode.id += '_' + id_sensor_db;

        var cellsNode = duplicatedNode.children[0]; // go to tablePartCells
        var getColorOfIcon = window.getComputedStyle(getRoom.children[0], null).getPropertyValue('background-color');
        //when adding a sensor any change in color of the icon cell will modify the one of the sensor cells
        cellsNode.style.backgroundColor = getColorOfIcon;

        var imagePartNode = cellsNode.children[0]; // go to tablePartCellsImage
        var setImage = imagePartNode.children[0];
        setImage.src = rootDirectoryImages + type_of_sensor + 'Icon.png';
        setImage.alt = type_of_sensor + ' icon';

        var textPart = cellsNode.children[1]; // go to tablePartCellsText
        textPart.style.width = '100%';
        if (type_of_sensor=='motion') {
            if (value_of_sensor==1) {
                value_of_sensor = "détectée";
            }
            else if (value_of_sensor==0) {
                value_of_sensor = "non détectée";
            }
        }
        textPart.innerHTML = name_of_sensor[type_of_sensor] + ' ' + value_of_sensor + unit_of_sensor[type_of_sensor];

        getRoom.children[1].appendChild(duplicatedNode);
    }
}

function setTextRoom(id_of_room, defaultValue, text_of_user) {
    /*********************************DOCUMENTATION**************************************\
    |*                                                                                  *|
    |*  If defaultValue is false, the function returns text_of_user.                    *|
    |*  If defaultValue is true, the function checks the room and the number            *|
    |*  in id_of_room.                                                                  *|
    |*                                                                                  *|
    |*  For example, if id_of_room is 'bedroom_0', it will separate bedroom and 0 and   *|
    |*  then bedroom will be changed to 'Chambre' with the table name_of_room.          *|
    |*  At the end, the function returns 'Chambre 0'.                                   *|
    |*                                                                                  *|
    |*  Problem : This function works great if id_of_room is not set with an id from    *|
    |*  the database.                                                                   *|
    |*  With the id of the database, we will have, for example, id="bedroom_10980".     *|
    |*  This function will return 'Chambre 10980' if we want defaultValue to be true.   *|
    |*                                                                                  *|
    \************************************************************************************/

    var text = '';
    if (defaultValue) {
        var number = id_of_room.match(/\d/g);
        number = number==0 ? '' : (Number(number)+1);
        text = id_of_room.match(/[a-z]+/g);
        text = name_of_room[text] + ' ' + number;
    } else {
        text = text_of_user;
    }
    return text;
}


/******************************MODIFICATIONS BY THE USER*********************************/

var _func = function() {setContrast(this)};
var _funcAddRoom = function() {addARoomInDatabase(this)};
var _funcAddSensor = function() {addASensorInDatabase(this)};

var deleted_elements = [];

/**********************************AJAX AND JSON PART************************************/



/****************************************************************************************/


function setContrast(element) {
    if (element.className=='iconPart') {
        var element_sensor = element.nextElementSibling.children;

        if (element.style.WebkitFilter=='contrast(100%)') {
            //see if the icon is unchecked
            element.style.WebkitFilter = 'contrast(30%)'; //check it
            deleted_elements.push(element.parentElement.id); //put the id in the deleted_elements array
            for (var i = 1; i < element_sensor.length; i++) {
                //loop through all the sensors and check all
                //if not, some sensors in the database will not be linked to a room
                element_sensor[i].children[0].style.WebkitFilter = 'contrast(30%)';
                deleted_elements.push(element_sensor[i].id); //put all the sensors in the deleted_elements array
            }
        } else {
            //uncheck all and remove all the elements relative to the actual room in the deleted_elements array
            element.style.WebkitFilter = 'contrast(100%)';
            removeFromArray(deleted_elements, element.parentElement.id);
            for (var i = 1; i < element_sensor.length; i++) {
                element_sensor[i].children[0].style.WebkitFilter = 'contrast(100%)';
                removeFromArray(deleted_elements, element_sensor[i].id);
            }
        }
    }
    else if (element.className=='tablePartCells') {
        if (element.parentElement.parentElement.previousElementSibling.style.WebkitFilter=="contrast(30%)") {
            /*
               See if the room is already checked.
               Do nothing because the sensor is linked to the room and, if we delete the room without the sensor,
               the sensor will be linked to nothing in the database.
            */
        } else {
            //now we can check the sensors one by one
            if (element.style.WebkitFilter=="contrast(30%)") {
                //if checked, uncheck it
                element.style.WebkitFilter = "contrast(100%)";
                removeFromArray(deleted_elements, element.parentElement.id);
            } else {
                element.style.WebkitFilter = "contrast(30%)";
                deleted_elements.push(element.parentElement.id);
            }
        }
    }
}

function addRoomsInDatabase(element) {
    var something;
}

function addSensorsInDatabase(element) {
    var anotherOne;
}

function sendData(data, url) {
  var XHR = new XMLHttpRequest();
  var urlEncodedData = "";
  var urlEncodedDataPairs = [];
  var name;

  // Turn the data object into an array of URL-encoded key/value pairs.
  for(name in data) {
    urlEncodedDataPairs.push(encodeURIComponent(name) + '=' + encodeURIComponent(data[name]));
  }

  // Combine the pairs into a single string and replace all %-encoded spaces to
  // the '+' character; matches the behaviour of browser form submissions.
  urlEncodedData = urlEncodedDataPairs.join('&').replace(/%20/g, '+');

  XHR.open('POST', url);
  XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  XHR.send(urlEncodedData);
}

function setCursorStyle(array, style) {
    for (var i = 0; i < array.length; i++) {
        array[i].style.cursor = style;
    }
}

function removeFromArray(array, element) {
    const index = array.indexOf(element);

    if (index !== -1) {
        //see if the element really exists in the array
        array.splice(index, 1);
    }
}

function addPlusIconForSensors() {
    for (var nameRoom in name_of_room) {
        /* Check all the room.
         * The advantage here is that we can easily add room if we want.
         * For example, if the user want to add winecellar in his room,
         * the admin just has to put it in name_of_room array.
         * But an user cannot create a room by his own.
        */
        if (name_of_room.hasOwnProperty(nameRoom)) {
            var roomClass = document.getElementsByClassName(nameRoom);
            for (var i = 0; i < roomClass.length; i++) {
                var roomID = roomClass[i].id;

                //get the color of the icon
                //if we take the color of a sensor, the sensor could not exist and the color cannot be set
                var iconPartNode = roomClass[i].children[0];
                var get_color = iconPartNode.style.backgroundColor;

                //now we can set the plus icon relative to an existent room
                var tablePartNode = roomClass[i].children[1]; //go to tablePart

                //an existent model is already set (when cloning after keeping the elements from the database)
                duplicatedNode = tablePartNode.children[0].cloneNode([true]); //clone the existent model
                duplicatedNode.children[0].id = 'adding_element_' + roomID; //take the roomID so that we can easily add elements in database

                var tablePartCellsNode = duplicatedNode.children[0];
                tablePartCellsNode.style.backgroundColor = get_color; //set the color relative to the iconPart
                tablePartCellsNode.removeChild(tablePartCellsNode.children[1]); //remove the text

                //set the image
                var imagePartNode = tablePartCellsNode.children[0];
                imagePartNode.style.height = '100%';
                var setImage = imagePartNode.children[0];
                setImage.style.width = 'auto';
                setImage.style.height = '60%';
                setImage.style.marginTop = '10%';
                setImage.src ='../../img/plusIcon.png';
                setImage.alt = 'add icon';

                //add the plus for sensors
                plusNode = duplicatedNode.children[0];
                tablePartNode.appendChild(plusNode);
                plusNode.addEventListener('click', _funcAddSensor);
                plusNode.style.cursor = 'pointer';
            }
        }
    }
}

function add_sensor_room() {
    var mainId = document.getElementById('main');
    var iconPartClass = document.getElementsByClassName('iconPart');
    var tablePartCellsClass = document.getElementsByClassName('tablePartCells');
    document.getElementById('cancel_modifications').style.display = 'block';


    /* SQL query to add rooms without sensors */
    // then addRoom(room, id_room_db)
    // then setIconPart(parentNode)

    /********ADD A ROOM*********/
    addRoom(true, '', '') //true to enable the adding of the plusPart

    /*******ADD A SENSOR********/
    addPlusIconForSensors();


    //set the contrast for all elements except the plus parts
    //to show a real separation between adding and displaying
    for (var i = 1; i < iconPartClass.length-1; i++) {
        iconPartClass[i].style.WebkitFilter = 'contrast(30%)';
        for (var j = 1; j < iconPartClass[i].nextElementSibling.children.length-1; j++) {
            iconPartClass[i].nextElementSibling.children[j].style.WebkitFilter = 'contrast(30%)';
        }
    }

}



function delete_sensor_room() {
    var iconPartClass = document.getElementsByClassName('iconPart');
    var tablePartCellsClass = document.getElementsByClassName('tablePartCells');
    document.getElementById('cancel_modifications').style.display = 'block';

    setCursorStyle(iconPartClass, 'pointer');
    setCursorStyle(tablePartCellsClass, 'pointer');

    for (var i = 1; i < iconPartClass.length; i++) {
        iconPartClass[i].style.WebkitFilter = 'contrast(100%)'; //set the contrast to avoid double click at the beginning
        iconPartClass[i].addEventListener('click', _func);
    }

    for (var i = 1; i < tablePartCellsClass.length; i++) {
        tablePartCellsClass[i].style.WebkitFilter = 'contrast(100%)';
        tablePartCellsClass[i].addEventListener('click', _func);
    }
}


function cancel_modifications() {
    /*var wantToCancel = confirm('Voulez-vous vraiment annuler les modifications?');
    if (wantToCancel) {
        //put the code here if the user presses Ok
    }*/

    /****************************CANCEL ADDING PART*****************************/

    var addRoomClass = document.getElementsByClassName('addingRoom');
    for (var i = 0; i < addRoomClass.length; i++) {
        if (addRoomClass[i] != null) {
            addRoomClass[i].remove();
        }
    }


    for (var nameRoom in name_of_room) {
        if (name_of_room.hasOwnProperty(nameRoom)) {
            var roomClass = document.getElementsByClassName(nameRoom);
            for (var i = 0; i < roomClass.length; i++) {
                var roomID = roomClass[i].id;
                var addID = document.getElementById('adding_element_' + roomID);
                if (addID != null) {
                    addID.remove();
                }
            }
        }
    }

    /***************************************************************************/

    /************************CANCEL DELETING PART*******************************/

    var iconPartClass = document.getElementsByClassName('iconPart');
    var tablePartCellsClass = document.getElementsByClassName('tablePartCells');

    setCursorStyle(iconPartClass, 'auto');
    setCursorStyle(tablePartCellsClass, 'auto');

    deleted_elements = [];

    for (var i = 1; i < iconPartClass.length; i++) {
        iconPartClass[i].style.WebkitFilter = 'contrast(100%)';
        for (var j = 0; j < iconPartClass[i].nextElementSibling.children.length; j++) {
            iconPartClass[i].nextElementSibling.children[j].style.WebkitFilter = 'contrast(100%)';
        }
        iconPartClass[i].removeEventListener('click', _func);
    }

    for (var i = 1; i < tablePartCellsClass.length; i++) {
        tablePartCellsClass[i].style.WebkitFilter = 'contrast(100%)';
        tablePartCellsClass[i].removeEventListener('click', _func);
    }

    /***************************************************************************/


    document.getElementById('cancel_modifications').style.display = 'none';
}
