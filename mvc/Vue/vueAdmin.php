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
    <title> Administrateur </title>
    <link href="../../css/admin.css" rel="stylesheet" type="text/css"/>
    <script src="../../js/jquery-3.2.1.min.js"></script>

</head>

<?php include("layouts/header.php"); ?>

<body>

<div id="main">
    <div class="containerListClients">
        <div class="selectionBox" id="selection_box_admin">
            <div id="department">
                <label for="selection_department">Département</label>
                <select name="selection_bdepartment">
                    <option>Tous les départements</option>
                    <option>01 Ain</option>
                    <option>02 Aisne</option>
                    <option>03 Allier</option>
                    <option>04 Alpes-de-Haute-Provence</option>
                    <option>05 Hautes-Alpes</option>
                    <option>06 Alpes-Maritimes</option>
                    <option>07 Ardèche</option>
                    <option>08 Ardennes</option>
                    <option>09 Ariège</option>
                    <option>10 Aube</option>
                    <option>11 Aude</option>
                    <option>12 Aveyron</option>
                    <option>13 Bouches-du-Rhône</option>
                    <option>14 Calvados</option>
                    <option>15 Cantal</option>
                    <option>16 Charente</option>
                    <option>17 Charente-Maritime</option>
                    <option>18 Cher</option>
                    <option>19 Corrèze</option>
                    <option>2A Corse-du-Sud</option>
                    <option>2B Haute-Corse</option>
                    <option>21 Côte-d'Or</option>
                    <option>22 Côtes-d'Armor</option>
                    <option>23 Creuse</option>
                    <option>24 Dordogne</option>
                    <option>25 Doubs</option>
                    <option>26 Drôme</option>
                    <option>27 Eure</option>
                    <option>28 Eure-et-Loir</option>
                    <option>29 Finistère</option>
                    <option>30 Gard</option>
                    <option>31 Haute-Garonne</option>
                    <option>32 Gers</option>
                    <option>33 Gironde</option>
                    <option>34 Hérault</option>
                    <option>35 Ille-et-Vilaine</option>
                    <option>36 Indre</option>
                    <option>37 Indre-et-Loire</option>
                    <option>38 Isère</option>
                    <option>39 Jura</option>
                    <option>40 Landes</option>
                    <option>41 Loir-et-Cher</option>
                    <option>42 Loire</option>
                    <option>43 Haute-Loire</option>
                    <option>44 Loire-Atlantique</option>
                    <option>45 Loiret</option>
                    <option>46 Lot</option>
                    <option>47 Lot-et-Garonne</option>
                    <option>48 Lozère</option>
                    <option>49 Maine-et-Loire</option>
                    <option>50 Manche</option>
                    <option>51 Marne</option>
                    <option>52 Haute-Marne</option>
                    <option>53 Mayenne</option>
                    <option>54 Meurthe-et-Moselle</option>
                    <option>55 Meuse</option>
                    <option>56 Morbihan</option>
                    <option>57 Moselle</option>
                    <option>58 Nièvre</option>
                    <option>59 Nord</option>
                    <option>60 Oise</option>
                    <option>61 Orne</option>
                    <option>62 Pas-de-Calais</option>
                    <option>63 Puy-de-Dôme</option>
                    <option>64 Pyrénées-Atlantiques</option>
                    <option>65 Hautes-Pyrénées</option>
                    <option>66 Pyrénées-Orientales</option>
                    <option>67 Bas-Rhin</option>
                    <option>68 Haut-Rhin</option>
                    <option>69 Rhône</option>
                    <option>70 Haute-Saône</option>
                    <option>71 Saône-et-Loire</option>
                    <option>72 Sarthe</option>
                    <option>73 Savoie</option>
                    <option>74 Haute-Savoie</option>
                    <option>75 Paris</option>
                    <option>76 Seine-Maritime</option>
                    <option>77 Seine-et-Marne</option>
                    <option>78 Yvelines</option>
                    <option>79 Deux-Sèvres</option>
                    <option>80 Somme</option>
                    <option>81 Tarn</option>
                    <option>82 Tarn-et-Garonne</option>
                    <option>83 Var</option>
                    <option>84 Vaucluse</option>
                    <option>85 Vendée</option>
                    <option>86 Vienne</option>
                    <option>87 Haute-Vienne</option>
                    <option>88 Vosges</option>
                    <option>89 Yonne</option>
                    <option>90 Territoire de Belfort</option>
                    <option>91 Essonne</option>
                    <option>92 Hauts-de-Seine</option>
                    <option>93 Seine-Saint-Denis</option>
                    <option>94 Val-de-Marne</option>
                    <option>95 Val-d'Oise</option>
                    <option>971 Guadeloupe</option>
                    <option>972 Martinique</option>
                    <option>973 Guyane</option>
                    <option>974 Réunion</option>
                    <option>975 Saint-Pierre-et-Miquelon</option>
                    <option>976 Mayotte</option>
                    <option>986 Wallis-et-Futuna</option>
                    <option>987 Polynésie française</option>
                </select>
            </div>
            <div id="city">
                <label for="selection_city">Ville</label>
                <select name="selection_city">
                    <option>Toutes les villes</option>
                    <option>Ville 1</option>
                    <option>Ville 2</option>
                    <option>Ville 3</option>
                    <option>Ville 4</option>
                </select>
            </div>
            <div id="building">
                <label for="selection_building">Bâtiment</label>
                <select name="selection_building">
                    <option>Tous les bâtiments</option>
                    <option>Bâtiment 1</option>
                    <option>Bâtiment 2</option>
                    <option>Bâtiment 3</option>
                    <option>Bâtiment 4</option>
                </select>
            </div>
        </div>

        <div class="listClients">
            <div id="header_list_clients">
                <li>Nom Prénom</li>
                <li>N° maison</li>
                <li>Bâtiment</li>
                <li>Lieu</li>
                <li>Adresse mail</li>
                <li id="footer_list_clients">Notifications</li>
            </div>
            <!--Juste pour la démo, l'optimisation sera faite plus tard-->
            <div id="list1">
                <li id="test" onclick="window.location.href='vueAdminClient.php'">DomISEP</li>
                <li>28</li>
                <li>Notre-Dame des Champs</li>
                <li>Paris, Ile-de-France</li>
                <li>domisep@isep.fr</li>
                <li id="footer_list_clients">Batterie: 10%</li>
            </div>
            <div id="list2">
                <li id="test">Dupont Dupond</li>
                <li>30</li>
                <li>Tour Montparnasse</li>
                <li>Paris, Ile-de-France</li>
                <li>dupont@dupond.fr</li>
                <li id="footer_list_clients">Capteur non fonctionnel</li>
            </div>
            <div id="list3">
                <li id="test">Serge</li>
                <li>1</li>
                <li>Edmon Richard</li>
                <li>Bourg-en-Bresse, Ain</li>
                <li>serge_lm@hotmail.fr</li>
                <li id="footer_list_clients">Connexion non assurée</li>
            </div>
        </div>
    </div>
</div>
</body>
</html>
