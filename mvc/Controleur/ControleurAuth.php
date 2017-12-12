<?php
	/** @brief Identifie l'action concernant l'authentification et appelle la méthode pour construire le modèle pour l'action. Le controleur appelle aussi la vue correspondante. Il ne gère pas les exceptions, qui remontent au Front Controller. */
	class ControleurAuth{
		/** @brief C’est dans le contructeur que le contrôleur fait son travail */
		function __construct($action){
			//On distingue des cas d’utilisation suivant l’action
			switch($action){
				case "home":
					require(Config::getVues()["default"]);
					break;
				default://L’action indéfinie (page par défaut, ici accueil)
					require(Config::getVues()["default"]);
					break;
			}
		}

	}
?>
