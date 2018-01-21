<?php

  /** @brief Identify the action regarding the authentification and call a method to build a suited model for the action. The controler also calls the suied view. It doesn't handle exceptions, which are redirected to the Front Controller. */

	class ControleurAuth{

    /** @brief The controller do its job in the constructor. */
		function __construct($action){
			/// Several use cases are distinguished according to the action.
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

                // The undefined action (here, vueAccueil.php or vueAdmin.php).
				default: 
					require(Config::getVues()["default"]);
					break;
			}
		}


        /** @brief Addition of a building. */
		private function actionAjoutBat(){
            $model = ModelBat::getModelBatCreate($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["success"]);
            } else {
                if (!empty($model->getError()['persistance'])){
                    // Error when accessing to the database.
                    require(Config::getVuesErreur()["default"]);
                } else {
                    // Typing error.
                    require(Config::getVuesErreur()["default"]);
                }
            }
        }


        /** @brief Display of a building. */
        private function actionAfficheBat(){
            $model = ModelBat::getModelBatDisplay($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["afficheBat"]);
            } else {
                if (!empty($model->getError()['persistance'])){
                    // Error when accessing to the database.
                    require(Config::getVuesErreur()["default"]);
                } else {
                    // Typing error.
                    require(Config::getVuesErreur()["default"]);
                }
            }
        }


        /** @brief Withdrawal of a building. */
        private function actionDeleteBat(){
            $model = ModelBat::getModelBatDelete($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["success"]);
            } else {
                if (!empty($model->getError()['persistance'])){
                    // Error when accessing to the database.
                    require(Config::getVuesErreur()["default"]);
                } else {
                    // Typing error.
                    require(Config::getVuesErreur()["default"]);
                }
            }
          }


        /** @brief Addition of a sensor. */
        private function actionAjoutCapteur(){
          $model = ModelCapteur::getModelCapteurCreate($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["ajoutCapteur"]);
            } else {
                if (!empty($model->getError()['persistance'])){
                    // Error when accessing to the database.
                    require(Config::getVuesErreur()["default"]);
                } else {
                    // Typing error.
                    require(Config::getVuesErreur()["default"]);
                }
            }
          }


        /** @brief Display of a sensor. */
        private function actionAfficheCapteur(){
            $model = ModelCapteur::getModelCapteurDisplay($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["afficheCapteur"]);
            } else {
                if (!empty($model->getError()['persistance'])){
                    // Error when accessing to the database.
                    require(Config::getVuesErreur()["default"]);
                } else {
                    // Typing error.
                    require(Config::getVuesErreur()["default"]);
                }
            }
        }


        /** @brief Withdrawal of a sensor. */
        private function actionDeleteCapteur(){
          $model = ModelCapteur::getModelCapteurDelete($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["deleteCapteur"]);
            } else {
                if (!empty($model->getError()['persistance'])){
                    // Error when accessing to the database.
                    require(Config::getVuesErreur()["default"]);
                } else {
                    // Typing error.
                    require(Config::getVuesErreur()["default"]);
                }
            }
        }

	}

?>
