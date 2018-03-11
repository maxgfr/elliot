<?php
// Authorize errors to be displayed.
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

// Navigate through MVC root directory
$rootDirectory = dirname(__FILE__)."/../../mvc/";

// Implement the "Autoload" class to load automatically all classes.
require_once($rootDirectory.'Config/Autoload.php');
try {
  Autoload::load();
} catch(Exception $e){
  require (Config::getVues()["default"]) ;
}

session_start();
?>



<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!--
  This view displays the register interface.
  The user may create an account to access to Elliot services.
-->
<!-- //////////////////////////////////////////////////////////// -->



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico" />
    <script src="../../js/jquery-3.2.1.min.js"></script>
    <title>Inscription</title>
    <style type="text/css">
        .alert {
            padding: 20px;
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

  <div id="container_register">
    <div id="register_box" class="box">
        <div id="register_box_textandicon" class="box_textandicon">
            <div style="margin-top:23px">
                <img src="../../img/ellIoT.png" alt="ellIoT Icon" style="width:70px">
            </div>
            <div id="register_box_text" style="margin-right:50px">
                <h2 align="center">Inscription</h2>
            </div>
        </div>
        <!-- Set the register request. -->
        <div id="register_box_input" class="inputText">
            <form method="post" id="form_user">
                <input class="text" id="last_name" type="text" name="last_name" value="" placeholder="Nom de famille"/>
                <input class="text" id="first_name" type="text" name="first_name" value="" placeholder="Prénom"/>
                <input class="text" id="phone_number" type="tel" name="phone_number" value="" placeholder="Téléphone (01 23 45 67 89)"/>
                <input class="text" id="birthday" type="text" name="birthday" value="" placeholder="Date de naissance (JJ / MM / AAAA)"/>
                <input class="text" id="mail" type="email" name="mail" value="" placeholder="Email"/>
                <div class="testSecurityPassword">
                    <div id="input_box">
                        <input class="text" id="password" type="password" name="password" placeholder="Mot de passe"/>

                        <!-- Set the password security notification. -->
                        <div id="show_strength_box" style="display:none">
                            <div id="text_type_of_strength">
                                Sûreté : <span id="type_of_strength"></span>
                            </div>
                            <div id="show_strength_bar">
                                <div id="show_strength_bar_weakest"></div>
                                <div id="show_strength_bar_weak"></div>
                                <div id="show_strength_bar_medium"></div>
                                <div id="show_strength_bar_good"></div>
                                <div id="show_strength_bar_excellent"></div>
                            </div>
                            <div class="informationMessage">
                                <div class="informationBubble">
                                    <img src="../../img/informationIconBlue.png" alt="information icon">
                                    <div class="messageBox">
                                        0 : no word is typed. <br>
                                        1 : the password's length is less than 4 characters (even with special characters). <br>
                                        2 : the password's length is higher than 5 characters (not considering special characters). <br>
                                        3 : the password contains at least 2 capitalized characters or at least 2 numbers or
                                        at least 2 special characters. <br>
                                        4 : the password contains at least 2 of the criterias quoted above. <br>
                                        5 : the password contains all the criterias (at least 2 capitalized characters, 2 numbers
                                        and 2 special characters).
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Set the warning notification in case of unrespected input informations. -->
                        <div id="show_warning" style="display:none">
                            <div id="warning_image">
                                <img src="../../img/warning.png" alt="warning">
                            </div>
                            <div id="warning_message_box">
                                <div id="warning_message">Les espaces ne sont pas autorisés.</div>
                            </div>
                        </div>

                        <input class="text" id="confirm_password" type="password" name="confirm_password" placeholder="Confirmation du mot de passe" />
                    </div>

                </div>
        </div>
            </form>
            <div id="register_box_register" class="confirmButton">
                <button onclick="verifiyForm()">S'enregistrer</button>
            </div>
        </div>
    </div>


</body>
<script type="text/javascript" src="../../js/password.js"></script>
</html>
