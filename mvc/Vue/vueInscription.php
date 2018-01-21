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
    <script type="text/javascript" src="../../js/password.js"></script>
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
            <div id="register_box_text">
                <h2 align="center">Inscription</h2>
            </div>
            <div id="register_box_icon" class="iconImage">
                <img src="../../img/register_icon.png" alt="Register Icon">
            </div>
        </div>
        <!-- Set the register request. -->
        <div id="register_box_input" class="inputText">
            <form method="post">
                <input class="text" id="last_name" type="text" name="last_name" value="" placeholder="Nom de famille"/>
                <input class="text" id="first_name" type="text" name="first_name" value="" placeholder="Prénom"/>
                <input class="text" id="phone_number" type="tel" name="phone_number" value="" placeholder="Téléphone (sous forme 0123456789)"/>
                <input class="text" id="birthday" type="text" name="birthday" value="" placeholder="Date de naissance (sous forme AAAA-MM-JJ)"/>
                <input class="text" id="mail" type="email" name="mail" value="" placeholder="Email"/>
                <div class="testSecurityPassword">
                    <div id="input_box"> 
                        <input class="text" id="password" type="password" name="password" placeholder="Mot de passe" onkeyup="setBackgroundColorBar(setStrength()); checkPass(); return false;" />
                        <input class="text" id="confirm_password" type="password" name="confirm_password" placeholder="Confirmation du mot de passe" onkeyup="checkPass(); return false;" />
                    </div>

                    <!-- Set the password security notification. -->
                    <div id="show_strength_box">
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
                    </div>

                    <!-- Set the warning notification in case of unrespected input informations. -->
                    <div id="show_warning">
                        <div id="warning_image">
                            <img src="../../img/warning.png" alt="warning">
                        </div>
                        <div id="warning_message_box">
                            <div id="warning_message">Les espaces ne sont pas autorisés.</div>
                        </div>
                    </div>
                </div>            
        </div>
                <div id="register_box_register" class="confirmButton">
                    <button type="submit" name="button">S'enregistrer</button>
                </div>
            </form>
        </div>
    </div>



    <!-- Check the input register informations. -->
    <?php
    if (isset($_POST['last_name']) && 
        isset($_POST['first_name']) && 
        isset($_POST['phone_number']) && 
        isset($_POST['birthday']) && 
        isset($_POST['mail']) && 
        isset($_POST['password']) && 
        isset($_POST['confirm_password']) &&
        $_POST['password'] == $_POST['confirm_password'])  {
        $ctrl = new ControleurVisitor('inscription');
    } 
    else if (!isset($_POST['last_name'])) { echo "<h1 class=\"alert\"> Nom de famille obligatoire ! </h1>"; }
    else if (!isset($_POST['first_name'])) { echo "<h1 class=\"alert\"> Prénom obligatoire ! </h1>"; }
    else if (!isset($_POST['phone_number'])) { echo "<h1 class=\"alert\"> Numéro de téléphone obligatoire ! </h1>"; }
    else if (!isset($_POST['birthday'])) { echo "<h1 class=\"alert\"> Date de naissance obligatoire ! </h1>"; }
    else if (!isset($_POST['mail'])) { echo "<h1 class=\"alert\"> Addresse mail obligatoire ! </h1>"; }
    else if (!isset($_POST['password'])) { echo "<h1 class=\"alert\"> Mot de passe obligatoire ! </h1>"; } 
    else if (!isset($_POST['confirm_password']) || $_POST['password'] != $_POST['confirm_password']) { echo "<h1 class=\"alert\"> Vous devez confirmer votre mot de passe ! </h1>"; }  
 

    ?>



</body>
</html>
