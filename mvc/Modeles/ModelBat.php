<?php

	/** @brief Model class for building's data : name, address, ...
	* Data can come from a session or a query to the database. */
	
	class ModelBat extends Model
	{

		// Lock the user's name and the attribute.
		private $nom;
		private $allItem; // Attribute.

		/** Constructor by default (Initialization of the table of errors to an empty state). */
		public function __construct ($dataError) {
			parent::__construct ($dataError);
		}

		/** Return the name of the current user. */
		public function getNom(){
			return $this->nom;
		}

		/** Return every element of the attribute. */
		public function getAll(){
			return $this->allItem;
		}


		/** Template for sensor creation. */
	    public static function getModelBatCreate($inputArray) {
		    $model = new self(array());
			$model->nom = "Un batiment a été ajouté à la BDD !";
			// Execution of the insertion query.
			$id = substr(abs(crc32(uniqid())), 0, 8);
			$data = array($id,$inputArray["name"],$inputArray["address"]);
			$queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery("INSERT INTO building (id_building,name,address) VALUES (?,?,?)",$data);
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
		    return $model;
	    }


	    /** Template for sensor display. */
	    public static function getModelBatDisplay ($inputArray) {
			$model = new self(array());
			$model->nom = "Affichage des Batiments de la BDD!";
			// Execution of the query via the connection class (singleton). Potential customized exceptions are handled by the Controller.
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQueryWithoutData('SELECT * FROM building');

			// Construction of the collect of results (Built-in).
			$collection = array();
			// If the query is successful.
			if($queryResults !== false){
				foreach($queryResults as $row){
					$collection[] = $row;
				}
			}else{
				$model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
			$model->allItem = $collection;
			return $model;
	    }


	    /** Template for building withdrawal. */
	    public static function getModelBatDelete ($inputArray) {
			$model = new self(array());
			$model->nom = "Batiment supprimé de la BDD !";
			// Execution of the query via the connection class (singleton). Potential customized exceptions are handled by the Controller.
	        $args = array($inputArray["id_building"]);
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('DELETE FROM building WHERE id=?', $args);
	        // If the query is successful.
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
			return $model;
	    }

    }

?>
