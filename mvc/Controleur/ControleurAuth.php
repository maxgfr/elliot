<?php
	/** @brief Identifie l'action concernant l'authentification et appelle la méthode pour construire le modèle pour l'action. Le controleur appelle aussi la vue correspondante. Il ne gère pas les exceptions, qui remontent au Front Controller. */
	class ControleurAuth{
		/** @brief C’est dans le contructeur que le contrôleur fait son travail */
		function __construct($action){
			//On distingue des cas d’utilisation suivant l’action
			switch($action){
				case "home":
					require(Config::getVues()["default"]);
					break;
				case "ajoutCapteur" :
                    $this->actionAjoutCapteur();
                    break;
                case "afficheCapteur" :
                    $this->actionAfficheCapteur();
                    break;
				case "deleteCapteur" :
                    $this->actionDeleteCapteur();
                    break;
				case "ajoutBat" :
                    $this->actionAjoutBat();
                    break;
                case "afficheBat" :
                    $this->actionAfficheBat();
                    break;
				case "deleteBat" :
                    $this->actionDeleteBat();
                    break;

				default://L’action indéfinie (page par défaut, ici accueil)
					require(Config::getVues()["default"]);
					break;
			}
		}

		private function actionAjoutBat(){
          $model = ModelBat::getModelBatCreate($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["success"]);
            } else {
                if (!empty($model->getError()['persistance'])){
                    // Erreur d'accès à la base de donnée
                    require(Config::getVuesErreur()["default"]);
                } else {
                    // Erreur de saisie
                    require(Config::getVuesErreur()["default"]);
                }
            }
          }

          private function actionAfficheBat(){
            $model = ModelBat::getModelBatDisplay($_POST);
              if ($model->getError ( ) === false ) {
                  require(Config::getVues()["afficheBat"]);
              } else {
                  if (!empty($model->getError()['persistance'])){
                      // Erreur d'accès à la base de donnée
                      require(Config::getVuesErreur()["default"]);
                  } else {
                      // Erreur de saisie
                      require(Config::getVuesErreur()["default"]);
                  }
              }
        }

        private function actionDeleteBat(){
          $model = ModelBat::getModelBatDelete($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["success"]);
            } else {
                if (!empty($model->getError()['persistance'])){
                    // Erreur d'accès à la base de donnée
                    require(Config::getVuesErreur()["default"]);
                } else {
                    // Erreur de saisie
                    require(Config::getVuesErreur()["default"]);
                }
            }
          }

        private function actionAjoutCapteur(){
          $model = ModelCapteur::getModelCapteurCreate($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["ajoutCapteur"]);
            } else {
                if (!empty($model->getError()['persistance'])){
                    // Erreur d'accès à la base de donnée
                    require(Config::getVuesErreur()["default"]);
                } else {
                    // Erreur de saisie
                    require(Config::getVuesErreur()["default"]);
                }
            }
          }

          private function actionAfficheCapteur(){
            $model = ModelCapteur::getModelCapteurDisplay($_POST);
              if ($model->getError ( ) === false ) {
                  require(Config::getVues()["afficheCapteur"]);
              } else {
                  if (!empty($model->getError()['persistance'])){
                      // Erreur d'accès à la base de donnée
                      require(Config::getVuesErreur()["default"]);
                  } else {
                      // Erreur de saisie
                      require(Config::getVuesErreur()["default"]);
                  }
              }
        }

        private function actionDeleteCapteur(){
          $model = ModelCapteur::getModelCapteurDelete($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["deleteCapteur"]);
            } else {
                if (!empty($model->getError()['persistance'])){
                    // Erreur d'accès à la base de donnée
                    require(Config::getVuesErreur()["default"]);
                } else {
                    // Erreur de saisie
                    require(Config::getVuesErreur()["default"]);
                }
            }
          }

	}
?>
