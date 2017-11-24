<?php
    /** @brief ControleurVisitor identifie l'action et appelle la méthode pour construire le modèle correspondant à l'action avec le rôle "visitor". Le controleur appelle aussi la Vue correspondante. */
    class ControleurVisitor {

        function __construct (){
            //Récupération de l'action
            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
            ///On distingue des cas d’utilisation, suivant l’action
            switch($action) {
                case "inscription" :
                    $this->actionInscription();
                    break;

                default : // L'action indéfinie ( page par défaut , ici accueil )
                    require(Config::getVues()["default"]);
                    break;
            }
        }

        /** @brief Inscription d'un utilisateur */
        private function actionInscription(){
          ValidationRequest::validationLogin($dataError, $email, $password);
          $model=Authentication::checkAndInitiateSession($email, $password, $dataError);
          if($model->getError()===false){
              require(Config::getVues()["defaultAdmin"]);
          }else{
              require(Config::getVues()["authentification"]);
          }
            $model=new Model(array());
            require(Config::getVues()["authentification"]);
        }


     }
?>
