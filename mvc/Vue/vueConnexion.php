<!DOCTYPE html>
<html lang="fr">
<head>
    <meta   charset="UTF-8" />
    <title>Connexion</title>
    <link href="css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div id="container_login" style="width:800px; margin:0 auto;">
        <div id="login_box" class="box">
            <div id="login_box_textandicon" class="box_textandicon">
                <div id="login_box_text">
                    <h2 align="center" >Authentifiez-vous pour accèder à votre espace</h2>
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
                <button type="button" name="button">S'authentifier</button>
            </div>
        </div>
    </div>
</body>
</html>
