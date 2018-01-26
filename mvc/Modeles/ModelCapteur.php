<?php

	/** @brief Model class for sensor's data : parameters, rooms, ...
	* Data can come from a session or a query to the database. */

	class ModelCapteur extends Model
	{	

		// Lock the user's name.
		private $nom;


		/** Constructor by default (Initialization of the table of errors to an empty state). */
		public function __construct ($dataError) {
			parent::__construct ($dataError);
		}


		/** Return the name of the current user. */
		public function getNom(){
			return $this->nom;
		}


		/** Template for sensor creation. */
	    public static function getModelCapteurCreate($inputArray) {
		    $model = new self(array());
			$model->nom = "Ajout capteur à la BDD !";
			// Execution of the insertion query.
			$data = array($inputArray["id_sensor"],$inputArray["name"],$inputArray["state"]$inputArray["id_familysensor"],$inputArray["id_user"],$inputArray["id_room"]);
			$queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery("INSERT INTO sensors (id_sensor,name,state,id_familysensor,id_user,id_room) VALUES (?,?,?,?,?,?)",$data);
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
		    return $model;
	    }


	    /** Template for sensor display. */
	    public static function getModelCapteurDisplay ($inputArray) {
			$model = new self(array());
			$model->nom = "Affichage des capteurs de la BDD lié à l'utilisateur!";
			// Execution of the query via the connection class (singleton). Potential customized exceptions are handled by the Controller.
	        $args = array($inputArray["id_user"]);
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('SELECT * FROM sensors WHERE id_user=?', $args);
	        // If the query is successful.
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
			return $model;
	    }


	    /** Template for sensor withdrawal. */
	    public static function getModelCapteurDelete ($inputArray) {
			$model = new self(array());
			$model->nom = "Capteur supprimé de la BDD !";
			// Execution of the query via the connection class (singleton). Potential customized exceptions are handled by the Controller.
	        $args = array($inputArray["id_capteur"]);
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('DELETE FROM sensors WHERE id=?', $args);
	        // If the query is successful.
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
			return $model;
	    }

    }

?>
