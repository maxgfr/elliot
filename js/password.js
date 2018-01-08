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

/*******************************VERIFICATION OF THE FORM****************************************/
function verifiyForm() {
    /*************************************************************************************************\
    |*                                                                                               *|
    |*  This function verify the inputs typed by the user before send them to the database.          *|
    |*  The part below will explain how we verify the inputs.                                        *|
    |*                                                                                               *|
    |*  Last name and first name will be the same :                                                  *|
    |*      - must contain letters, no numbers, no special characters, no space                      *|
    |*      - must contain at least two characters                                                   *|
    |*      - can be either uppercase or lowercase, anyway the string will be transformed to         *|
    |*        lowercase. After, these strings could be transformed to a show better interface        *|
    |*      - maximum characters of 15 (we are not a novel)                                          *|
    |*                                                                                               *|
    |*  Phone number :                                                                               *|
    |*      - must contain exactly 10 numbers, no letters, no special characters                     *|
    |*      - the form of the phone number will be : 0123456789                                      *|
    |*      - the spaces will be deleted, then if the user types 01 23 45 67 89 it is ok             *|
    |*                                                                                               *|
    |*  Birthday :                                                                                   *|
    |*      - must be like JJ/MM/AAAA (maybe a form with the / can be implemented)                   *|
    |*      - must be numbers                                                                        *|
    |*      - JJ between 1 and 31 (depending), MM between 1 and 12 (all the time),                   *|
    |*        AAAA between 1930 and actual year (why 1930? I don't know)                             *|
    |*                                                                                               *|
    |*  Mail :                                                                                       *|
    |*      - must contain @ and . characters                                                        *|
    |*      - before @ and . , must contain at least 2 characters                                    *|
    |*      - special characters forbidden, except @ (only once), . (only once after @               *|
    |*        and no matter before) and underscore before @ (no matter the frequency)                *|
    |*                                                                                               *|
    |*  Password :                                                                                   *|
    |*      - must be at least level 2                                                               *|
    |*                                                                                               *|
    |*                                                                                               *|
    \*************************************************************************************************/


    var lastNameInput = document.getElementById("last_name").value;
    var firstNameInput = document.getElementById("first_name").value;
    var phoneNumberInput = document.getElementById("phone_number").value;
    var birthdayInput = document.getElementById("birthday");
    var mailInput = document.getElementById("mail").value;
    var birthdayInput = document.getElementById('birthday');

    /***************************THIS FUNCTION IS NOT MINE***************************************/
    function checkValue(str, max) {
        if (str.charAt(0) !== '0' || str == '00') {
            var num = parseInt(str);
            if (isNaN(num) || num <= 0 || num > max) {
                num = 1;
            }
            str = num > parseInt(max.toString().charAt(0))
                   && num.toString().length == 1 ? '0' + num : num.toString();
        }
        return str;
    }

    birthdayInput.addEventListener('input', function(e) {
        this.type = 'text';
        var input = this.value;
        if (/\D\/$/.test(input)) {
            input = input.substr(0, input.length - 3);
        }
        var values = input.split('/').map(function(v) { return v.replace(/\D/g, '') });
        if (values[0]) {
            values[0] = checkValue(values[0], 12);
        }
        if (values[1]) {
            values[1] = checkValue(values[1], 31);
        }
        var output = values.map(function(v, i) { return v.length == 2 && i < 2 ? v + ' / ' : v; });
        this.value = output.join('').substr(0, 14);
    });
    /** GET THIS HERE : https://stackoverflow.com/questions/44137998/auto-slash-for-date-input-using-javascript **/


    if (lastNameInput.includes(" ") || lastNameInput.match(/[0-9]/) || lastNameInput.length==0) {
        document.getElementById("last_name").style.backgroundColor = "red";
    }
    else {
        document.getElementById("last_name").style.backgroundColor = "white";
    }
}

function checkPass() {
    //Store the password field objects into variables ...
    var password = document.getElementById('password');
    var confirm_password = document.getElementById('confirm_password');
    //Store the Confimation Message Object ...
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field
    //and the confirmation field
    if(password.value == confirm_password.value){
        //The passwords match.
        //Set the color to the good color and inform
        //the user that they have entered the correct password
        confirm_password.style.backgroundColor = goodColor;
    } else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        confirm_password.style.backgroundColor = badColor;
    }
}
