<?php

/** @brief Model class for user's data : e-mail address, role 
	* (Client/Admin/Both), ...
	* Data can come from a session or a query to the database. */

	class ModelUser extends Model
	{

		// Lock the user's name and his e-mail address.
		private $nom;
		private $email;


		/** Constructor by default (Initialization of the table of errors to an empty state). */
		public function __construct($dataError)
		{
			parent::__construct($dataError);
		}


		/** Return the name of the current user. */
		public function getNom()
		{
			return $this->nom;
		}


		/** Return the e-mail of the current user. */
		public function getMail()
		{
			return $this->mail;
		}


		/** @brief Function to generate a random session ID. */
		public static function generateSessionId()
		{
        // Génération de 10 octets (pseudo-)aléatoires codés en hexa
		// Generation of 10 (allegedly) random bytes, coded in hexadecimal.
        $cryptoStrong = false; // Variable for transit by reference.
        $octets = openssl_random_pseudo_bytes(10, $cryptoStrong);
        $mySid = bin2hex($octets);
        return $mySid;
    }


    /** @brief Insert a user by creating a new ID in the database. */
    public static function getModelUserCreate($inputArray)
    {
    	$model = new self(array());
    	$model->nom = "L'utilisateur a été ajouté à la BDD !";
    	$inputArray['password'] = hash("sha1", $inputArray['password']);
    	$inputArray['id_user'] = substr(abs(crc32(uniqid())), 0, 8);
        // Execution of the insertion query.
    	$data = array($inputArray["id_user"], $inputArray["last_name"], $inputArray["first_name"], $inputArray["mail"], $inputArray["password"], $inputArray["birthday"], $inputArray["phone_number"], 0);
    	$result = DataBaseManager::getInstance()->prepareAndLaunchQuery("SELECT * FROM users WHERE mail=?", array($inputArray["mail"]));
    	if (count($result) > 0) {
    		$model->dataError["doublon"] = "Utilisateur déjà inscrit avec cette adresse";
    		return $model;
    	}

    	$queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery("INSERT INTO users (id_user,last_name,first_name,mail,password,birthday,phone_number,roles) VALUES (?,?,?,?,?,?,?,?)", $data);
    	if ($queryResults === false) {
    		$model->dataError["persistance"] = "Probleme d'éxécution de la requête avec ces paramètres: " . implode(',', $inputArray);
    	}
    	return $model;
    }


    /** @brief Connection of a user. */
    public static function getModelUserConnexion($inputArray)
    {
    	$model = new self(array());
    	$model->nom = "Connexion à la BDD !";
        // Execution of the query via the connection class (singleton). Potential customized exceptions are handled by the Controller.
    	$args = array($inputArray["mail"]);
    	$hashedPassword = hash("sha1", $inputArray['password']);
    	$queryResults = DataBaseManager::getInstance()->prepareAndLaunchQuery('SELECT t1.*, t2.id_accomodation from users t1 left join accomodation t2 on t1.id_user = t2.id_user WHERE mail=?', $args);
        // If the query is successful.
    	if ($queryResults !== false) {
    		if (count($queryResults) == 1) {
    			if ($hashedPassword == $queryResults[0]['password']) {
    				$model->email = $queryResults[0]['mail'];
    				$_SESSION['email'] = $queryResults[0]['mail'];
    				$_SESSION['role'] = $queryResults[0]['roles'];
    				$_SESSION['nom'] = $queryResults[0]['last_name'];
    				$_SESSION['prenom'] = $queryResults[0]['first_name'];
    				$_SESSION['id_user'] = $queryResults[0]['id_user'];
    				$_SESSION['id_accomodation'] = $queryResults[0]['id_accomodation'];
    				return $model;
    			} else {
    				$model->dataError["persistance"] = "Mot de passe incorrect. Réessayez";
    				return $model;
    			}
    		} else {
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
