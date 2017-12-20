color_of_cells = {'bedroom_0' : '#264376',
                  'bedroom_1' : '#DDAC26',
                  'bedroom_2' : '#5F3F5D',
                  'bedroom_3' : '#2E323E',
                  'kitchen_0' : '#C75566',
                  'bathroom_1' : '#219D75',
                  'livingroom_0' : '#E38A21',
                  'bathroom_0' : '#0DBEC8',
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
                  'motion' : 'NON',
                  'humidity' : '%'};

function addRoom(room) {
    var mainId = document.getElementById('main'); //we set to it to append child after

    /*************DUPLICATE ALL THE ELEMENTS IN <div class='room'>*******************/
    var testExistentRoom = document.getElementsByClassName(room); // if no exists, testExistentRoom returns null
    var lengthExistentRoom = testExistentRoom.length;

    var roomClass = document.getElementsByClassName('room');
    roomClass = roomClass[0];
    var duplicatedRoomClass = roomClass.cloneNode([true]);
    //if we do not clone the  <div class='room'> , it is the general class that will be mofified
    //in fact, for example, roomIcon.png will be replaced by bedroomIcon.png and, after that, we will not be able to create other rooms

    duplicatedRoomClass.className = room;
    duplicatedRoomClass.id = room+'_'+lengthExistentRoom;
    //it is possible to not set an id, it is just for ease of implementation,
    duplicatedRoomClass.style.display = "flex";


    /***********************ICON PART**********************/
    setIconPart(duplicatedRoomClass);

    /***********************CREATE THE TABLE WITH THE ROOM************************/
    mainId.appendChild(duplicatedRoomClass);

}

function setIconPart(parentNode) {
    var rootDirectoryImages = '../../img/';

    var nameRoom = parentNode.className;
    idNameRoom = parentNode.id;

    // go to Icon Part
    iconPartNode = parentNode.children[0];

    // set the color for a specific room
    var color = color_of_cells[idNameRoom]!=null ? color_of_cells[idNameRoom] : color_of_cells['default'];
    iconPartNode.style.backgroundColor = color;

    // set the icon for the specific room
    var imagePartNode = iconPartNode.children[0]; // go to iconPartImage
    var setImage = imagePartNode.children[0];
    setImage.src = rootDirectoryImages + nameRoom + 'Icon.png';
    setImage.alt = nameRoom + ' icon';

    //set the text for the specific room
    var textPart = iconPartNode.children[1]; // go to iconPartText
    textPart.innerHTML = setTextRoom(idNameRoom,true,'');

    //set the select values
    setDefaultSelectRoom(idNameRoom,true,'');

}

function setTablePart(room, type_of_sensor) {
    var rootDirectoryImages = '../../img/';

    var getRoom = document.getElementById(room);
    if (getRoom!=null) {
        var tablePartNode = getRoom.children[1]; // go to tablePart

        var idNode = tablePartNode.children[0]; //got id="sensor_elements_type_of_sensor"

        var duplicatedNode = idNode.cloneNode([true]);
        duplicatedNode.style.display = "flex";
        duplicatedNode.id = duplicatedNode.id.replace('type_of_sensor', type_of_sensor); // change the id to specific type_of_sensor

        var cellsNode = duplicatedNode.children[0]; // go to tablePartCells
        var getColorOfIcon = window.getComputedStyle(getRoom.children[0], null).getPropertyValue('background-color');
        //any change in color of the icon cell will modify the one of the sensor cells
        cellsNode.style.backgroundColor=getColorOfIcon;

        var imagePartNode = cellsNode.children[0]; // go to tablePartCellsImage
        var setImage = imagePartNode.children[0];
        setImage.src = rootDirectoryImages + type_of_sensor + 'Icon.png';
        setImage.alt = type_of_sensor + ' icon';

        var textPart = cellsNode.children[1]; // go to tablePartCellsText
        textPart.style.width='100%';
        var value_of_sensor = type_of_sensor!='motion'? Math.floor((Math.random() * 100) + 1):''
        textPart.innerHTML = name_of_sensor[type_of_sensor] + ' ' + value_of_sensor + unit_of_sensor[type_of_sensor];

        getRoom.children[1].appendChild(duplicatedNode);
    }
}


function setCreatingRoom() {
    room = document.getElementById("create_the_room");
    addRoom(room.value);
}

function setSensor() {
    var selectRoom = document.getElementById('select_the_room');
    var value_of_select = selectRoom.value.replace('select', '');
    var selectSensor = document.getElementById('select_the_sensor');
    setTablePart(value_of_select, selectSensor.value);
}

function setTextRoom(id_of_room, defaultValue, text_of_user) {
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

function setDefaultSelectRoom(id_of_room,defaultValue, text_of_user) {
    var selectTable = document.getElementById('select_the_room');
    name_of_value = 'select'+id_of_room;
    var option = document.createElement('option');
    option.value = name_of_value;
    option.text = setTextRoom(id_of_room,defaultValue,text_of_user);
    selectTable.add(option);
}
