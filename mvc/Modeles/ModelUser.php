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
         //Vérification des erreurs si une vérification a été exigée
         if (empty($model->dataError)) {
             // Execution de la requête d'insertion' :
             $queryResults = DataBaseManager::getInstance()->prepareAndExecuteQueryAssoc("REPLACE INTO user(last_name,first_name,phone_number,birthday,mail,password) VALUES (:last_name,:first_name,:phone_number,:birthday,:mail,:password)", $inputArray);
             if ($queryResults === false) {
                 $model->dataError["persistance"] = "Probleme d'execution de la requête";
             }
         } else {
             $model->dataError = array_merge($model->dataError, $dataErrorAttributes); // fusion
         }
        $model->nom = "L'utilisateur a été ajouté à la BDD !";
        return $model;
    }

    public static function createUser(&$dataError, $inputArray)
    {
        //Tentative de construction d'une instance ( et filtrage )
        $user = UserFabrique::getValidInstance($dataErrorAttributes, $inputArray);
        //Si la forme des attributs sont corrects ( expressions régulières - setters )
        $inputArray['nbAvertissements'] = 0;
        $inputArray['etatCompte'] = "activé";
        if (empty($dataErrorAttributes)) {
            // Execution de la requête d'insertion' :
            $queryResults = DataBaseManager::getInstance()->prepareAndExecuteQueryAssoc("REPLACE INTO user(prenom,nom,dateNaissance,pays,ville,username,mdp,email,tel,role,nbAvertissements,etatCompte) VALUES (:prenom,:nom,:dateNaissance,:pays,:ville,:username,:mdp,:email,:tel,:role,:nbAvertissements,:etatCompte)", $inputArray);
            if ($queryResults === false) {
                $dataError["persistance"] = "Probleme d'execution de la requête";
            }
        } else {
            $dataError = array_merge($dataError, $dataErrorAttributes); // fusion
        }
        $user->setUsername($inputArray['username']); // pour la valeur retournée
        return $user;
    }



    }
	}
?>
