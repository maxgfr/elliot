<?php
//Voir les erreurs
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
// Répertoire racine du MVC
$rootDirectory = dirname(__FILE__) . "/../../mvc/";
// chargement de la classe Autoload pour autochargement des classes
require_once($rootDirectory . 'Config/Autoload.php');
try {
    Autoload::load();
} catch (Exception $e) {
    require(Config::getVues()["default"]);
}
session_start();
if (empty($_SESSION['email'])) {
    header("Location:vueConnexion.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Administration </title>
    <link href="../../css/admin.css" rel="stylesheet" type="text/css"/>
    <script src="../../js/jquery-3.2.1.min.js"></script>
    <script src="../../js/admin_personne.js"></script>

</head>
<?php include("layouts/header.php"); ?>
<body>
<div id="main">

    <form method="post">
        <fieldset>
            <label for="type">Type :</label>
            <select name="type" id="type">
                <option value="last_name">Nom</option>
                <option value="first_name">Prénom</option>
                <option value="mail">Mail</option>
                <option value="role_client">Client</option>
                <option value="role_admin">Admin</option>
            </select>
            <label for="input_search">Recherche :</label>
            <input name="input_search" id="input_search">
            <button type="button" id="search">Submit</button>
        </fieldset>
    </form>
    <div id="result">
    </div>
</div>
</body>
</html>
<script>
    /**** AJAX AND JS ****/
    $('#search').click(function () {
        console.log($('#type').val());
        console.log($('#input_search').val());
        var data = $('#input_search').val();

        $.ajax({
            type: "POST",
            url: "../Modeles/Admin.php",
            data: {'data': data},
            success: function (result) {
                var div = document.createElement('div');
                div.id = "div_test";
                var p = document.createElement('P');
                p.id = "test";
                $('#result').append(div);
                $('#div_test').append(p);
                var test = document.getElementById('test');
                test.innerText = result;
            }
        })
    });
    /**** AJAX AND JS ****/
</script>