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

		/** Permet d' obtenir le nom /** 
		public function getNom(){
			return $this->nom;
		}

	   /**  public static function getModelMessageCreate($inputArray) {
		    $model = new self(array());
			$model->nom = "Ajout message à la BDD !";
			// Execution de la requête d'insertion' :
			$data = array($inputArray["id_sensor"],$inputArray["name"],$inputArray["state"]$inputArray["id_familysensor"],$inputArray["id_user"],$inputArray["id_room"]);
			$queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery("INSERT INTO message (id_sensor,name,state,id_familysensor,id_user,id_room) VALUES (?,?,?,?,?,?)",$data);
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
		    return $model;
	    }*/

	    public static function getModelMessageDisplay ($inputArray) {
			$model = new self(array());
			$model->nom = "Affichage des message de la BDD lié à l'utilisateur!";
			// Exécution de la requête via la classe de connexion (singleton). Le exceptions éventuelles, personnalisées, sont gérés par le Contrôleur
	        $args = array($inputArray["id_user"]);
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('SELECT * FROM message WHERE id_user=?', $args);
	        //Si la requête a fonctionné
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
			return $model;
	    }

	    public static function getModelMessageDelete ($inputArray) {
			$model = new self(array());
			$model->nom = "message supprimé de la BDD !";
			// Exécution de la requête via la classe de connexion (singleton). Le exceptions éventuelles, personnalisées, sont gérés par le Contrôleur
	        $args = array($inputArray["id_message"]);
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('DELETE FROM message WHERE id=?', $args);
	        //Si la requête a fonctionné
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
			return $model;
	    }

    }
?>
