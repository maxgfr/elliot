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
			$inputArray['password'] = hash("sha1", $inputArray['password']);
			$inputArray['id_user'] = substr(abs(crc32(uniqid())), 0, 8);
		     //Vérification des erreurs si une vérification a été exigée
		     if (empty($model->dataError)) {
		         // Execution de la requête d'insertion' :
		         $queryResults = DataBaseManager::getInstance()->prepareAndExecuteQueryAssoc("INSERT INTO users (id_user,last_name,first_name,mail,password,birthday,phone_number) VALUES (:id_user,:last_name,:first_name,:mail,:password,:birthday,:phone_number)", $inputArray);
		         if ($queryResults === false) {
		             $model->dataError["persistance"] = "Probleme d'execution de la requête avec ces paramètres: ".implode(',', $inputArray).uniqid();
		         }
		     } else {
		         $model->dataError = array_merge($model->dataError, $dataErrorAttributes); // fusion
		     }
		    $model->nom = "L'utilisateur a été ajouté à la BDD !";
		    return $model;
	    }

		/** @brief Connexion d'un user */
	    public static function getModelUserConnexion($mail, $hashedPassword) {
			$model = new self(array());
			// Exécution de la requête via la classe de connexion (singleton). Le exceptions éventuelles, personnalisées, sont gérés par le Contrôleur
	        $args = array($mail, $hashedPassword);
	        $queryResults = DataBaseManager::getInstance()->prepareAndExecuteQuery('SELECT * FROM users WHERE mail=? AND password=?', $args);
	        //Si la requête a fonctionné
	        if ($queryResults !== false) {
	            if (count($queryResults) == 1) {
	                $model = $queryResults[0];
	            }
	            else{
	                return false ;
	            }
				SessionUtils::checkAndInitiateSession($model);
	            return $model;
	        } else {
	            $model->dataError['connexion'] = "Impossible d'acceder a la table des utilisateurs";
	            return $model;
	        }
	    }

    }
?>
