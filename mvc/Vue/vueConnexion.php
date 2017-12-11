<?php
  //Voir les erreurs
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  // Répertoire racine du MVC
  $rootDirectory = dirname(__FILE__)."/../../mvc/";
  // chargement de la classe Autoload pour autochargement des classes
  require_once($rootDirectory.'Config/Autoload.php');
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
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico" />
</head>
<body>

    <div id="container_login" style="width:800px; margin:0 auto;">
        <div id="login_box" class="box">
            <div id="login_box_textandicon" class="box_textandicon">
                <div id="login_box_text">
                    <h2 align="center" >Authentifiez-vous pour accéder à votre espace</h2>
                </div>
            </div>
            <form method="post">
                <div id="login_box_input" style="margin-top:20px;">
                    <div id="login_box_input_email" class="inputText">
                        <input name="mail" id="mail" title="Username" placeholder="Email" />
                    </div>
                    <div id="login_box_input_password" class="inputText">
                        <input name="password" id="password" type="password" title="Password" placeholder="Mot de passe" />
                    </div>
                    <div id="login_box_input_suggestion">
                        <div id="login_box_input_suggestion_checkbox">
                            <input type="checkbox" name="1" value="1">
                        </div>
                        <div id="login_box_input_suggestion_text">
                            Se souvenir de moi
                        </div>
                        <br>
                        <div>
                            <a href="mvc/Vue/vueInscription.php">J'ai pas de compte</a>
                        </div>
                        <div id="login_box_input_suggestion_forgotPassword">
                            <a href="#"> Mot de passe oublié? </a>
                        </div>
                    </div>
                </div>
                <div id="login_box_authentification" class="confirmButton">
                    <button type="submit" name="button">S'authentifier</button>
                </div>
            </form>
        </div>

        <?php
            if (isset($_POST['mail']) && isset($_POST['password']))  {
                $ctrl = new ControleurVisitor('connexion');
            }
        ?>
    </div>
</body>
</html>
