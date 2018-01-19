<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!-- 
  This view lets the user reset his password by sending a random
  token to his mail inbox, as long as his account exists.
-->
<!-- //////////////////////////////////////////////////////////// -->



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/MDPoublie.css">
    <link rel="shortcut icon" href="../../img/smallellIoTICO.ico" />
    <title>Récupération mot de passe</title>
</head>


<body>

    <div id="container_recuperation">
        <div id="container_form_recuperation">
            <form id="form_container">
                <div id="text_oublie_mail">
                    <h1>Réinitialiser votre mot de passe</h1>
                </div>
                <!-- Set the e-mail request. -->
                <div id="input_text_mail">
                    <input type="email" placeholder="Email" id="input_MDP_oublie" required/>
                </div>
                <div id="confirm_button">
                    <button type="submit" name="button" onclick="GetNewPass()">Envoyer</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>


<!-- Prompt a window box advertising the state of this service. -->
<script>
    function GetNewPass() {
        var test = document.getElementById("input_MDP_oublie").value;
        if (test == " ") {
            alert("Please enter a email address");
        }
        else {
            alert("You reset your password");
        }
    }
</script>
