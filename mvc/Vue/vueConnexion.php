<?php
  // Répertoire racine du MVC
  $rootDirectory = dirname(__FILE__)."/../../mvc/";
  // chargement de la classe Autoload pour autochargement des classes
  require_once($rootDirectory.'Config\Autoload.php');
  try {
      Autoload::load();
  } catch(Exception $e){
      require (Config::getVues()["default"]) ;
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta   charset="UTF-8" />
    <title>Connexion</title>
    <link href="../../css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div id="container_login">
        <div id="login_box" class="box">
            <div id="login_box_textandicon" class="box_textandicon">
                <div id="login_box_text">
                    <h2>AUTHENTIFICATION</h2>
                </div>
                <div id="login_box_icon" class="iconImage">
                    <img src="../../img/register_icon.png" alt="Register Icon">
                </div>
            </div>
            <div id="login_box_input" style="margin-top:20px;">
                <div id="login_box_input_email" class="inputText">
                    <input name="email" title="Username" placeholder="Email" />
                </div>
                <div id="login_box_input_password" class="inputText">
                    <input name="password" type="password" title="Password" placeholder="Mot de passe" />
                </div>
                <div id="login_box_input_suggestion">
                    <div id="login_box_input_suggestion_checkbox">
                        <input type="checkbox" name="1" value="1">
                    </div>
                    <div id="login_box_input_suggestion_text">
                        Se souvenir de moi
                    </div>
                    <div id="login_box_input_suggestion_forgotPassword">
                        <a href="#"> Mot de passe oublié? </a>
                    </div>
                </div>
            </div>
            <div id="login_box_authentification" class="confirmButton">
                <button type="button" name="button">S'authentifier</button>
            </div>
        </div>
    </div>
</body>
</html>
