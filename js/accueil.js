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
    |*  A part has been added to deal with the case of adding rooms and sensors.        *|
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
        var mainId = document.getElementById('main_home'); //we set to it to append child after

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

var deleted_elements = [];

/******************************INTERMEDIATE FUNCTIONS*********************************/


/**THIS PART IS VERY AWFUL, DID NOT FIND ANOTHER SOLUTION**/
/**IT IS USED TO SET THE CSS OF BEFORE PARTS **/
/**HERE IT CREATES ANOTHER CLASS WHERE WE MODIFIED THE BEFORE PART**/
var UID = {
	_current: 0,
	getNew: function(){
		this._current++;
		return this._current;
	}
};

HTMLElement.prototype.pseudoStyle = function(element,prop,value){
	var _this = this;
	var _sheetId = "pseudoStyles";
	var _head = document.head || document.getElementsByTagName('head')[0];
	var _sheet = document.getElementById(_sheetId) || document.createElement('style');
	_sheet.id = _sheetId;
	var className = "pseudoStyle" + UID.getNew();

	_this.className +=  " "+className;

	_sheet.innerHTML += " ."+className+":"+element+"{"+prop+":"+value+"}";
	_head.appendChild(_sheet);
	return this;
};


function darkenColor(color, percentage) {
    /*********************************DOCUMENTATION**************************************\
    |*                                                                                  *|
    |*  This function darkens a color passed in parameter by a percentage               *|
    |*  set by the user.                                                                *|
    |*                                                                                  *|
    |*  It splits the rgb code and decreases the 3 values by the percentage (e.g. 0.2). *|
    |*  If we want to lighten, percentage has to be set negative.                       *|
    |*                                                                                  *|
    \************************************************************************************/
    rgb = color.replace(/[^\d,]/g, '').split(',');
    for (var i = 0; i < rgb.length; i++) {
        rgb[i] = Number(rgb[i]);
        rgb[i] = (1-percentage)*rgb[i];
    }
    color = 'rgb(' + rgb[0] + ', ' + rgb[1] + ', ' + rgb[2] + ')';
    return color;
}


function removeFromArray(array, element) {
    const index = array.indexOf(element);

    if (index !== -1) {
        //see if the element really exists in the array
        array.splice(index, 1);
    }
}


function setCursorStyle(array, style) {
    /** Array is a document.getElementsByClassName **/
    for (var i = 0; i < array.length; i++) {
        array[i].style.cursor = style;
    }
}


/****************************************************************************************/


/**********************************AJAX AND JSON PART************************************/

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


/****************************************************************************************/


/********************************CHANGING IN INTERFACE**************************************/

function setContrast(element) {
    /*********************************DOCUMENTATION**************************************\
    |*                                                                                  *|
    |*  When clicking on an element, this element becomes darker than initially.        *|
    |*  After that, the element is pushed into the deleted_elements array.              *|
    |*                                                                                  *|
    |*  If the element is dark initially, when clicking the element becomes lighter.    *|
    |*  After that the clicked element is remoived from the deleted_elements array.     *|
    |*                                                                                  *|
    \************************************************************************************/
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



function addPlusIconForSensors(roomClassName, addToDatabase) {
    /*********************************DOCUMENTATION**************************************\
    |*                                                                                  *|
    |*  When the user wants to add rooms and sensors, we set the plus icon.             *|
    |*                                                                                  *|
    |*  It is similar to the function setIconPart.                                      *|
    |*                                                                                  *|
    \************************************************************************************/
    var roomClass = document.getElementsByClassName(roomClassName);
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
        setImage.style.minWidth = '60%';
        setImage.style.width = 'auto';
        setImage.style.height = '60%';
        setImage.style.marginTop = '10%';
        setImage.src ='../../img/plusIcon.png';
        setImage.alt = 'add icon';

        //add the plus for sensors
        plusNode = duplicatedNode.children[0];
        if (addToDatabase) {
            if (roomID.includes('toAdd')) {
                tablePartNode.appendChild(plusNode);
            }
        } else {
            if (!roomID.includes('toAdd')) {
                tablePartNode.appendChild(plusNode);
            }
        }
        plusNode.addEventListener('click', _funcAddSensor);
        plusNode.style.cursor = 'pointer';
    }
}



function createScrollBox(element, type) {
    /*********************************DOCUMENTATION**************************************\
    |*                                                                                  *|
    |*  ScrollBox for adding rooms or sensors.                                          *|
    |*                                                                                  *|
    |*  Problem : not responsive at all.                                                *|
    |*  If the cell containing the icon of room or sensor is smaller than normal,       *|
    |*  the scrollbox will not be placed near the cell.                                 *|
    |*                                                                                  *|
    \************************************************************************************/
    if (type=='sensor') {
        var box = document.getElementsByClassName('navigationSensor');
        box = box[0];
    }
    else if (type=='room') {
        var box = document.getElementsByClassName('navigationRoom');
        box = box[0];
    }

    duplicatedBox = box.cloneNode([true]);
    element.appendChild(duplicatedBox);
    if (type=='sensor') {
        var getColor = duplicatedBox.parentElement.style.backgroundColor;

    }
    else if (type=='room') {
        var getColor = element.children[0].style.backgroundColor;
        duplicatedBox.style.marginLeft = '9.5em';
        duplicatedBox.style.marginTop = '0.65em';
        duplicatedBox.children[0].style.width = '11em';
    }

    for (var i = 0; i < duplicatedBox.children[0].children.length; i++) {
        duplicatedBox.children[0].children[i].style.paddingLeft = '1em';
    }

    duplicatedBox.style.display = 'flex';
    if (!duplicatedBox.previousElementSibling.className.includes('pseudoStyle1')) {
        duplicatedBox.pseudoStyle("before", "border-color", "transparent "+getColor+" transparent transparent");
    }
    duplicatedBox.style.backgroundColor = getColor;

    var liPart = duplicatedBox.children[0].children;
    getRoomID = duplicatedBox.parentElement.id;
    for (var i = 0; i < liPart.length; i++) {
        if (type=='sensor') {
            liPart[i].id = getRoomID + '_' + liPart[i].id;
            liPart[i].style.backgroundColor = getColor;
        }
        liPart[i].addEventListener("mouseout",
        function(event) {event.target.style.backgroundColor = getColor;});
        liPart[i].addEventListener("mouseover",
        function(event) {event.target.style.backgroundColor = darkenColor(getColor, 0.3) ;});
        liPart[i].addEventListener("click",
        function(event) {event.target.style.backgroundColor = getColor ;});
    }
}

function createDeleteButton(added, type) {
    var delete_button = document.createElement("SPAN");
    delete_button.id = added.id.replace('toAdd', 'delete');
    delete_button.style.position = 'absolute';
    delete_button.style.display = 'block';
    if (type=='sensor') {
        delete_button.style.top = '0px';
    }
    else if (type=='room') {
        delete_button.style.top = '-10px';
    }
    delete_button.style.right = '-1em';
    delete_button.style.width = '1.7em';
    delete_button.style.height = '1.7em';
    delete_button.style.lineHeight = delete_button.style.height;
    delete_button.style.borderRadius = '100%';
    delete_button.style.border = '0.2em solid #C3C3C3';
    delete_button.style.background = "url('../../img/crossIconDelete.png')";
    delete_button.style.backgroundColor = '#F3F3F3';
    delete_button.style.backgroundSize = 'contain';
    delete_button.style.backgroundRepeat = 'no-repeat';
    delete_button.style.textAlign = 'center';
    delete_button.style.cursor = 'pointer';
    added.children[0].appendChild(delete_button);
    if (type=='sensor') {
        delete_button.addEventListener('click', function(){this.parentElement.parentElement.remove()});
    }
    else if (type=='room') {
        delete_button.addEventListener('click', function(){this.parentElement.parentElement.parentElement.remove()});
    }
}

var _funcAddRoom = function() {addRoomsInDatabase(this)};
var _funcAddSensor = function() {addSensorsInDatabase(this)};
var _funcSetSensors = function() {setSensorsToAdd(this)};

function setSensorsToAdd(target) {
    if (target.id.includes('toAdd_database')) {
        var addToCreatedRoom = true;
    }
    var splitting = target.id.replace('adding_element_', '').replace('_database', '').split('_');
    if (addToCreatedRoom) {
        var id_room = splitting[0] + '_' + splitting[1] + '_' + splitting[2] + '_' + splitting[3];
        var type_of_sensor = splitting[4];
    } else {
        var id_room = splitting[0] + '_' + splitting[1];
        var type_of_sensor = splitting[2];
    }
    var id_sensor_db = '974';
    var value_of_sensor = 'Valeur ';
    splitting = [];
    setTablePart(id_room, id_sensor_db, type_of_sensor, value_of_sensor);
    var added = document.getElementById('sensor_elements_' + type_of_sensor + '_974');
    var i = 1;
    while (document.getElementById(id_room + '_' + type_of_sensor + '_number_' + String(i) + '_toAdd')!=null) {
        i++;
    }
    added.id = id_room + '_' + type_of_sensor + '_number_' + String(i) + '_toAdd';
    added.style.position = 'relative';

    /***CREATE THE DELETE BUTTON IF THE USER DOES NOT WANT THE SENSOR*/
    createDeleteButton(added, 'sensor');
    /*****************************************************************/

    var plusPart = target.parentElement.parentElement.parentElement;
    plusPart.parentElement.appendChild(plusPart); //put it at the end
}




function addSensorsInDatabase(element) {
    createScrollBox(element, 'sensor');
    liPart = element.children[1].children[0].children;
    element.removeEventListener('click', _funcAddSensor);
    for (var i = 0; i < liPart.length; i++) {
        liPart[i].addEventListener('click', _funcSetSensors);
    }
}

_funcSetRooms = function() {setRoomsToAdd(this)};

function setRoomsToAdd(target) {
    var room = target.id.replace('database_', '');
    addRoom(false, room, '974');
    var added = document.getElementById(room+'_974');
    var i = 1;
    while (document.getElementById(room + '_number_' + String(i) + '_toAdd')!=null) {
        i++;
    }
    added.id = room + '_number_' + String(i) + '_toAdd';
    var iconPartNode = added.children[0];
    iconPartNode.style.position = 'relative';
    createDeleteButton(iconPartNode, 'room');
    addPlusIconForSensors(added.className, true);
    var plusPart = target.parentElement.parentElement.parentElement;
    plusPart.parentElement.appendChild(plusPart); //put it at the end
    //createDeleteButton(target);
}

function addRoomsInDatabase(element) {
    createScrollBox(element, 'room');
    liPart = element.children[2].children[0].children;
    element.removeEventListener('click', _funcAddRoom);
    for (var i = 0; i < liPart.length; i++) {
        liPart[i].addEventListener('click', _funcSetRooms);
    }
}


function setArrayCreatedRooms() {
    var arrayCreatedRoom = [];
    for (var nameRoom in name_of_room) {
        if (name_of_room.hasOwnProperty(nameRoom)) {
            var getRoom = document.getElementsByClassName(nameRoom);
            for (var i = 0; i < getRoom.length; i++) {
                if (getRoom[i].id.includes('toAdd')) {
                    arrayCreatedRoom.push(getRoom[i].id);
                }
            }
        }
    }
    return arrayCreatedRoom;
}

function setArrayExistentRooms() {
    var arrayExistentRoom = [];
    var tablePartNode = document.getElementsByClassName('tablePart');
    for (var i = 0; i < tablePartNode.length; i++) {
        for (var j = 0; j < tablePartNode[i].children.length; j++) {
            if (tablePartNode[i].children[j].id.includes('toAdd')) {
                arrayExistentRoom.push(tablePartNode[i].children[j].id);
            }
        }
    }
    return arrayExistentRoom;
}

/********************************WHEN CLICKING THE BUTTONS**************************************/

var _funcAddSensorRoom = function() {add_sensor_room(this)};
var _funcAddToDatabase = function() {add_to_database(this)};

function add_sensor_room(target) {
    var mainId = document.getElementById('main');
    var iconPartClass = document.getElementsByClassName('iconPart');
    var tablePartCellsClass = document.getElementsByClassName('tablePartCells');
    document.getElementById('add_sensor_room').style.display = 'block';
    document.getElementById('delete_sensor_room').style.display = 'none';
    document.getElementById('cancel_modifications').style.display = 'block';


    /* SQL query to add rooms without sensors */
    // then addRoom(room, id_room_db)
    // then setIconPart(parentNode)

    /********ADD A ROOM*********/
    addRoom(true, '', '') //true to enable the adding of the plusPart

    /*******ADD A SENSOR********/
    for (var nameRoom in name_of_room) {
        /* Check all the room.
         * The advantage here is that we can easily add room if we want.
         * For example, if the user want to add a winecellar in his house,
         * the admin just has to put it in name_of_room array.
         * But users cannot create a room by their own.
        */
        if (name_of_room.hasOwnProperty(nameRoom)) {
            addPlusIconForSensors(nameRoom, false);
        }
    }


    //set the contrast for all elements except the plus parts
    //to show a real separation between adding and displaying parts
    for (var i = 1; i < iconPartClass.length-1; i++) {
        iconPartClass[i].style.WebkitFilter = 'contrast(30%)';
        for (var j = 1; j < iconPartClass[i].nextElementSibling.children.length-1; j++) {
            iconPartClass[i].nextElementSibling.children[j].style.WebkitFilter = 'contrast(30%)';
        }
    }

    target.removeEventListener('click', _funcAddSensorRoom);
    target.innerHTML = 'Ajouter les éléments sélectionnés';
    target.addEventListener('click', _funcAddToDatabase);

}

function add_to_database(target) {
    var arrayCreatedRoom = setArrayCreatedRooms();
    for (var i = 0; i < arrayCreatedRoom.length; i++) {
        if (arrayCreatedRoom[i].includes('adding_element')) {
            removeFromArray(arrayCreatedRoom, arrayCreatedRoom[i]);
        }
    }
    var arrayExistentRoom = setArrayExistentRooms();
    for (var i = 0; i < arrayExistentRoom.length; i++) {
        if (arrayExistentRoom[i].includes('adding_element')) {
            removeFromArray(arrayExistentRoom, arrayExistentRoom[i]);
        }
    }
    cancel_modifications(false);
    console.log('arrayCreatedRoom = ', arrayCreatedRoom);
    console.log('arrayExistentRoom = ', arrayExistentRoom);
    target.removeEventListener('click', _funcAddToDatabase);
    target.innerHTML = 'Ajouter des capteurs et des pièces';
    target.addEventListener('click', _funcAddSensorRoom);
}

var _funcDeleteSensorRoom = function() {delete_sensor_room(this)};
var _funcDeleteFromDatabase = function() {delete_from_database(this)};


function delete_sensor_room(target) {
    var iconPartClass = document.getElementsByClassName('iconPart');
    var tablePartCellsClass = document.getElementsByClassName('tablePartCells');

    scroll(0,0); //go to top of the page
    document.getElementById('add_sensor_room').style.display = 'none';
    document.getElementById('delete_sensor_room').style.display = 'block';
    document.getElementById('delete_sensor_room').style.marginLeft = '0';
    document.getElementById('information_delete').style.display = 'block';
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

    target.removeEventListener('click', _funcDeleteSensorRoom);
    target.innerHTML = 'Supprimer les éléments sélectionnés';
    target.addEventListener('click', _funcDeleteFromDatabase);

}

function delete_from_database(target) {
    console.log('deleted_elements = ', deleted_elements);
    cancel_modifications(false);
    target.removeEventListener('click', _funcDeleteFromDatabase);
    target.innerHTML = 'Supprimer des capteurs et des pièces';
    target.addEventListener('click', _funcDeleteSensorRoom);
}

var _funcCancelModifications = function() {cancel_modifications(true)};

function cancel_modifications(real) {
    if (real) {
        var condition = confirm('Voulez-vous vraiment annuler les modifications?');
    } else {
        var condition = true;
    }
    if (condition) {
        /****************************CANCEL ADDING PART*****************************/

        document.getElementById('add_sensor_room').innerHTML = 'Ajouter des capteurs et des pièces';

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

        var arrayCreatedRoom = setArrayCreatedRooms();
        var arrayExistentRoom = setArrayExistentRooms();

        for (var i = 0; i < arrayExistentRoom.length; i++) {
            document.getElementById(arrayExistentRoom[i]).remove();
        }

        for (var i = 0; i < arrayCreatedRoom.length; i++) {
            document.getElementById(arrayCreatedRoom[i]).remove();
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

        document.getElementById('information_delete').style.display = 'none';
        document.getElementById('add_sensor_room').style.display = 'block';
        document.getElementById('delete_sensor_room').style.marginLeft = '2%';
        document.getElementById('delete_sensor_room').style.display = 'block';
        document.getElementById('delete_sensor_room').innerHTML = 'Supprimer des capteurs et des pièces';
        /***************************************************************************/


        document.getElementById('cancel_modifications').style.display = 'none';
        scroll(0,0);
    }

}
