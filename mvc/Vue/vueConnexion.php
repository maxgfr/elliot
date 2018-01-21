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
  This view displays the login interface to access to the user
  account.
  The user may get to a register interface or an interface to
  reset the password.
-->
<!-- //////////////////////////////////////////////////////////// -->





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta   charset="UTF-8" />
    <title>Connexion</title>
    <link href="../../css/login.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico" />
</head>

<body>

    <div id="container_login">
        <div id="login_box" class="box">
            <div id="login_box_textandicon" class="box_textandicon">
                <div id="login_box_text">
                    <h2 align="center">Connexion</h2>
                </div>
                <div id="register_box_icon" class="iconImage">
                    <img src="../../img/login_icon.png" alt="Login Icon">
                </div>
            </div>

            <form method="post">
                <!-- Set the login request. -->
                <div id="login_box_input" style="margin-top:20px;">
                    <div id="login_box_input_email" class="inputText">
                        <input name="mail" id="mail" title="Username" placeholder="Email" />
                    </div>
                    <div id="login_box_input_password" class="inputText">
                        <input name="password" id="password" type="password" title="Password" placeholder="Mot de passe" />
                    </div>

                    <!-- Set the register and password-resetting options. -->
                    <div id="login_box_input_suggestion">
                        <div>
                            <a href="/elliot/mvc/Vue/vueInscription.php">Je n'ai pas de compte</a>
                        </div>
                        <div id="login_box_input_suggestion_forgotPassword">
                            <a href="VueMDPoublie.php">Mot de passe oublié ?</a>
                        </div>
                    </div>
                </div>

                <div id="login_box_authentification" class="confirmButton">
                    <button type="submit" name="button">S'authentifier</button>
                </div>
            </form>
        </div>


        <!-- Check the input login identifiers. -->
        <?php
            if (isset($_POST['mail']) && isset($_POST['password']))  {
            $ctrl = new ControleurVisitor('connexion');
        }
        ?>



    </div>

</body>
</html>
