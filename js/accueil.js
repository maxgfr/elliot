
function addSensor(room, type_of_sensor) {

    var roomIsBedroom = document.getElementsByClassName("bedroom");
    var roomIsLivingroom = document.getElementsByClassName("livingroom");
    var roomIsKitchen = document.getElementsByClassName("kitchen");
    var roomIsBathroom = document.getElementsByClassName("bathroom");
    var roomIsWinecellar = document.getElementsByClassName("winecellar");

    elementTemperature = document.getElementById("sensorElementsTemperature");
    elementLuminosity = document.getElementById("sensorElementsLuminosity");
    elementHumidity = document.getElementById("sensorElementsHumidity");
    elementMotion = document.getElementById("sensorElementsMotion");
    elementBarometer = document.getElementById("sensorElementsBarometer");

    switch (type_of_sensor) {
        case "temperature":
            var node = elementTemperature.children[0];
            break;
        case "motion":
            var node = elementMotion.children[0];
            break;
        case "luminosity":
            var node = elementLuminosity.children[0];
            break;
        case "barometer":
            var node = elementBarometer.children[0];
            break;
        case "humidity":
            var node = elementHumidity.children[0];
            break;
        default:
            var node = null;
    }
    if (node!=null) {
        var duplicatedNode = node.cloneNode([true]);
        var name = duplicatedNode.className;
        switch (room) {
            case "bedroom":
                var string = roomIsBedroom[0].children[0].cloneNode([false]).className;
                string = string.replace("iconPart ", "");
                name = name.replace('listOfSensorsColor', string);
                duplicatedNode.className = name;
                roomIsBedroom[0].children[1].appendChild(duplicatedNode);
                break;
            case "bathroom":
                var string = roomIsBathroom[0].children[0].cloneNode([false]).className;
                string = string.replace("iconPart ", "");
                name = name.replace('listOfSensorsColor', string);
                duplicatedNode.className = name;
                roomIsBathroom[0].children[1].appendChild(duplicatedNode);
                break;
            case "livingroom":
                var string = roomIsLivingroom[0].children[0].cloneNode([false]).className;
                string = string.replace("iconPart ", "");
                name = name.replace('listOfSensorsColor', string);
                duplicatedNode.className = name;
                roomIsLivingroom[0].children[1].appendChild(duplicatedNode);
                break;
            case "kitchen":
                var string = roomIsKitchen[0].children[0].cloneNode([false]).className;
                string = string.replace("iconPart ", "");
                name = name.replace('listOfSensorsColor', string);
                duplicatedNode.className = name;
                roomIsKitchen[0].children[1].appendChild(duplicatedNode);
                break;
            case "winecellar":
                var string = roomIsWinecellar[0].children[0].cloneNode([false]).className;
                string = string.replace("iconPart ", "");
                name = name.replace('listOfSensorsColor', string);
                duplicatedNode.className = name;
                roomIsWinecellar[0].children[1].appendChild(duplicatedNode);
                break;
            default:
        }
    }
}

function setNamesOfRoomAndSensor() {
    room = document.getElementById("select_the_room");
    sensor = document.getElementById("select_the_sensor");
    addSensor(room.value, sensor.value);
}

function getNameOfChildDiv(nodeParent) {
    /*******************************DOCUMENTATION********************************\
    |*                                                                          *|
    |*   This function takes a node in parameter and returns an array           *|
    |*   which contains all the div's class names of its childs.                *|
    |*                                                                          *|
    |*   If a node has 2 class names, the array will be something like          *|
    |*   array ["firstClass secondClass", "otherClass"].                        *|
    |*                                                                          *|
    |*   A function has to be created to get these 2 classes if exist.          *|
    |*                                                                          *|
    \* **************************************************************************/
}
