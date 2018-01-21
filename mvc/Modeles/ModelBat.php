<?php
	/** @brief Classe Modèle pour les données de l'utilisateur
	* e-mail (qui sert ici de email), rôle (visitor, admin, etc...)
	* Les données peuvent venir d'une session ou d'un accès à la BD. */
	class ModelBat extends Model
	{
		private $nom;
		private $allItem; //atribute

		/** Constructeur par défaut (Init. du tableau d'erreurs à vide) */
		public function __construct ($dataError) {
			parent::__construct ($dataError);
		}

		/** Permet d' obtenir le nom */
		public function getNom(){
			return $this->nom;
		}

		/** Permet d' obtenir le nom */
		public function getAll(){
			return $this->allItem;
		}

	    public static function getModelBatCreate($inputArray) {
		    $model = new self(array());
			$model->nom = "Un batiment a été ajouté à la BDD !";
			// Execution de la requête d'insertion' :
			$id = substr(abs(crc32(uniqid())), 0, 8);
			$data = array($id,$inputArray["name"],$inputArray["address"]);
			$queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery("INSERT INTO building (id_building,name,address) VALUES (?,?,?)",$data);
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
		    return $model;
	    }

	    public static function getModelBatDisplay ($inputArray) {
			$model = new self(array());
			$model->nom = "Affichage des Batiments de la BDD!";
			// Exécution de la requête via la classe de connexion (singleton). Le exceptions éventuelles, personnalisées, sont gérés par le Contrôleur
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQueryWithoutData('SELECT * FROM building');

			//Construction de la collection des résultats (fabrique)
			$collection = array();
			// Si l'exécution de la requête a fonctionné
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

	    public static function getModelBatDelete ($inputArray) {
			$model = new self(array());
			$model->nom = "Batiment supprimé de la BDD !";
			// Exécution de la requête via la classe de connexion (singleton). Le exceptions éventuelles, personnalisées, sont gérés par le Contrôleur
	        $args = array($inputArray["id_building"]);
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('DELETE FROM building WHERE id=?', $args);
	        //Si la requête a fonctionné
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
			return $model;
	    }

    }
?>
