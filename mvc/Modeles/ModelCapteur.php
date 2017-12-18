<?php
	/** @brief Classe Modèle pour les données de l'utilisateur
	* e-mail (qui sert ici de email), rôle (visitor, admin, etc...)
	* Les données peuvent venir d'une session ou d'un accès à la BD. */
	class ModelUser extends Model
	{
		private $nom;

		/** Constructeur par défaut (Init. du tableau d'erreurs à vide) */
		public function __construct ($dataError) {
			parent::__construct ($dataError);
		}

		/** Permet d' obtenir le nom */
		public function getNom(){
			return $this->nom;
		}

	    public static function getModelCapteurCreate($inputArray) {
		    $model = new self(array());
			$model->nom = "Ajout capteur à la BDD !";
			// Execution de la requête d'insertion' :
			$data = array($inputArray["id_user"],$inputArray["last_name"],$inputArray["first_name"],$inputArray["mail"],$inputArray["password"],$inputArray["birthday"],$inputArray["phone_number"]);
			$queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery("INSERT INTO users (id_user,last_name,first_name,mail,password,birthday,phone_number) VALUES (?,?,?,?,?,?,?)",$data);
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
		    return $model;
	    }

	    public static function getModelCapteurDisplay ($inputArray) {
			$model = new self(array());
			$model->nom = "Connexion capteur à la BDD !";
			// Exécution de la requête via la classe de connexion (singleton). Le exceptions éventuelles, personnalisées, sont gérés par le Contrôleur
	        $args = array($inputArray["mail"]);
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('SELECT * FROM sensors WHERE id_user=?', $args);
	        //Si la requête a fonctionné
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
			return $model;
	    }

	    public static function getModelCapteurDelete ($inputArray) {
			$model = new self(array());
			$model->nom = "Connexion capteur à la BDD !";
			// Exécution de la requête via la classe de connexion (singleton). Le exceptions éventuelles, personnalisées, sont gérés par le Contrôleur
	        $args = array($inputArray["mail"]);
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('DELETE * FROM sensors WHERE id_user=?', $args);
	        //Si la requête a fonctionné
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
			return $model;
	    }

    }
?>
