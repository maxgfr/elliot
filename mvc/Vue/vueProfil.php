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


<?php include("layouts/header.php"); ?>


<body>
    <div id="main">

        <div id="container_profile">
            <!-- Display/Set the user informations request. -->
            <div id="container_contact_details">
                <div id="contact_details_text">
                    Votre profil
                </div>
                <div id="contact_details">
                    <div class="profileData">
                        <div class="textFromDatabase">
                            Nom
                        </div>
                    </div>
                    <div class="dropdownBox">
                        <select id="dropdown_accomodation" name="">
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                    <!--div class="dropdownBox" id="dropdown_accomodation">
                        <div class="inputPartDropdown">
                            <div class="inputForDropdown">
                                <input type="text" class="getInput" name="accomodation" placeholder="Sélectionner une maison">
                            </div>
                            <div class="activeArrow">
                                <img src="../../img/arrowIcon.png" class="arrowImage" alt="arrow icon">
                            </div>
                        </div>
                        <div class="choicePartDropdown">
                            <nav>
                                <li>Appartement 4609876</li>
                                <li>Appartement 264</li>
                                <li>Appartement 974</li>
                                <li>Appartement 432</li>
                            </nav>
                        </div>
                    </div-->
                    <input type="tel" name="landline_phone" placeholder="Téléphone fixe">
                </div>
            </div>
            <!-- Display/Set the password change request. -->
            <div id="container_change_password">
                <div id="change_password_text">
                    Voulez-vous changer de mot de passe ?
                </div>
                <div id="contact_details_input">
                    <input type="email" name="mail" placeholder="Adresse mail">
                    <input type="password" name="last_password" placeholder="Ancien mot de passe">
                    <input type="password" name="new_password" placeholder="Nouveau mot de passe">
                    <input type="password" name="confirm_new_password" placeholder="Confirmer le nouveau mot de passe">
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


</html>
