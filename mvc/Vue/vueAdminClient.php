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
  This view displays informations about a particular client.
  The user may acknowledge the client's subscription data 
  and his current notifications for support purposes.
-->
<!-- //////////////////////////////////////////////////////////// -->



<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title> DomISEP </title>
	<link rel="stylesheet" href="../../css/profil.css">
	<link href="../../css/notification.css" rel="stylesheet" type="text/css"/>

</head>


<?php include("layouts/header.php"); ?>


<body>

	<div id="main">
		<div id='container_profile'>
			<!-- Set the client subscription data template. -->
			<div id="container_contact_details">
				<div id="contact_details_text">
					Fiche client
				</div>
				<div id="contact_details">
					<div class="profileData">
						<div class="textFromDatabase" style="margin-bottom:12px;">
							<div class="headerTable" id="headerTable"></div>
						</div>
						<div class="textFromDatabase" style="margin-bottom:12px;">
							<div id="addressTable"></div>
						</div>
						<div class="textFromDatabase" style="margin-bottom:12px;">
							<div id="mailTable"></div>
						</div>
						<div class="textFromDatabase" style="margin-bottom:12px;">
							<div id="birthdayTable"></div>
						</div>
					</div>
				</div>
			</div>

			<!-- Display/Set the client's current notifications. -->
			<div id="container_change_password">
				<div id="change_password_text">
					Notifications
				</div>
				<div id="contact_details_input">
					<table>
						<tr>
							<td>La batterie du capteur 25643 doit être rechargée (10%).</td>
						</tr>
						<tr>
							<td>La connexion entre deux capteurs n'est plus assurée.</td>
						</tr>
						<tr>
							<td>Le capteur 23 n'est plus fonctionnel.</td>
						</tr>
						<tr>
							<td>Le capteur 6544 n'est plus fonctionnel.</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

</body>
</html>



<!-- Display the client's subscription data. -->
<script src="../../js/AdminClient.js"></script>



<!-- Select the background color according to the user's status. -->
<script>

	if (getCookie("cookie_toggle_state")==1) {
    $('#container_profile').css({"background-image":"linear-gradient(rgb(46,50,62), rgb(66,70,82))"})
}
if (getCookie("cookie_toggle_state")==0) {
    $('#container_profile').css({"background-image":"linear-gradient(rgb(25, 50, 100), rgb(38, 67, 120))"})
}

</script>
