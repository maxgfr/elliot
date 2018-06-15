/*************************PART OF CHECKING STRENGTH OF PASSWORD**************************/

var counter_space = 0;
var counter_normal = 0;
var counter_capitalize = 0;
var counter_numbers = 0;
var counter_special = 0;
var lengthText = 0;
var passwordText = "";


function initCounter() {
    counter_space = 0;
    counter_normal = 0;
    counter_capitalize = 0;
    counter_numbers = 0;
    counter_special = 0;
}

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

function setCounters(character) {
    if (lengthText != 0) {
        if (detectNormal(character)) {
            counter_normal++;
        } else if (detectNumber(character)) {
            counter_numbers++;
        } else if (detectSpace(character)) {
            counter_space++;
        } else if (detectCapitalize(character)) {
            counter_capitalize++;
        } else {
            /* It's just a trick to determine the special characters by elimination.
               For ease of implementation, it will work for Latin, Greek, Armenian and Cyrillic scripts.
               We don't take into account Chinese, Japanese, Arabic, Hebrew and most other scripts.
               Keep calm, it's not racism.
            */
            counter_special++;
        }
    } else {
        // If empty text set the default values.
        initCounter();
    }
}


function setStrength() {
    /*************************************************************************************************\
    |*                                                                                               *|
    |*  It returns a value between 0 and 5, depending on the strength                                *|
    |*  of the password written by the user.                                                         *|
    |*                                                                                               *|
    |*  0 : no word is typed.                                                                        *|
    |*  1 : the password's length is less than 4 characters (even with special characters).          *|
    |*  2 : the password's length is higher than 5 characters (not considering special characters).  *|
    |*  3 : the password contains at least 2 capitalized characters or at least 2 numbers or         *|
    |*  at least 2 special characters.                                                               *|
    |*  4 : the password contains at least 2 of the criterias quoted above.                          *|
    |*  5 : the password contains all the criterias (at least 2 capitalized characters, 2 numbers    *|
    |*  and 2 special characters).                                                                   *|
    |*                                                                                               *|
    \*************************************************************************************************/

    initCounter();

    passwordText = $('#password').val();
    lengthText = passwordText.length;

    for (var i = 0; i < lengthText; i++) {
        setCounters(passwordText[i]);
    }

    /**********DETERMINE THE STRENGTH OF THE PASSWORD**********\
    |*                                                        *|
    |*  Describe here how you want the password to be strong. *|
    |*                                                        *|
    \**********************************************************/

    if (lengthText == 0) {
        strength = 0;
    } else if (lengthText <= 4) {
        strength = 1;
    } else if (lengthText > 4) {
        /* The order of the if conditions is very important here ! */
        if (counter_capitalize >= 2 && counter_numbers >= 2 && counter_special >= 2) {
            strength = 5;
        } else if ((counter_capitalize >= 2 && counter_numbers >= 2) ||
            (counter_capitalize >= 2 && counter_special >= 2) ||
            (counter_numbers >= 2 && counter_special >= 2)) {
            strength = 4;
        } else if ((counter_capitalize >= 2 || counter_numbers >= 2 || counter_special >= 2)) {
            strength = 3;
        } else {
            strength = 2;
        }
    }

    return strength;
}

function setBackgroundColorBar(strength) {
    /*************************************************************************************************\
    |*                                                                                               *|
    |*  This function takes in parameter the value returned by the setStrength                       *|
    |*  function to set the bars' color.                                                             *|
    |*                                                                                               *|
    \*************************************************************************************************/

    var firstBarColor = $("#show_strength_bar_weakest");
    var secondBarColor = $("#show_strength_bar_weak");
    var thirdBarColor = $("#show_strength_bar_medium");
    var fourthBarColor = $("#show_strength_bar_good");
    var fifthBarColor = $("#show_strength_bar_excellent");
    var displayText = $("#type_of_strength");
    var strengthBox = $("#show_strength_box");
    var warning = $("#show_warning");

    if (counter_space >= 1) {
        warning.show();
        strengthBox.hide();
    } else {
        strengthBox.show();
        warning.hide();
        if (strength == 0) {
            strengthBox.hide();
        } else if (strength == 1) {
            strengthBox.show();
            displayText.html("Médiocre");

            firstBarColor.css('background-color', "#C00000");
            secondBarColor.add(thirdBarColor).add(fourthBarColor).add(fifthBarColor).css('background-color', '#D3D3D3');
            /* This line forces the other bars to be grey because, when a color is set,
               it stays at its previous color.
               Example : The password is medium, so the first three bars are set yellow. Now the user
                         removes the password and it becomes a weak password. At this moment, the first
                         two bars are set to red but the third bar is still set to yellow and not grey.
            */
        } else if (strength == 2) {
            displayText.html("Mauvaise");

            firstBarColor.add(secondBarColor).css('background-color', '#C75566');
            thirdBarColor.add(fourthBarColor).add(fifthBarColor).css('background-color', '#D3D3D3');
        } else if (strength == 3) {
            displayText.html("Moyenne");

            firstBarColor.add(secondBarColor).add(thirdBarColor).css('background-color', '#DDAC26');
            fourthBarColor.add(fifthBarColor).css('background-color', '#D3D3D3');
        } else if (strength == 4) {
            displayText.html("Élevée");

            firstBarColor.add(secondBarColor).add(thirdBarColor).add(fourthBarColor).css('background-color', '#219D75');
            fifthBarColor.css('background-color', '#D3D3D3');
        } else if (strength == 5) {
            displayText.html("Excellente");

            firstBarColor.add(secondBarColor).add(thirdBarColor).add(fourthBarColor).add(fifthBarColor).css('background-color', '#548235');
        }
    }
}

/*******************************VERIFICATION OF THE FORM****************************************/
function verifiyForm() {
    /*************************************************************************************************\
    |*                                                                                               *|
    |*  This function check the inputs typed by the user before sending them to the database.        *|
    |*  The part below will explain how the inputs are checked.                                      *|
    |*                                                                                               *|
    |*  Last name and first name will be the same :                                                  *|
    |*      - must contain letters, no numbers, no special characters, no space,                     *|
    |*      - must contain at least two characters,                                                  *|
    |*      - can be either uppercase or lowercase, anyway the string will be transformed to         *|
    |*        lowercase. These strings could be transformed later to a show better interface,        *|
    |*      - maximum characters of 20 (we are not writing a novel).                                 *|
    |*                                                                                               *|
    |*  Phone number :                                                                               *|
    |*      - must contain exactly 10 numbers, no letters, no special characters,                    *|
    |*      - the form of the phone number will be : 0123456789,                                     *|
    |*      - the spaces will be deleted, then if the "01 23 45 67 89" form will be fine.            *|
    |*                                                                                               *|
    |*  Birthday :                                                                                   *|
    |*      - must be like JJ/MM/AAAA (maybe a form with the / can be implemented),                  *|
    |*      - must be numbers,                                                                       *|
    |*      - JJ between 1 and 31 (depending), MM between 1 and 12 (all the time),                   *|
    |*        AAAA between 1900 and actual year (why 1900? I don't know).                            *|
    |*                                                                                               *|
    |*  Mail :                                                                                       *|
    |*      - must contain @ and . characters,                                                       *|
    |*      - before @ and . , must contain at least 2 characters,                                   *|
    |*      - special characters forbidden, except @ (only once), . (no matter the frequency         *|
    |*        before and after @), dash and underscore before @ (no matter the frequency).           *|
    |*                                                                                               *|
    |*  Password :                                                                                   *|
    |*      - must be at least level 2.                                                              *|
    |*                                                                                               *|
    |*                                                                                               *|
    \*************************************************************************************************/


    var lastNameInput = $("#last_name").val();
    var firstNameInput = $("#first_name").val();
    var phoneNumberInput = $("#phone_number").val().replace(/\s/g, '');
    var birthdayInput = $("#birthday").val();
    var mailInput = $("#mail").val();
    var passwordInput = $('#password').val();
    var confirmPasswordInput = $('#confirm_password').val();


    arrayBirthday = birthdayInput.replace(/\s/g, '').split('/');
    var day = arrayBirthday[0] != null? arrayBirthday[0] : '';
    var month = arrayBirthday[1] != null? arrayBirthday[1] : '';
    var year = arrayBirthday[2] != null? arrayBirthday[2] : '';


    if (validateNames(lastNameInput) &&
        validateNames(firstNameInput) &&
        validatePhoneNumber(phoneNumberInput) &&
        !notValidateBirthday(day, month, year) &&
        setStrength() > 2 &&
        passwordInput == confirmPasswordInput) {
            birthdayInput = year + '-' + month + '-' + day;
            dataToSend = 'last_name='+lastNameInput+
                         '&first_name='+firstNameInput+
                         '&phone_number='+phoneNumberInput+
                         '&birthday='+birthdayInput+
                         '&mail='+mailInput+
                         '&password='+passwordInput;
            $.ajax({
                url : '../Modeles/SendForm.php',
                type : 'POST',
                data : dataToSend,
                success : function() {
                    $('#form_user').submit();
                    window.location.href = "vueConnexion.php";
                }
            });
    }
    if (!validateNames(lastNameInput)) {
        $("#last_name").css('background-color', '#FF6666');
    }
    if (!validateNames(firstNameInput)) {
        $("#first_name").css('background-color', '#FF6666');
    }
    if (!validatePhoneNumber(phoneNumberInput)) {
        $("#phone_number").css('background-color', '#FF6666');
    }
    if (notValidateBirthday(day, month, year)) {
        $("#birthday").css('background-color', '#FF6666');
    }
    if (!validateEmail(mailInput)) {
        $("#mail").css('background-color', '#FF6666');
    }
    if (setStrength() <= 2) {
        $("#password").css('background-color', '#FF6666');
    }
    if (passwordInput == confirmPasswordInput && passwordInput.length == 0) {
        $("#password").add($('#confirm_password')).css('background-color', '#FF6666');
    } else if (passwordInput != confirmPasswordInput && passwordInput.length != 0) {
        $('#confirm_password').css('background-color', '#FF6666');
    }
}

function validateNames(name) {
    var correctPattern = /[A-zÀ-ÿ\-\s\.]/;
    /* accept lower and uppercase letters even with accents
       accept dash character (e.g. 'Jean-Eudes')
       accept only one space character (e.g. 'Conor Jr.'')
       accept only one dot character (e.g. 'Conor Jr.')
    */
    var wrongPattern = /[^A-zÀ-ÿ\-\s\.]/gi;

    if (correctPattern.test(name) && name.length >= 2 && name.length <= 20) {
        return true;
    }
    if (wrongPattern.test(name) || name.length < 2 || name.length > 20) {
        return false;
    }
}

function validatePhoneNumber(phoneNumber) {
    if (phoneNumber.length == 10) {
        return true;
    } else {
        return false;
    }
}

function notValidateBirthday(day, month, year) {
    var dayNumber = day == ''? 0 : Number(day);
    var monthNumber = month == ''? 0 : Number(month);
    var yearNumber = year == ''? (new Date()).getFullYear() : Number(year);

    if (monthNumber > 12 || yearNumber < 1900 || yearNumber > (new Date()).getFullYear() ||
        (yearNumber == (new Date()).getFullYear() && monthNumber > Number((new Date()).getMonth()+1)) ||
        (yearNumber == (new Date()).getFullYear() && monthNumber == Number((new Date()).getMonth()+1) && dayNumber > Number((new Date()).getDate())) ||
        (month % 2 == 0 && dayNumber > 30) || (month % 2 != 0 && dayNumber > 31) || (month == 2 && !isLeapYear(year) && dayNumber > 28) ||
        (month == 2 && isLeapYear(year) && dayNumber > 29) || dayNumber == 0 || monthNumber == 0 || yearNumber == 0) {
        return true;
    } else {
        return false;
    }
}

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}


function isLeapYear(year) {
    if ((year % 4 == 0 && year % 100 != 0) || year % 400 == 0) {
        return true;
    } else {
        return false;
    }
}

/***************************************************************************************************/
/****************************************** NAMES **************************************************/
/***************************************************************************************************/

$('#last_name').add($('#first_name')).keyup(function() {
    var nameNode = $(this);
    var name = nameNode.val();

    if (validateNames(name)) {
        $(this).css('background-color', '#66CC66');
    } else {
        $(this).css('background-color', '#FF6666');
    }

    if (name.length == 0) {
        nameNode.css('background-color', 'white');
    }
});

/***************************************************************************************************/
/******************************************* PHONE *************************************************/
/***************************************************************************************************/

$('#phone_number').keyup(function() {
    var phoneNumberInput = $(this).val();
    phoneNumberInput = phoneNumberInput.replace(/\s/g, ''); // remove all spaces
    arrayPhoneNumber = phoneNumberInput.split('');
    if (arrayPhoneNumber[0] != '0') {
        arrayPhoneNumber.unshift('0'); // put a 0 at the beginning
    }
    if (phoneNumberInput.length < 10) {
        $(this).css('background-color', 'white');
        var phoneNumber = '';
        for (var i = 0; i < arrayPhoneNumber.length; i+=2) {
            if (arrayPhoneNumber[i+1] == null) {
                arrayPhoneNumber[i+1] = '';
            } else {
                arrayPhoneNumber[i+1] += ' ';
            }
            phoneNumber += arrayPhoneNumber[i] + arrayPhoneNumber[i+1];
        }
        $(this).val(phoneNumber);
    } else if (validatePhoneNumber(phoneNumberInput)) {
        $(this).css('background-color', '#66CC66');
    } else if (!validatePhoneNumber(phoneNumberInput)) {
        $(this).css('background-color', '#FF6666');
    }
});

$('#phone_number').add('#birthday').on('keypress', function(event) {
    if ((event.which >= 1 && event.which <= 7) ||
        (event.which >= 9 && event.which <= 47) ||
        (event.which >= 58 && event.which <= 300)) {
        return false;
    }
});

$('#phone_number').add('#birthday').on('keypress', function(event) {
    if ($(this).val().length >= 14 && event.which >= 47 && event.which <= 58) {
        // if the phone number has the right number of digits, disable writing
        return false;
    }
});

/***************************************************************************************************/
/***************************************** BIRTHDAY ************************************************/
/***************************************************************************************************/

$('#birthday').keyup(function() {
    var birthdayInput = $(this).val();
    var birthdayOutput = '';
    birthdayInput = birthdayInput.replace(/\s/g, ''); // remove all spaces
    arrayBirthday = birthdayInput.split('/');
    var day = arrayBirthday[0] != null? arrayBirthday[0] : '';
    var month = arrayBirthday[1] != null? arrayBirthday[1] : '';
    var year = arrayBirthday[2] != null? arrayBirthday[2] : '';

    if (notValidateBirthday(day, month, year)) {
        $(this).css('background-color', '#FF6666');
    } else {
        $(this).css('background-color', '#66CC66');
    }

    if (day.length < 2 || month.length < 2 || year.length < 4 ) {
        $(this).css('background-color', 'white');
    }

    if ((day.length == 2) || (day.length < 2 && month != '') ) {
        birthdayOutput += day + ' / ';
    } else {
        birthdayOutput += day;
    }
    if ((month.length == 2) || (month.length < 2 && year != '')) {
        birthdayOutput += month + ' / ';
    } else {
        birthdayOutput += month;
    }
    if (year.length <= 4) {
        birthdayOutput += year;
    }


    $(this).val(birthdayOutput);
});


/***************************************************************************************************/
/******************************************* MAIL **************************************************/
/***************************************************************************************************/

$('#mail').keyup(function() {
    var mailInput = $(this).val();
    if (validateEmail(mailInput)) {
        $(this).css('background-color', '#66CC66');
    } else {
        $(this).css('background-color', '#FF6666');
    }
    if (mailInput.length == 0) {
        $(this).css('background-color', 'white');
    }
});

/***************************************************************************************************/
/***************************************** PASSWORD ************************************************/
/***************************************************************************************************/

$('#password').keyup(function() {
    var strength = setStrength();
    setBackgroundColorBar(strength);
    if (strength >= 3) {
        $(this).css('background-color', '#66CC66');
    } else {
        $(this).css('background-color', '#FF6666');
    }
    if ($('#confirm_password').val() != $(this).val() && $('#confirm_password').val().length != 0) {
        $('#confirm_password').css('background-color', '#FF6666');
    } else if ($('#confirm_password').val() == $(this).val() && $('#confirm_password').val().length != 0){
        $('#confirm_password').css('background-color', '#66CC66');
    }
    if ($(this).val().length == 0) {
        $('#confirm_password').val('');
        $(this).add($('#confirm_password')).css('background-color', 'white');
    }
});

$('#confirm_password').on('keypress', function() {
    if ($('#password').val().length == 0) {
        return false;
    }
});

$('#confirm_password').keyup(function() {
    if ($(this).val() == $('#password').val()) {
        $(this).css('background-color', '#66CC66');
    } else {
        $(this).css('background-color', '#FF6666');
    }
    if ($(this).val().length == 0) {
        $(this).css('background-color', 'white');
    }
});
