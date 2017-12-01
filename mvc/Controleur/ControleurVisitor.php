<?php
    /** @brief ControleurVisitor identifie l'action et appelle la méthode pour construire le modèle correspondant à l'action avec le rôle "visitor". Le controleur appelle aussi la Vue correspondante. */
    class ControleurVisitor {

        function __construct ($action){
            if ($action == "index") {
                //s'il est pas connecté
                $action = "";
            }
            ///On distingue des cas d’utilisation, suivant l’action
            switch($action) {
                case "inscription" :
                    $this->actionInscription();
                    break;
                case "connexion" :
                    $this->actionConnexion();
                    break;
                default : // L'action indéfinie ( page par défaut , ici accueil )
                    require(Config::getVues()["connexion"]);
                    break;
            }
        }

        /** @brief Inscription d'un utilisateur */
        private function actionInscription(){
          $model = ModelUser::getModelUserCreate($_POST);
            if ($model->getError ( ) === false ) {
                require(Config::getVues()["default"]);
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

          /** @brief Inscription d'un utilisateur */
          private function actionConnexion(){
            $model = ModelUser::getModelUserConnexion($_POST);
              if ( $model->getError ( ) === false ) {
                  require(Config::getVues()["default"]);
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
