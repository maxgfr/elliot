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
    <link href="../../css/login-box.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div style="padding: 100px 0 0 250px;">
    <div id="login-box">
        <H2>Login</H2>
        <br />
        <br />
        <div id="login-box-field" style="margin-top:20px;">
            <input name="email" class="form-login" title="Username" value="" placeholder="Email" size="30" maxlength="2048" style="background-color: white; border-radius: 2px;"/>
            <br />
            <br />
            <input name="Password" type="password" class="form-login" title="Password" value="" placeholder="Password" size="30" maxlength="2048" style="background-color: white ; border-radius: 2px" />
            <br />
            <br />
        </div>
        <div id="form-footer">
            <div id="Remember-me">
            <span class="login-box-options"><input type="checkbox" name="1" value="1"> Remember Me</span>
            </div>
            <br />
            <div id="Forget-pwd">
            <a href="#" style="color: white;">Forgot password?</a></span>
            </div>
            <br />
            <br />
            <div id="Buton">
            <a href="#"><img src="../../img/userIcon.png" width="50" height="50" style="margin-left:90px;" /></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
