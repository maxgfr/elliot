<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/MDPoublie.css">
    <title>Récupération mot de passe</title>
</head>
<body>
<div id="container_recuperation">
    <div id="container_form_recuperation">
        <form id="Form_container">
            <div id="Text_oublie_mail">
                <h1>Reset your password</h1>
            </div>
            <div id="MDP_oublie_email">
                <input type="email" placeholder="Email" id="input_MDP_oublie" required/>
            </div>
            <div id="MDP_oublie_btn">
                <input type="submit" id="btn_MDPoublie" value="Envoyer" onclick="GetNewPass();"/>
            </div>
        </form>
    </div>
</div>
</body>
</html>

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