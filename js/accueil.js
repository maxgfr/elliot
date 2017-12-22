/****************************************ACCUEIL.JS*******************************************\
|*                                                                                           *|
|*  The names of the rooms have to be in lowercase and in english (bedroom, kitchen, etc.).  *|
|*  The names of the sensors have to be in lowercase and in english (temperature,            *|
|*  motion, humidity, etc.).                                                                 *|
|*                                                                                           *|
|*  If we want to add rooms or sensors, keep in mind these rules.                            *|
|*  In this case, the associated tables below have to be set correctly.                      *|
|*  Also, all the images' names will be like <room or sensor>Icon.png                        *|
|*  (e.g. bathroomIcon.png, temperatureIcon.png)                                             *|
|*                                                                                           *|
\*********************************************************************************************/



/***********************************AJAX PART***********************************/

var dbParam, xmlhttp, myObj, x = "";
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        for (x in myObj) {
            addRoom(myObj[x].nameOfRoom, myObj[x].idOfRoom);
            var idRoom = myObj[x].nameOfRoom + '_' + myObj[x].idOfRoom;
            setTablePart(idRoom, myObj[x].nameOfFamilysensor, myObj[x].valueOfSensor);
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


function addRoom(room, id_room_db) {
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

        duplicatedRoomClass.className = room;
        duplicatedRoomClass.id = room+'_'+id_room_db;
        duplicatedRoomClass.style.display = "flex";

        /**********************************ICON PART*********************************/
        setIconPart(duplicatedRoomClass);

        /******************CREATE THE TABLE WITH THE ROOM WE WANT********************/
        mainId.appendChild(duplicatedRoomClass);
    }
}

function setIconPart(parentNode) {
    var rootDirectoryImages = '../../img/';
    var testExistentRoom = document.getElementsByClassName(parentNode.className);
    var lengthExistentRoom = testExistentRoom.length;

    var nameRoom = parentNode.className;

    // go to Icon Part
    iconPartNode = parentNode.children[0];

    // set the color for a specific room
    parameter = nameRoom+'_'+lengthExistentRoom;
    var color = color_of_cells[parameter]!=null ? color_of_cells[parameter] : color_of_cells['default'];
    iconPartNode.style.backgroundColor = color;

    // set the icon for the specific room
    var imagePartNode = iconPartNode.children[0]; // go to iconPartImage
    var setImage = imagePartNode.children[0];
    setImage.src = rootDirectoryImages + nameRoom + 'Icon.png';
    setImage.alt = nameRoom + ' icon';

    //set the text for the specific room
    var textPart = iconPartNode.children[1]; // go to iconPartText
    textPart.innerHTML = setTextRoom(parameter,true,'');
}

function setTablePart(id_room, type_of_sensor, value_of_sensor) {
    var rootDirectoryImages = '../../img/';

    var getRoom = document.getElementById(id_room);
    if (getRoom!=null) {
        var tablePartNode = getRoom.children[1]; // go to tablePart

        var idNode = tablePartNode.children[0]; //go to id="sensor_elements_type_of_sensor"

        var duplicatedNode = idNode.cloneNode([true]);
        duplicatedNode.style.display = "flex";
        duplicatedNode.id = duplicatedNode.id.replace('type_of_sensor', type_of_sensor); // change the id to specific type_of_sensor

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
                value_of_sensor = "OUI";
            }
            else if (value_of_sensor==0) {
                value_of_sensor = "NON";
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

function deco() {
    console.log('deconnexion');
     <?php
        session_destroy();
        Config::movePage('/elliot/mvc/vue/vueConnexion.php');
     ?>
 }
