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
  This view displays the user informations.
  The user may change its informations and change his passwords.
-->
<!-- //////////////////////////////////////////////////////////// -->



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/profil.css">
    <script type="text/javascript" src="../../js/password.js"></script>
    <title><?php echo $_SESSION['prenom'].' '.$_SESSION['nom']; ?></title>
</head>


<?php include("layouts/header.php");

$sql_query = "SELECT t1.*, t2.address
              FROM users t1
              LEFT JOIN accomodation t3 ON t3.id_user = t1.id_user
              LEFT JOIN building t2 ON t2.id_building = t3.id_building
              WHERE t1.id_user = ?";

// Execute the query
$query = DataBaseManager::getInstance()->prepareAndLaunchQuery($sql_query, [$_SESSION['id_user']]);
?>


<body>
    <div id="main">

        <div id='container_profile'>
            <!-- Display/Set the user informations request. -->
            <div id="container_contact_details">
                <div id="contact_details_text">
                    Votre profil
                </div>
                <div id="contact_details">
                    <div class="profileData">
                        <div class="textFromDatabase" style="margin-bottom:12px;">
                            Nom : <?php print_r($query[0]['last_name']); ?>
                        </div>
                        <div class="textFromDatabase" style="margin-bottom:12px;">
                            Prénom : <?php print_r($query[0]['first_name']); ?>
                        </div>
                        <div class="textFromDatabase" style="margin-bottom:12px;">
                            Adresse mail : <?php print_r($query[0]['mail']); ?>
                        </div>
                        <div class="textFromDatabase" style="margin-bottom:12px;">
                            Adresse de votre domicile : <?php echo "<br>"; print_r($query[0]['address']); ?>
                        </div>
                        <div class="textFromDatabase" style="margin-bottom:12px;">
                            Date de naissance : <?php setlocale(LC_TIME, "fr_FR");
                                                      echo strftime("%d %B %Y", strtotime($query[0]['birthday'])); ?>
                        </div>
                        <div class="textFromDatabase">
                            Téléphone : <?php echo "0";print_r($query[0]['phone_number']); ?>
                        </div>
                    </div>
                    <div class="confirmButton">
                        <button type="button">
                            Modifier mes informations
                        </button>
                    </div>
                    <div id="change_data_user" style="display:none">
                        <form class="changeProfileData" method="post">
                            <input type="text" name="last_name" placeholder="Changer votre nom">
                            <input type="text" name="first_name" placeholder="Changer votre prénom">
                            <input type="mail" name="mail" placeholder="Changer votre adresse mail">
                            <input type="text" name="address" placeholder="Changer votre adresse de domicile">
                            <input type="text" name="birthday" placeholder="Changer votre date de naissance">
                            <input type="tel" name="phone_number" placeholder="Changer votre numéro de téléphone">
                        </form>
                        <div id="cancel_or_save" style="display:flex; width:100%">
                            <div class="confirmButton" style="width:45%; margin-right:10%;">
                                <button type="button" name="button">Annuler</button>
                            </div>
                            <div class="confirmButton" style="width:45%;">
                                <button type="button" name="button">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Display/Set the password change request. -->
            <div id="container_change_password">
                <div id="change_password_text">
                    Voulez-vous changer de mot de passe ?
                </div>
                <div id="contact_details_input">
                    <form class="changePassword" method="post">
                        <input type="email" name="mail" placeholder="Adresse mail">
                        <input type="password" name="last_password" placeholder="Ancien mot de passe">
                        <input type="password" name="new_password" placeholder="Nouveau mot de passe">
                        <input type="password" name="confirm_new_password" placeholder="Confirmer le nouveau mot de passe">
                    </form>
                </div>
                <div class="confirmButton">
                    <button type="submit" name="button">Enregistrer les modifications</button>
                </div>
            </div>
        </div>

    </div>

</body>

<!-- Retrieve/Update data in the database. -->
<script type="text/javascript" src="../../js/profil.js"></script>

<script>
if (getCookie("cookie_toggle_state")==1) {
    // if we are inside vueAdmin set the grey color
    $('#container_profile').css({"background-image":"linear-gradient(rgb(46,50,62), rgb(66,70,82))"})
}
if (getCookie("cookie_toggle_state")==0) {
    // set the blue color
    $('#container_profile').css({"background-image":"linear-gradient(rgb(25, 50, 100), rgb(38, 67, 120))"})
}

</script>


</html>
