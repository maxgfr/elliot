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
                <option value="0">Client</option>
                <option value="1">Admin</option>
            </select>
            <label for="input_search">Recherche :</label>
            <input name="input_search" id="input_search">
            <button type="button" id="search">Submit</button>
        </fieldset>
    </form>
    <div id="result">
        <table id="table_result">
            <tr>
                <th>
                    Nom
                </th>
                <th>
                    Prénom
                </th>
                <th>
                    Role
                </th>
                <th>
                    Mail
                </th>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
<script>
    /**** AJAX AND JS ****/
    $('#search').click(function () {
        var data = {};
        data.titre = $('#type').val();
        data.message = $('#input_search').val();
        $.ajax({
            type: "POST",
            url: "../Modeles/Admin.php",
            data: {'data': data},
            success: function (result) {

                for (var i = 0; i < result.length; i++) {
                    var tr = document.createElement('tr');
                    tr.id = "tr_" + i.toString();
                    var Jquery_tr = "#" + tr.id;
                    var td_name = document.createElement('td');
                    td_name.id = "td_name" + i.toString();
                    $('#table_result').append(tr);
                    $(Jquery_tr).append(td_name);
                    td_name.innerText = result[i]['last_name'];

                    var td_firstname = document.createElement('td');
                    td_firstname.id = "td_firstname" + i.toString();
                    $(Jquery_tr).append(td_firstname);
                    td_firstname.innerText = result[i]['first_name'];

                    var td_role = document.createElement('td');
                    td_role.id = "td_role" + i.toString();
                    $(Jquery_tr).append(td_role);
                    td_role.innerText = result[i]['roles'];

                    var td_mail = document.createElement('td');
                    td_mail.id = "td_mail" + i.toString();
                    $(Jquery_tr).append(td_mail);
                    td_mail.innerText = result[i]['mail'];

                }
            },
            error: function (err) {
                console.log("Dans err");
                console.log(err);
            }
        })

    });
    /**** AJAX AND JS ****/
</script>