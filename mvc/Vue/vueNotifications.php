
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
if(empty($_SESSION['email'])) {
    header("Location:vueConnexion.php");
}
?>

<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!--
  This view displays the notifications.
  The user may choose whether or not to receive the notifications
  by SMS, as long as his phone number has been set.
-->
<!-- //////////////////////////////////////////////////////////// -->




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/notification.css">
    <title>Notifications</title>

    <?php include("layouts/header.php"); ?>

</head>


<body>

    <div id="main">
        <!-- Display the notifications. -->
        <h1> Vous avez 5 notifications</h1>

        <table>
            <tr>
                <th>Dates</th>
                <th>Objet</th>
                <th>Message</th>
            </tr>

        <!--
            <tr>
                <td><?php $insertdate; ?></td>
                <td><?php $insertobjet; ?></td>
                <td><?php $insertmessage; ?></td>
            </tr>
        -->

        <tr onclick="show('Notif_1');">
            <td>29 Novembre 2017</td>
            <td>Exemple 1</td>
            <td> Votre capteur est en manque de batterie</td>
        </tr>
        <tr id="Notif_1" style="display: none">
            <td style="border: none">
                Text en plus
            </td>
        </tr>

        <tr onclick="show('Notif_2');">
            <td>25 Novembre 2017</td>
            <td>Exemple 2</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
        </tr>
        <tr id="Notif_2" style="display: none">
            <td style="border: none">
                Text en plus
            </td>
        </tr>

        <tr onclick="show('Notif_3');">
            <td>19 Novembre 2017</td>
            <td>Exemple 3</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
        </tr>
        <tr id="Notif_3" style="display: none">
            <td style="border: none">
                Text en plus
            </td>
        </tr>

        <tr onclick="show('Notif_4');">
            <td>08 Octobre 2017</td>
            <td>Exemple 4</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
        </tr>
        <tr id="Notif_4" style="display: none">
            <td style="border: none">
                Text en plus
            </td>
        </tr>

        <tr onclick="show('Notif_5');">
            <td>17 Avril 1998</td>
            <td>Exemple 5</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
        </tr>
        <tr id="Notif_5" style="display: none">
            <td style="border: none">
                Text en plus
            </td>
        </tr>

        </table>

        <!-- Set the SMS notification choice. -->
        <form>
            <div>
                <p>Voulez-vous recevoir les notifications par sms ?</p>
                Oui<input type="radio" id="YES" name="show_notification" value="yes"> <br>
                Non<input type="radio" id="No" name="show_notification" value="no"> <br>
                <br/>
                <input type="submit" value="Enregistrer les modifications">
            </div>
        </form>
    </div>

<!-- Run the dynamic concept of notification pop-up. -->
<script type="text/javascript" src="../../js/Notif.js"></script>


</body>
</html>
