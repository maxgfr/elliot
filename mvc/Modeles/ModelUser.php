<?php
	/** @brief Classe Modèle pour les données de l'utilisateur
	* e-mail (qui sert ici de email), rôle (visitor, admin, etc...)
	* Les données peuvent venir d'une session ou d'un accès à la BD. */
	class ModelUser extends Model
	{
		private $nom;

		private $email;

		/** Constructeur par défaut (Init. du tableau d'erreurs à vide) */
		public function __construct ($dataError) {
			parent::__construct ($dataError);
		}

		/** Permet d' obtenir le nom */
		public function getNom(){
			return $this->nom;
		}

		/** Permet d' obtenir l'adresse email (email) */
		public function getMail(){
			return $this->mail;
		}

	    /** @brief Insère un user en créant un nouvel ID dans la BD. */
	    public static function getModelUserCreate($inputArray) {
		    $model = new self(array());
			$model->nom = "L'utilisateur a été ajouté à la BDD !";
			$inputArray['password'] = hash("sha1", $inputArray['password']);
			$inputArray['id_user'] = substr(abs(crc32(uniqid())), 0, 8);
			// Execution de la requête d'insertion' :
			$data = array($inputArray["id_user"],$inputArray["last_name"],$inputArray["first_name"],$inputArray["mail"],$inputArray["password"],$inputArray["birthday"],$inputArray["phone_number"]);
			$result = DataBaseManager::getInstance()->prepareAndLaunchQuery("SELECT * FROM users WHERE mail=?",array($inputArray["mail"]));
			if (count($result) > 0) {
				$model->dataError["doublon"] = "Utilisateur déjà inscrit avec cette adresse";
				return $model;
			}

			$queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery("INSERT INTO users (id_user,last_name,first_name,mail,password,birthday,phone_number) VALUES (?,?,?,?,?,?,?)",$data);
			if ($queryResults === false) {
			   $model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: ".implode(',', $inputArray);
			}
		    return $model;
	    }

		/** @brief Connexion d'un user */
	    public static function getModelUserConnexion($inputArray) {
			$model = new self(array());
			$model->nom = "Connexion à la BDD !";
			// Exécution de la requête via la classe de connexion (singleton). Le exceptions éventuelles, personnalisées, sont gérés par le Contrôleur
	        $args = array($inputArray["mail"]);
			$hashedPassword = hash("sha1", $inputArray['password']);
	        $queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('SELECT * FROM users WHERE mail=?', $args);
	        //Si la requête a fonctionné
	        if ($queryResults !== false) {
	            if (count($queryResults) == 1) {
					$model->email = $queryResults[0]['mail'];
					if ($hashedPassword == $queryResults[0]['password']) {

						// Le numéro de session aléatoire
						$mySid =  self::generateSessionId();
						session_id($mySid);
						// Destruction du coockie avant de le recréer
						setcookie("session-id", "", time()-60, '/');
						// Création du cookie avec SID aléatoire. Validité du cookie : 2mn
						// Un pirate aura besoin de temps pour voler le cookie...
						setcookie("session-id", $mySid, time()+self::DUREE_COOKIE, '/');
						// On échappe, même si on sait qu'on a validé le username....
						$_SESSION['mail'] = htmlentities($model->email, ENT_QUOTES, "UTF-8");
						$_SESSION['ipAddress'] = $_SERVER['REMOTE_ADDR'];
						session_write_close();


						return $model;
					} else {
						$model->dataError["persistance"] = "Mot de passe incorrect. Réessayez ou cliquez sur \"Mot de passe oublié pour le réinitialiser\"";
						return $model;
					}
	            }
				else {
					$model->dataError["persistance"] = "Identifiant incorrect. Réessayez";
					return $model;
				}
	        } else {
	            $model->dataError['persistance'] = "Impossible d'accéder a la table des utilisateurs";
	            return $model;
	        }


	    }

    }
?>
