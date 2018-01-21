<?php

	/** @brief Allow for management over the connection to the database 
	 * (here, MySQL), that is to say the execution of SQL queries with
	 * preparation, service included.
	 * This class is handled with the "SINGLETON" pattern which allows
	 * for a unique copy of a connection manager for a persistant
	 * connection.
	 * This class embeds PDO completely, exceptions included. */

	class DataBaseManager{

		/** Reference to the database when asking for a connection to it. */
		private  $dbh = null;

		/** Reference to the unique instance of the class following the
		"SINGLETON" model", originally null. */
		private static $instance=null;


		/** @brief Constructor creates a PDO instance with UTF8 data.
		* The constructor is private : Nobody can create instances because
		* there should only be 1 single instance in the singleton.
		* Retrieve PDO exception and establish the "EXCEPTION" error mode. */
		private function __construct(){
			try {
				Config::getAuthData($db_host, $db_name, $db_user, $db_password);
				// Creation of the PDO instance (Database handler).
				$this->dbh = new PDO($db_host.$db_name, $db_user, $db_password);

				// Allows PDO errors to be detectable and manageable by exceptions
				$this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				$this->dbh->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND,'SET NAMES UTF8');

			} catch (\PDOException $e){
				throw new \Exception("Erreur de connexion à la base de données.");
			}
		}


		/** @brief Public static method to access to the unique instance.
		* If the instance doesn't exist, it will be created and is then
		* returned. */
		public static function getInstance()
		{
			if (null === self::$instance) {
				self::$instance = new self;
			}
			return self::$instance;
		}


		/** @brief Prepare and execute a query.
		* @param $requete 	Query with ":name" for PDO::prepare.
		* @param $data 		Table of the wanted values.
		* @return false 	if the query fails,
		*		  true 		if the query success AND is different from
		*		 			SELECT, or its result in a array with 
		*		 			double PHP standard entry.
		* @throws Customized exception in case of PDO exception. */
		public function prepareAndLaunchQuery($requete, $data) {

			// A prepared query should not contain any quotation mark !!!
			if (empty($requete) || !is_string($requete) || preg_match('/(\"|\')+/', $requete) !== 0){
				throw new \Exception("Erreur concernant la sécurité. Requête incomplètement préparée.");
			}

			// PDO exceptions should be catched.
			try{
				// Preparation of the query
				$statement = $this->dbh->prepare($requete);
				if ($statement !== false){ // If the syntax is valid.
					$statement->execute($data);
				}
			} catch (\Exception $e){
				return false;
			}

			if ($statement === false){
				return false;
			}

			try{
				// Transfer of the results of the query in an array.
				$results = $statement->fetchAll(\PDO::FETCH_ASSOC);
				// Destruction  of data in the PDO statement.
				$statement->closeCursor();
			} catch (\PDOException $e){
				// The query has been executed, but gives no results
				// or is not of the "SELECT" type ...
				$results = true;
			}

			// Release via the garbage collector
			$statement = null;

			return $results; // Return of data of the query.
		}


		/** @brief Prepare and execute a query.
		* @param $requete 	Query with ":name" for PDO::prepare.
		* @return false 	if the query fails,
		*		  true 		if the query success AND is different from
		*		 			SELECT, or its result in a array with 
		*		 			double PHP standard entry.
		* @throws Customized exception in case of PDO exception. */
		public function prepareAndLaunchQueryWithoutData($requete) {

			// A prepared query should not contain any quotation mark !!!
			if (empty($requete) || !is_string($requete) || preg_match('/(\"|\')+/', $requete) !== 0){
				throw new \Exception("Erreur concernant la sécurité. Requête incomplètement préparée.");
			}

			// PDO exceptions should be catched.
			try{
				// Preparation of the query
				$statement = $this->dbh->prepare($requete);
				if ($statement !== false){ // If the syntax is valid.
					$statement->execute();
				}
			} catch (\Exception $e){
				return false;
			}

			if ($statement === false){
				return false;
			}

			try{
				// Transfer of the results of the query in an array.
				$results = $statement->fetchAll(\PDO::FETCH_ASSOC);
				// Destruction  of data in the PDO statement.
				$statement->closeCursor();
			} catch (\PDOException $e){
				// The query has been executed, but gives no results
				// or is not of the "SELECT" type ...
				$results = true;
			}

			// Release via the garbage collector
			$statement = null;

			return $results; // Return of data of the query.
		}


		/** @brief Cloning is forbidden (for the "SINGLETON" pattern). */
		private function __clone(){}
	}

?>
