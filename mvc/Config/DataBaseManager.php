<?php
	/** @brief Permet de gérer la connexion à une base de données (ici MySQL)
	 * L'exécution de requêtes SQL avec préparation "offerte service compris".
	 * La classe est gérée avec le pattern SINGLETON, qui permet
	 * d'avoir un exemplaire unique du gestionaire de connexion,
	 * pour une connexion persistante.
	 * La classe encapsule complètement PDO, y compris les exceptions. */
	class DataBaseManager{
		/** Gestionnaire de connexion à la base de données avec PDO */
		private  $dbh = null;

		/** Référence de l'unique instance de la classe suivant le modèle Singleton.
		* Initialement null */
		private static $instance=null;

		/** @brief Constructeur qui crée une instance de PDO avec données UTF8
		* Le constructeur est privé : Personne ne peut créer des instances
		* car dans le singleton il ne doit y avoir qu'une seule instance.
		* Récupère les exception PDO et établit le mode d'erreur "EXCEPTION".
		* @throws exception personnalisée en cas d'exception PDO */
		private function __construct(){
			try {
				Config::getAuthData($db_host, $db_name, $db_user, $db_password);
				// Création de l'instance de PDO (database handler).
				$this->dbh = new PDO($db_host.$db_name, $db_user, $db_password);

				// Rendre les erreurs PDO détectables et gérables par exceptions :
				$this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				$this->dbh->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND,'SET NAMES UTF8');

			}catch (\PDOException $e){
				throw new \Exception("Erreur de connexion à la base de données.");
			}
		}

		/** @brief Méthode statique publique d'accès à l'unique instance.
		* Si l'instance n'existe pas, elle est crée. On retourne l'unique instance */
		public static function getInstance()
		{
			if (null === self::$instance) {
			  self::$instance = new self;
			}
			return self::$instance;
		}

		/** @brief Prépare et exécute une requête.
		* @param $requete  requête avec des ":name" pour PDO::prepare
		* @param $data tableau des valeurs
		* @return false si la requête échoue,
		*         true si succès ET requête différente de SELECT,
		*         ou résultats du SELECT dans un array à double entrée PHP standard
		* @throws exception personnalisée en cas d'exception PDO */
		public function prepareAndLaunchQuery($requete, $data) {

			// Une requête préparée ne doit pas contenir de guillemets !!!
			if (empty($requete) || !is_string($requete) || preg_match('/(\"|\')+/', $requete) !== 0){
				throw new \Exception("Erreur concernant la sécurité. Requête incomplètement préparée.");
			}

			// On ne laisse pas remonter d'exceptions PDO
			try{
				// Préparation de la requête
				$statement = $this->dbh->prepare($requete);
				if ($statement !== false){ // si la syntaxe est correcte
					$statement->execute($data);
				}
			} catch (\Exception $e){
				return false;
			}

			if ($statement === false){
				return false;
			}

			try{
				// Transfert des résultats de la requête dans un array
				$results = $statement->fetchAll(\PDO::FETCH_ASSOC);
				// destruction des données du PDOstatement
				$statement->closeCursor();
			} catch (\PDOException $e){
				// La requête a été exécutée mais pas de résultats
				// La requête n'est pas de type SELECT...
				$results = true;
			}

			// Libération via la garbage collector
			$statement = null;

			return $results; // retour des données de requête
		}


		/** @brief Prépare et exécute une requête.
		* @param $requete  requête avec des ":name" pour PDO::prepare
		* @return false si la requête échoue,
		*         true si succès ET requête différente de SELECT,
		*         ou résultats du SELECT dans un array à double entrée PHP standard
		* @throws exception personnalisée en cas d'exception PDO */
		public function prepareAndLaunchQueryWithoutData($requete) {

			// Une requête préparée ne doit pas contenir de guillemets !!!
			if (empty($requete) || !is_string($requete) || preg_match('/(\"|\')+/', $requete) !== 0){
				throw new \Exception("Erreur concernant la sécurité. Requête incomplètement préparée.");
			}

			// On ne laisse pas remonter d'exceptions PDO
			try{
				// Préparation de la requête
				$statement = $this->dbh->prepare($requete);
				if ($statement !== false){ // si la syntaxe est correcte
					$statement->execute();
				}
			} catch (\Exception $e){
				return false;
			}

			if ($statement === false){
				return false;
			}

			try{
				// Transfert des résultats de la requête dans un array
				$results = $statement->fetchAll(\PDO::FETCH_ASSOC);
				// destruction des données du PDOstatement
				$statement->closeCursor();
			} catch (\PDOException $e){
				// La requête a été exécutée mais pas de résultats
				// La requête n'est pas de type SELECT...
				$results = true;
			}

			// Libération via la garbage collector
			$statement = null;

			return $results; // retour des données de requête
		}

		/** @brief on interdit le clonage (pour le pattern singleton). */
		private function __clone(){}
	}
?>
