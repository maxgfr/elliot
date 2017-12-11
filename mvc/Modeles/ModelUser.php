<?php
	/** @brief Classe Modèle pour les données de l'utilisateur
	* e-mail (qui sert ici de email), rôle (visitor, admin, etc...)
	* Les données peuvent venir d'une session ou d'un accès à la BD. */
	class ModelUser extends Model
	{
		//adresse email de l'utilisateur
		private $email;

		/** Constructeur par défaut (Init. du tableau d'erreurs à vide) */
		public function __construct ($dataError) {
			parent::__construct ($dataError);
		}

		/** Permet d' obtenir l'adresse email (email) */
		public function getEmail(){
			return $this->email;
		}

	    /** @brief Insère un user en créant un nouvel ID dans la BD. */
	    public static function getModelUserCreate($inputArray) {
		    $model = new self(array());
			$model->nom = "L'utilisateur a été ajouté à la BDD !";
			$inputArray['password'] = hash("sha1", $inputArray['password']);
			$inputArray['id_user'] = substr(abs(crc32(uniqid())), 0, 8);
			// Execution de la requête d'insertion' :
			$data = array($inputArray["id_user"],$inputArray["last_name"],$inputArray["first_name"],$inputArray["mail"],$inputArray["password"],$inputArray["birthday"],$inputArray["phone_number"]);
			$result = DataBaseManager::getInstance()->prepareAndLaunchQuery("SELECT count(email) FROM users WHERE mail=?",array($inputArray["mail"]));
			if (count($result) != 1) {
				$model->dataError["persistance"] = "Utilisateur déjà inscrit avec cette adresse";
				return $model;
			}

			$queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery("INSERT INTO users (id_user,last_name,first_name,mail,password,birthday,phone_number) VALUES (?,?,?,?,?,?,?)",$data);
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'execution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
		    return $model;
	    }

		/** @brief Connexion d'un user */
	    public static function getModelUserConnexion($inputArray) {
			$model = new self(array());
			$model->nom = "Connexion à la BDD !";
			// Exécution de la requête via la classe de connexion (singleton). Le exceptions éventuelles, personnalisées, sont gérés par le Contrôleur
	        $args = array($inputArray["mail"], $inputArray["password"]);
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('SELECT * FROM users WHERE mail=? AND password=?', $args);
	        //Si la requête a fonctionné
	        if ($queryResults !== false) {
	            if (count($queryResults) == 1) {
	                $model = $queryResults[0];
	            }
	            else{
					$model->dataError['persistance'] = "Erreur d'idenditifiant/mot de passe, réessayer";
	                return false ;
	            }
	            return $model;
	        } else {
	            $model->dataError['persistance'] = "Impossible d'acceder a la table des utilisateurs";
	            return $model;
	        }
	    }

    }
?>
