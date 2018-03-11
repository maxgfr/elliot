/*************************************** FUNCTIONS *******************************************\
|*                                                                                           *|
|*  All the functions created in this file will be presented here.                           *|
|*                                                                                           *|
|*********************************************************************************************|
|********************************* INTERMEDIATE FUNCTIONS ************************************|
|*                                                                                           *|
|*  chooseUniqueRandomData : returns an array which contains unique elements extracted       *|
|*                           from an array given in parameter.                               *|
|*                                                                                           *|
|*  getControlPoints : returns an array which contains the control points to draw            *|
|*                     a cubic bezier curve.                                                 *|
|*                                                                                           *|
|*  createLinearGrid : creates an orthogonal grid from values of an array given in           *|
|*                     parameter. It is possible to hide vertical and/or horizontal lines.   *|
|*                                                                                           *|
|*  createPolarGrid : creates a polar grid.                                                  *|
|*                                                                                           *|
|*  createPoint : creates a point in a canva. The position (Abscissa and Ordinate),          *|
|*                the radius and the color have to be set.                                   *|
|*                                                                                           *|
|*  createLegend : creates the legend of pie, doughnut and polar area charts.                *|
|*                                                                                           *|
|************************************ CHART FUNCTIONS ****************************************|
|*                                                                                           *|
|*  createVerticalBarChart : creates a vertical bar chart. The linear grid is set.           *|
|*                                                                                           *|
|*  createLineChart : creates a line chart with points joined by a curve or straight lines.  *|
|*                    This function calls the linear grid and the getControlPoints           *|
|*                    function.                                                              *|
|*                    Strength : 0 -> straight line | 0.5 -> smooth curve                    *|
|*                                                                                           *|
|*  createPieChart : create a pie chart.                                                     *|
|*                                                                                           *|
|*  createDoughnutChart : creates a pie chart and puts a white disk in the middle.           *|
|*                                                                                           *|
\*********************************************************************************************/


function chooseUniqueRandomData(numberOfData) {
    /*************************************** WHAT IS IT ******************************************\
    |*                                                                                           *|
    |*  This function takes in parameters an array and an integer numberOfData.                  *|
    |*  It returns an array that contains numberOfData unique elements extracted from            *|
    |*  the initial array where they are chosen randomly.                                        *|
    |*                                                                                           *|
    |*  This function was initially created to set different colors in a pie chart.              *|
    |*                                                                                           *|
    \*********************************************************************************************/

    var unique_array = [];
    var colorTable = ['#264376', '#DDAC26', '#D6B6E7', '#C75566', '#0DBEC8', '#219D75', '#E38A21', '#B87E59', '#2E75B5', '#D3D3D3'];
    if (numberOfData <= colorTable.length) {
        while (unique_array.length != numberOfData) {
            var random = Math.floor((Math.random() * colorTable.length) + 0);
            unique_array.push(colorTable[random]);
            colorTable.splice(random, 1); //delete the color chosen by the random
        }
    }

    return unique_array;
}


function getControlPoints(x0, y0, x1, y1, x2, y2, strength) {
    /*************************************** WHAT IS IT ******************************************\
    |*                                                                                           *|
    |*  Copyright 2010 by Robin W. Spencer                                                       *|
    |*  Function taken from http://scaledinnovation.com/analytics/splines/aboutSplines.html      *|
    |*  This function gives the control points of the bezier curve between 3 points refered as   *|
    |*  the strength of the shape.                                                               *|
    |*                                                                                           *|
    \*********************************************************************************************/

    var d01 = Math.sqrt(Math.pow(x1 - x0, 2) + Math.pow(y1 - y0, 2));
    var d12 = Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
    var fa = strength * d01 / (d01 + d12); // Scaling factor for triangle Ta.
    var fb = strength * d12 / (d01 + d12); // Ditto for Tb, simplifies to fb=t-fa.
    var p1x = x1 - fa * (x2 - x0); // x2-x0 is the width of triangle T.
    var p1y = y1 - fa * (y2 - y0); // y2-y0 is the height of T.
    var p2x = x1 + fb * (x2 - x0);
    var p2y = y1 + fb * (y2 - y0);
    return [p1x, p1y, p2x, p2y];
}


function createLinearGrid(canvas, context, xArray, yArray, yMin, max, showHorizontalLines, showVerticalLines) {

    /*******************GET GLOBAL PROPERTIES*******************/
    var height_of_canvas = canvas.style.height;
    height_of_canvas = Number(height_of_canvas.replace('px', ''));
    var width_of_canvas = canvas.style.width;
    width_of_canvas = Number(width_of_canvas.replace('px', ''));


    /***************SET PROPERTY FOR THE TITLE******************/
    var height_of_title = 0.05 * height_of_canvas;


    /**************SET PROPERTIES FOR THE AXIS******************/
    var height_of_ordinate = 0.85 * height_of_canvas;
    var length_of_abscissa = 0.8 * width_of_canvas;

    var number_of_points_abscissa = xArray.length;


    /***********************CREATE THE GRID********************/
    context.strokeStyle = '#E3E3E3';
    if (showVerticalLines) {
        /*Vertical lines*/
        for (var i = 1; i < number_of_points_abscissa + 1; i++) {
            context.beginPath();
            context.moveTo(0.1 * width_of_canvas + i * length_of_abscissa / number_of_points_abscissa,
                height_of_canvas - height_of_title - 0.1 * height_of_canvas - 1);
            context.lineTo(0.1 * width_of_canvas + i * length_of_abscissa / number_of_points_abscissa,
                2 * height_of_title);
            context.stroke();
            context.closePath();
        }
    }

    if (showHorizontalLines) {
        /*Horizontal lines*/
        for (var i = 2; i < 11; i++) {
            context.beginPath();
            context.moveTo(0.1 * width_of_canvas + 1,
                2 * height_of_title + height_of_ordinate - 0.1 * i * height_of_ordinate);
            context.lineTo(0.1 * width_of_canvas + 1 + length_of_abscissa,
                2 * height_of_title + height_of_ordinate - 0.1 * i * height_of_ordinate);
            context.stroke();
            context.closePath();

        }

    }


    /***********************CREATE THE AXIS********************/
    context.strokeStyle = 'black';
    /*Abscissa*/
    context.beginPath();
    context.moveTo(0.1 * width_of_canvas,
        height_of_canvas - height_of_title - 0.1 * height_of_canvas);
    context.lineTo(0.1 * width_of_canvas + length_of_abscissa,
        height_of_canvas - height_of_title - 0.1 * height_of_canvas);
    context.stroke();
    context.closePath();

    /*Ordinate*/
    context.beginPath();
    context.moveTo(0.1 * width_of_canvas,
        height_of_canvas - height_of_title - 0.1 * height_of_canvas);
    context.lineTo(0.1 * width_of_canvas,
        2 * height_of_title);
    context.stroke();
    context.closePath();

    /*Ordinate values function of the max parameter*/
    for (var i = 0; i < 10; i++) {
        context.textAlign = 'right';
        context.font = String(height_of_title / 1.3) + 'px sans-serif';
        context.beginPath();
        context.fillText(Math.trunc(i * max / 9), 0.09 * width_of_canvas + 1, 2 * height_of_title + height_of_ordinate - 0.1 * (i + 1) * height_of_ordinate);
        context.closePath();
    }

    /*Abscissa values function of the xArray*/
    context.moveTo(0.15 * width_of_canvas, height_of_canvas - height_of_title - 0.1 * height_of_canvas - 1);
    for (var i = 0; i < number_of_points_abscissa; i++) {
        var rotation = Math.PI / 3.5;
        context.beginPath();
        context.save();
        context.textAlign = 'right';
        context.font = 'bold ' + String(0.28 * height_of_canvas / xArray[i].length) + 'px sans-serif';
        context.translate(0.12 * width_of_canvas + i * length_of_abscissa / number_of_points_abscissa,
            height_of_canvas - height_of_title / 3.9 - 0.1 * height_of_canvas - 1);
        context.rotate(-rotation);
        context.fillText(xArray[i], 0, 0);
        context.restore();
        context.closePath();
    }

}


function createPolarGrid(canvas, context, max) {
    /*******************GET GLOBAL PROPERTIES*******************/
    var height_of_canvas = canvas.style.height;
    height_of_canvas = Number(height_of_canvas.replace('px', ''));
    var width_of_canvas = canvas.style.width;
    width_of_canvas = Number(width_of_canvas.replace('px', ''));


    /***************SET PROPERTY FOR THE TITLE******************/
    var height_of_title = 0.05 * height_of_canvas;


    /*********************SET THE GRID*******************/
    var radius = width_of_canvas / 4;
    var xCenter = 0.05 * width_of_canvas + radius;
    var yCenter = 0.15 * height_of_canvas + radius;
    context.lineWidth = radius / 60;
    context.strokeStyle = '#D3D3D3';
    context.font = String(height_of_title) + 'px sans-serif';



    set_new_max = Math.ceil(max / 10) * 10; // To round the max to the nearest 10.
    for (var i = 1; i < 6; i++) {
        context.beginPath();
        context.arc(xCenter, yCenter, i * radius / 5, 0, 2 * Math.PI, false);
        context.stroke();
        context.textAlign = 'center';
        context.fillText(i * set_new_max / 5, xCenter, yCenter - i * radius / 5);
        context.closePath();
    }

}


function createPoint(context, xPos, yPos, radius, color) {
    context.beginPath();
    context.arc(xPos, yPos, radius, 0, 2 * Math.PI, true);
    context.closePath();
    context.fillStyle = color;
    context.fill();
}


function createLegend(canvas, context, array, colorArray) {
    /*************************************** WHAT IS IT ******************************************\
    |*                                                                                           *|
    |*  Creates the legend for pie, doughnut and polar area charts.                              *|
    |*  Arrays must contain the text for the legend (e.g. 20% Température).                      *|
    |*  When taking the values from the database, these values must be transformed before        *|
    |*  setting it to the array.                                                                 *|
    |*                                                                                           *|
    \*********************************************************************************************/

    /*******************GET GLOBAL PROPERTIES*******************/
    var height_of_canvas = canvas.style.height;
    height_of_canvas = Number(height_of_canvas.replace('px', ''));
    var width_of_canvas = canvas.style.width;
    width_of_canvas = Number(width_of_canvas.replace('px', ''));


    /***************SET PROPERTY FOR THE TITLE******************/
    var height_of_title = 0.07 * height_of_canvas;

    context.font = String(0.03 * width_of_canvas) + 'px sans-serif';
    context.textAlign = 'left';
    for (var i = 0; i < array.length; i++) {
        context.fillStyle = colorArray[i];
        context.fillRect(0.6 * width_of_canvas, 2 * height_of_title + 0.85 * i * height_of_canvas / array.length, 0.03 * width_of_canvas, 0.03 * width_of_canvas);
        context.fillText(array[i], 0.64 * width_of_canvas, 2 * height_of_title + 0.85 * i * height_of_canvas / array.length + 0.026 * width_of_canvas);
    }

}


/*
 **********
 ****************
 **********************
 ******************************
 **************************************
 **********************************************
 *******************************************************
 *   CHART FUNCTIONS     **************************************
 *******************************************************
 **********************************************
 **************************************
 ******************************
 **********************
 ****************
 **********
 */


// Draw the curve in graphs according to arbitrarily given data.
function draw() {
    var canvas_bar = document.getElementById('canvas_bar');
    var canvas_polar = document.getElementById('canvas_polar');
    var canvas_pie = document.getElementById('canvas_pie');
    var canvas_line = document.getElementById('canvas_line');
    var canvas_doughnut = document.getElementById('canvas_doughnut');
    var canvas_boundary = document.getElementById('canvas_boundary');
    var canvas = [];
    ctx = [];
    canvas.push(canvas_bar);
    canvas.push(canvas_polar);
    canvas.push(canvas_pie);
    canvas.push(canvas_line);
    canvas.push(canvas_doughnut);
    canvas.push(canvas_boundary);
    for (var i = 0; i < canvas.length; i++) {
        canvas[i].width = 2700;
        canvas[i].height = 1680;
        canvas[i].style.width = "450px";
        canvas[i].style.height = "280px";
        if (canvas[i].getContext) {
            ctx[String(canvas[i].id)] = canvas[i].getContext('2d');
            ctx[String(canvas[i].id)].scale(6, 6);
        }
    }

    for (var type_of_chart in charts) {
        if (charts.hasOwnProperty(type_of_chart)) {
            getData(charts[type_of_chart], charts[type_of_chart]['type_of_sensor'], charts[type_of_chart]['room'], charts[type_of_chart]['frequency']);
        }
    }
}

function getData(type_of_chart, type_of_sensor, type_of_room, frequency) {

    /******************************AJAX AND JSON PART*******************************/

    var xmlhttp, myObj, x = "";
    xmlhttp = new XMLHttpRequest();

    var array_date = [];
    var array_value = [];

    name_of_sensor = {
        'temperature': 'Température',
        'barometer': 'Pression atm',
        'luminosity': 'Luminosité',
        'motion': 'Présence',
        'humidity': 'Humidité'
    };

    if (frequency=='2017-%-01') {
        var arrayToSend = ['month', type_of_room, type_of_sensor, frequency];
        dbParam = JSON.stringify(arrayToSend);

        if (type_of_room=='bedroom') {
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    myObj = JSON.parse(this.responseText);
                    for (x in myObj) {
                        var splitting = myObj[x].dateTimeArray.split('-');
                        var date = splitting[1] + ' ' + splitting[0]
                        array_date.push(date);
                        array_value.push(parseInt(myObj[x].valueArray));
                    }
                    createVerticalBarChart(canvas_bar, ctx['canvas_bar'], array_date, array_value, 110, '#264376', 'Luminosité dans la chambre en 2017');
                }
            };
        }
        if (type_of_room=='kitchen') {
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    myObj = JSON.parse(this.responseText);
                    for (x in myObj) {
                        var splitting = myObj[x].dateTimeArray.split('-');
                        var date = splitting[1] + ' ' + splitting[0]
                        array_date.push(date);
                        array_value.push(parseInt(-myObj[x].valueArray));
                    }
                    createLineChart(canvas_line, ctx['canvas_line'], array_date, array_value, 70, '', 'Humidité dans la cuisine en 2017', 0.5, false);
                }
            };
        }
    }
    if (frequency.includes('last')) {
        frequency = '-'+frequency.split('_')[1] //get the number of days
        var arrayToSend = ['last', type_of_room, type_of_sensor, frequency];

        dbParam = JSON.stringify(arrayToSend);

        if (type_of_sensor=='temperature') {
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    myObj = JSON.parse(this.responseText);
                    for (x in myObj) {
                        var splitting = myObj[x].dateTimeArray.split('-');
                        if (splitting[1]=='01') {
                            splitting[1] = 'Janv';
                        }
                        if (splitting[1]=='02') {
                            splitting[1] = 'Fév';
                        }
                        var date = splitting[2] + ' ' + splitting[1];
                        array_date.push(date);
                        array_value.push(parseInt(-myObj[x].valueArray));
                    }
                    var array_value2 = [];
                    var array_date2 = [];
                    for (var i = 0; i < array_value.length; i++) {
                        if (i<10) {
                            array_date2.push(array_date[i]);
                            array_value2.push(array_value[i]);
                        }
                    }
                    createLineChart(canvas_boundary, ctx['canvas_boundary'], array_date2, array_value2, 30, '', 'Température dans le salon les 10 derniers jours', 0, false);
                }
            };
        }
        if (type_of_sensor=='luminosity') {
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    myObj = JSON.parse(this.responseText);
                    for (x in myObj) {
                        var splitting = myObj[x].dateTimeArray.split('-');
                        if (splitting[1]=='01') {
                            splitting[1] = 'Janvier';
                        }
                        if (splitting[1]=='02') {
                            splitting[1] = 'Février';
                        }
                        var date = splitting[2] + ' ' + splitting[1] + ' ' + splitting[0]
                        array_date.push(date);
                        array_value.push(parseInt(myObj[x].valueArray));
                    }
                    var array_value2 = [];
                    var array_date2 = [];
                    for (var i = 0; i < array_value.length; i++) {
                        if (i<7) {
                            array_date2.push(array_date[i] + ' : ' + array_value[i] + '%');
                            array_value2.push(array_value[i]);
                        }
                    }
                    createPolarAreaChart(canvas_polar, ctx['canvas_polar'], array_date2, array_value2, 'Luminosité dans la salle de bain les 7 derniers jours');
                }
            };
        }
    }
    if (type_of_room=='all') {
        var arrayToSend = ['all'];

        dbParam = JSON.stringify(arrayToSend);

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText);
                var total_number_of_sensors = myObj.length;
                var array_of_sensors = [];
                var sensors = [], number_of_sensors = [], previous;

                for (x in myObj) {
                    array_of_sensors.push(myObj[x]['name']);
                }

                for (var i = 0; i < array_of_sensors.length; i++) {
                    if (array_of_sensors[i] !== previous) {
                        sensors.push(array_of_sensors[i]);
                        number_of_sensors.push(1);
                    } else {
                        number_of_sensors[number_of_sensors.length-1]++;
                    }
                    previous = array_of_sensors[i];
                }

                for (var i = 0; i < number_of_sensors.length; i++) {
                    number_of_sensors[i] = Number((number_of_sensors[i]/total_number_of_sensors).toFixed(2));
                    sensors[i] = String(Number((number_of_sensors[i]*100).toFixed(2))) + '% ' + name_of_sensor[sensors[i]];
                }
                createDoughnutChart(canvas_doughnut, ctx['canvas_doughnut'], sensors, number_of_sensors, 'Pourcentage de capteurs dans la maison');
                createPieChart(canvas_pie, ctx['canvas_pie'], sensors, number_of_sensors, 'Pourcentage de capteurs dans la maison');
            }
        };

    }
    xmlhttp.open("POST", "../Modeles/DashboardAjaxQuery.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("x=" + dbParam);

    /*******************************************************************************/

}


var charts = {'boundary':{'type_of_sensor':'temperature', 'room':'livingroom', 'frequency':'last_10_days'},
              'line':{'type_of_sensor':'humidity', 'room':'kitchen', 'frequency':'2017-%-01'},
              'bar':{'type_of_sensor':'luminosity', 'room':'bedroom', 'frequency':'2017-%-01'},
              'doughnut':{'type_of_sensor':'', 'room':'all', 'frequency':''},
              'pie':{'type_of_sensor':'', 'room':'all', 'frequency':''},
              'polar':{'type_of_sensor':'luminosity', 'room':'livingroom', 'frequency':'last_7_days'}
             }


function createVerticalBarChart(canvas, context, xArray, yArray, max, color, title) {
    /*******************GET GLOBAL PROPERTIES*******************/
    var height_of_canvas = canvas.style.height;
    height_of_canvas = Number(height_of_canvas.replace('px', ''));
    var width_of_canvas = canvas.style.width;
    width_of_canvas = Number(width_of_canvas.replace('px', ''));


    /***************SET PROPERTY FOR THE TITLE******************/
    var height_of_title = 0.05 * height_of_canvas;


    /**************SET PROPERTIES FOR THE AXIS******************/
    var height_of_ordinate = 0.85 * height_of_canvas;
    var length_of_abscissa = 0.8 * width_of_canvas;

    var number_of_points_abscissa = xArray.length;
    var width_of_bar = 200 / number_of_points_abscissa;

    /**********************TITLE OF THE GRAPH******************/
    context.font = String(height_of_title) + 'px sans-serif';
    context.textAlign = 'center';
    context.fillText(title,
        width_of_canvas / 2,
        height_of_title);

    for (var i = 0; i < yArray.length; i++) {
        yArray[i] *= (height_of_ordinate - 2 * height_of_title) / max;
    }


    createLinearGrid(canvas, context, xArray, [], 0, max, true, false);

    context.fillStyle = chooseUniqueRandomData(1)[0];
    for (var i = 1; i < number_of_points_abscissa; i++) {
        context.fillRect(0.1 * width_of_canvas + i * length_of_abscissa / number_of_points_abscissa - width_of_bar / 2,
            height_of_canvas - height_of_title - 0.1 * height_of_canvas - 0.5,
            width_of_bar, -yArray[i]);
    }
}


function createLineChart(canvas, context, xArray, yArray, max, color, title, strength, filled) {
    /*********************************************************************************************\
    |*                                                                                           *|
    |*  Copyright 2010 by Robin W. Spencer                                                       *|
    |*  A part of this function (the drawing spline part) was taken from                         *|
    |*  http://scaledinnovation.com/analytics/splines/aboutSplines.html                          *|
    |*  strength is the strength of the shape.                                                   *|
    |*                                                                                           *|
    \*********************************************************************************************/

    /*******************GET GLOBAL PROPERTIES*******************/
    var height_of_canvas = canvas.style.height;
    height_of_canvas = Number(height_of_canvas.replace('px', ''));
    var width_of_canvas = canvas.style.width;
    width_of_canvas = Number(width_of_canvas.replace('px', ''));


    /***************SET PROPERTY FOR THE TITLE******************/
    var height_of_title = 0.05 * height_of_canvas;


    /**************SET PROPERTIES FOR THE AXIS******************/
    var height_of_ordinate = 0.85 * height_of_canvas;
    var length_of_abscissa = 0.8 * width_of_canvas;

    var number_of_points_abscissa = yArray.length;

    /**********************TITLE OF THE GRAPH******************/
    context.font = String(height_of_title) + 'px sans-serif';
    context.textAlign = 'center';
    context.fillText(title,
        width_of_canvas / 2,
        height_of_title);

    createLinearGrid(canvas, context, xArray, yArray, max, max, true, true);
    context.translate(0.1 * width_of_canvas + 1, height_of_ordinate); //go to origin

    var color = chooseUniqueRandomData(1)[0];


    /***********************************CREATE THE POINTS**********************************/
    /*****CREATE AN ARRAY TO HAVE THE SAME FORM OF THE CODE GIVEN BY ROBIN W. SPENCER******/
    rwp_array = [];
    for (var i = 0; i < yArray.length; i++) {
        yArray[i] *= (height_of_ordinate - 2 * height_of_title) / max;
        createPoint(context, i * length_of_abscissa / number_of_points_abscissa, yArray[i], height_of_canvas / 60, color);
        rwp_array.push(i * length_of_abscissa / number_of_points_abscissa);
        rwp_array.push(yArray[i]);
    }


    context.lineWidth = height_of_canvas / 100;
    context.strokeStyle = color;
    var cp = []; // array of control points, as x0,y0,x1,y1,...
    var n = rwp_array.length;


    /*****************FUNCTION OF DRAWING SPLINE FROM ROBIN W. SPENCER*****************/
    for (var i = 0; i < n - 4; i += 2) {
        cp = cp.concat(getControlPoints(rwp_array[i], rwp_array[i + 1], rwp_array[i + 2], rwp_array[i + 3], rwp_array[i + 4], rwp_array[i + 5], strength));
    }

    for (var i = 2; i < rwp_array.length - 5; i += 2) {
        context.beginPath();
        context.moveTo(rwp_array[i], rwp_array[i + 1]);
        context.bezierCurveTo(cp[2 * i - 2], cp[2 * i - 1], cp[2 * i], cp[2 * i + 1], rwp_array[i + 2], rwp_array[i + 3]);
        context.stroke();
        context.closePath();
    }

    //  For open curves the first and last arcs are simple quadratics.
    context.beginPath();
    context.moveTo(rwp_array[0], rwp_array[1]);
    context.quadraticCurveTo(cp[0], cp[1], rwp_array[2], rwp_array[3]);
    context.stroke();
    context.closePath();

    context.beginPath();
    context.moveTo(rwp_array[n - 2], rwp_array[n - 1]);
    context.quadraticCurveTo(cp[2 * n - 10], cp[2 * n - 9], rwp_array[n - 4], rwp_array[n - 3]);
    context.stroke();
    context.closePath();
}




function createPieChart(canvas, context, xArray, yArray, title) {
    /* ratio of canva must be 8/5 (width/height)

    /*******************GET GLOBAL PROPERTIES*******************/
    var height_of_canvas = canvas.style.height;
    height_of_canvas = Number(height_of_canvas.replace('px', ''));
    var width_of_canvas = canvas.style.width;
    width_of_canvas = Number(width_of_canvas.replace('px', ''));


    /***************SET PROPERTY FOR THE TITLE******************/
    var height_of_title = 0.05 * height_of_canvas;


    /**********************TITLE OF THE GRAPH******************/
    context.font = String(height_of_title) + 'px sans-serif';
    context.textAlign = 'center';
    context.fillStyle = 'black';
    context.fillText(title,
        width_of_canvas / 2,
        height_of_title);


    /**********SET THE COLORS FOR THE CELLS OF THE CHART******/
    var different_colors = chooseUniqueRandomData(yArray.length);


    /*********************SET THE PIE CHART*******************/
    var beginning = -Math.PI / 2;
    var radius = width_of_canvas / 4;
    var xCenter = 0.05 * width_of_canvas + radius;
    var yCenter = 0.15 * height_of_canvas + radius;
    context.lineWidth = radius / 60;
    context.strokeStyle = 'white';

    for (var i = 0; i < yArray.length; i++) {
        context.beginPath();
        context.arc(xCenter, yCenter, radius, beginning, beginning + yArray[i] * 2 * Math.PI, false);
        context.lineTo(xCenter, yCenter);
        context.closePath();
        context.fillStyle = different_colors[i];
        context.fill();

        beginning += yArray[i] * 2 * Math.PI;
    }

    /*create the dividing line*/
    beginning = -Math.PI / 2;
    for (var i = 0; i < yArray.length; i++) {
        context.beginPath();
        context.arc(xCenter, yCenter, radius, beginning, beginning + yArray[i] * 2 * Math.PI, false);
        context.lineTo(xCenter, yCenter);
        context.stroke();
        context.closePath();
        beginning += yArray[i] * 2 * Math.PI;
    }

    createLegend(canvas, context, xArray, different_colors);

}



function createDoughnutChart(canvas, context, xArray, yArray, title) {
    /*******************GET GLOBAL PROPERTIES*******************/
    var height_of_canvas = canvas.style.height;
    height_of_canvas = Number(height_of_canvas.replace('px', ''));
    var width_of_canvas = canvas.style.width;
    width_of_canvas = Number(width_of_canvas.replace('px', ''));


    /*****************SET THE DOUGHNUT CHART*******************/
    var radius = width_of_canvas / 4;
    var xCenter = 0.05 * width_of_canvas + radius;
    var yCenter = 0.15 * height_of_canvas + radius;

    createPieChart(canvas, context, xArray, yArray, title);
    createPoint(context, xCenter, yCenter, radius / 2, 'white');
}


function createPolarAreaChart(canvas, context, xArray, yArray, title) {
    /*******************GET GLOBAL PROPERTIES*******************/
    var height_of_canvas = canvas.style.height;
    height_of_canvas = Number(height_of_canvas.replace('px', ''));
    var width_of_canvas = canvas.style.width;
    width_of_canvas = Number(width_of_canvas.replace('px', ''));


    /***************SET PROPERTY FOR THE TITLE******************/
    var height_of_title = 0.05 * height_of_canvas;


    /**********************TITLE OF THE GRAPH******************/
    context.font = String(height_of_title) + 'px sans-serif';
    context.textAlign = 'center';
    context.fillText(title,
        width_of_canvas / 2,
        height_of_title);

    var beginning = -Math.PI / 2;
    var radius = width_of_canvas / 4;
    var xCenter = 0.05 * width_of_canvas + radius;
    var yCenter = 0.15 * height_of_canvas + radius;
    context.lineWidth = radius / 60;

    /**********SET THE COLORS FOR THE CELLS OF THE CHART******/
    var different_colors = chooseUniqueRandomData(yArray.length);


    /******************SET THE POLAR AREA CHART***************/
    var max = Math.max.apply(null, yArray);
    context.font = String(height_of_title / 1.5) + 'px sans-serif';
    createPolarGrid(canvas, context, max);
    createLegend(canvas, context, xArray, different_colors);

    for (var i = 0; i < yArray.length; i++) {
        context.beginPath();
        context.arc(xCenter, yCenter, yArray[i] * radius / max, beginning, beginning + 2 * Math.PI / yArray.length, false);
        context.lineTo(xCenter, yCenter);
        context.closePath();
        context.globalAlpha = 0.7;
        context.fillStyle = different_colors[i];
        context.fill();
        beginning += 2 * Math.PI / yArray.length;
    }
    context.globalAlpha = 1;
}


function createRadarChart(canvas, context, array, max, title) {
    // Work in progress.
}
