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
  This view displays the frequently asked questions and their
  usual answers.
  The user may contact Domisep by call or mail and find useful
  informations to resolve problems in his side on his own.
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
        <!-- Display the contact information of Domisep -->
        <h1 style="text-align:center"> Foire aux questions </h1>
        <h4>Numéro du support : <a href="tel:+33899123456">08 99 12 34 56</a> (appel gratuit)</h4>
        <h4>Mail du support : <a href="mailto:support.domisep@elliot.com">support.domisep@elliot.com</a></h4>
        <br>

        <!-- Display the FAQ and its answers. -->
        <details>
            <summary class="summary_FAQ"><strong>I. Je souhaite connaître l'avancement de ma commande.</strong></summary>
            <p>
              Merci d'avoir choisi Domisep pour équiper votre domicile !
              <br> N'hésitez pas à appeler directement le service Support Domisep 08 99 12 34 56 (appel gratuit) ou d'ouvrir un ticket de support via la page dédiée en mentionnant la section <em>Commande</em>.
              <br> Nos conseillers vous informeront précisémennt  l'état de votre commande.
            </p>
        </details>
        <br>

        <details>
            <summary class="summary_FAQ"><strong>II. Mon capteur/HAGbox est cassé !</strong></summary>
            <p>
            Si vous détenez un appareil défaillant, nous vous prions de nous le renvoyer à l'adresse suivante :
            <br> <strong>17 avenue de l'arnaque, 77700 Bailly-Romainvilliers.</strong>
            <br> Veuillez joindre à votre colis une lettre décrivant votre situation ainsi que votre numéro client. Nous vous recontacterons dès réception de votre colis.
            </p>
        </details>
        <br>

        <details>
            <summary class="summary_FAQ"><strong>III. Je ne reçois plus d'information venant de "tel capteur" !</strong></summary>
            <p>
            Si vous ne recevez plus aucune donnée venant d'un capteur, il se peut qu'il soit défaillant ou alors que la connexion du capteur au système général de Domisep soit brisée :
            <ul>
                <li> Dans le premier cas, veuillez vous référer à la question numéro II. </li>
                <li> Dans le second cas, par souci de sécurité, il est conseillé d'effectuer un REBOOT :
                <ul>
                    <li>Eteignez le capteur grâce au bouton associé. </li>
                    <li>Activez la recherche de capteurs par bluetooth via la page associée. </li>
                    <li>Rallumez le capteur grâce au bouton associé. </li>
                    <li>Attendez la confirmation de la connexion en vous plaçant de préférence près de la HAGbox. Cette reconnexion peut prendre quelques minutes.</li>
                </ul>
                Si votre problème persiste, nous vous conseillons d'appeler directement le service Support Domisep 08 99 12 34 56 (appel gratuit) ou d'ouvrir un ticket de support via la page dédiée en mentionnant la section <em>Connexion</em>.
                </li>
            </ul>
            Dans le cas où votre capteur envoie certains paramètres (e.g. température par exemple), mais pas d'autres (e.g. détecteur de présence), veuillez vous référer à la question numéro II.
            <br>Dans le cas où vous ne recevez les données d'aucun capteur, la HAGbox peut être à l'origine du problème.
            <br>Il faut alors REBOOT la HAGbox en la redémarrant et reconnecter les différents capteurs en effectuant la procédure précédente.
            <br>Si le problème persiste, votre appareil peut être défaillant : veuillez vous référer à la question numéro II.
            </p>
        </details>
        <br>

        <details>
            <summary class="summary_FAQ"><strong>IV. Je déménage et souhaite ré-aménager le système de capteurs à mon nouveau domicile.</strong></summary>
            <p>
            Le système général HAN a été conçu afin d'être facilement déployable : vous avez donc la possibilité de ré-aménager votre système à votre guise.
            <br> Si vous souhaitez optimiser votre architecture en fonction du plan de votre nouveau domicile, nous serons ravi de vous envoyer un expert Domisep afin de déployer votre système dans les meilleures configurations et recevoir des suggestions supplémentaires pour votre confort. Dans le cas échéant, veuillez appeler directement le service Support Domisep 08 99 12 34 56 (appel gratuit) ou d'ouvrir un ticket de support via la page dédiée en mentionnant la section <em>Architecture</em>.
            </p>
        </details>
        <br>

        <details>
            <summary class="summary_FAQ"><strong>V. Je souhaite me désabonner de Domisep.</strong></summary>
            <p>
            Nous sommes désolés de l'apprendre ...
            <br>Si vous souhaitez rompre votre contrat, veuillez appeler directement le service Support Domisep 08 99 12 34 56 (appel gratuit) ou d'ouvrir un ticket de support via la page dédiée en mentionnant la section <em>Abonnement</em>.
            <br>Afin de nous améliorer, nous souhaitons connaître la raison de votre départ en ouvrant un ticket de support via la page dédiée en mentionnant la section <em>Amélioration</em>.
            <br>Nous vous remercions pour la confiance que vous nous avez apporté.
            </p>
        </details>
        <br>

    </div>

</body>
</html>
