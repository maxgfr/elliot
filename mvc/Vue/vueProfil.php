<?php
  //Voir les erreurs
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  // Répertoire racine du MVC
  $rootDirectory = dirname(__FILE__)."/../../mvc/";
  // chargement de la classe Autoload pour autochargement des classes
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

        <div id="container_change_profile">
            <div id="container_change_profile_input">
                <div id="container_contact_details">
                    <div id="contact_details_text">
                        Votre profil
                    </div>
                    <div id="contact_details_input">
                        <div class="profileData">
                            <div class="textFromDatabase">
                                Nom
                            </div>
                        </div>
                        <div class="dropdownBox" id="dropdown_accomodation">
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
                        </div>
                        <div class="dropdownBox" id="dropdown_building">
                            <div class="inputPartDropdown">
                                <div class="inputForDropdown">
                                    <input type="text" class="getInput" name="building" placeholder="Sélectionner un bâtiment">
                                </div>
                                <div class="activeArrow">
                                    <img src="../../img/arrowIcon.png" class="arrowImage" alt="arrow icon">
                                </div>
                            </div>
                            <div class="choicePartDropdown">
                                <nav>
                                    <li>Appartement 346</li>
                                    <li>Appartement 5</li>
                                    <li>Appartement 46</li>
                                    <li>Appartement 5</li>
                                    <li>Appartement 46</li>
                                    <li>Appartement 5</li>
                                    <li>Appartement 46</li>
                                    <li>Appartement 5</li>
                                </nav>
                            </div>
                        </div>
                        <input type="tel" name="landline_phone" placeholder="Téléphone fixe">
                    </div>
                </div>
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

    </div>
</body>

<script type="text/javascript" src="../../js/profil.js"></script>

</html>
