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
  This view let the user submit a ticket to Domisep support in
  case of a specific problem that needs further explanations and
  deserves more particular assistance.
-->
<!-- //////////////////////////////////////////////////////////// -->



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Support </title>
    <link href="../../css/Support.css" rel="stylesheet" type="text/css"/>
</head>


<?php include("layouts/header.php"); ?>


<body>

    <div id="main">

        <div id="container_ticket">
            <div id="container_ticket_main">
                <!-- Set the message request. -->
                <div class="inputText">
                    <input type="text" name="motif" id="motif" placeholder="Motif de votre problème">
                </div>
                <div class="descriptionText">
                    <textarea name="description" id="description" style="resize:none" placeholder="Description détaillée de votre problème"></textarea>
                </div>
                <div class="confirmButton">
                    <button type="submit" name="button">Envoyer</button>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
