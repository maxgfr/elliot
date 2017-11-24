<?php
    /** @brief ControleurVisitor identifie l'action et appelle la méthode pour construire le modèle correspondant à l'action avec le rôle "visitor". Le controleur appelle aussi la Vue correspondante. Il ne gère pas les exceptions, qui remontent au Front Controller. */
    class ControleurVisitor {

        function __construct (){
            //Récupération de l'action
            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
            ///On distingue des cas d’utilisation, suivant l’action
            switch($action) {
                case "auth" :
                    $this->actionAuth();
                    break;
                case "validateAuth" :
                    $this->actionValidateAuth();
                    break;

                default : // L'action indéfinie ( page par défaut , ici accueil )
                    require(Config::getVues()["default"]);
                    break;
            }
        }

        /** @brief Implemente l’action "auth" : saisie du login/password */
        private function actionAuth(){
            $model=new Model(array());
            require(Config::getVues()["authentification"]);
        }

        /** @brief Implemente l’action "validateAuth" : Validation du login/password et création de session. */
        private function actionValidateAuth(){
            ValidationRequest::validationLogin($dataError, $email, $password);
            $model=Authentication::checkAndInitiateSession($email, $password, $dataError);
            if($model->getError()===false){
                require(Config::getVues()["defaultAdmin"]);
            }else{
                require(Config::getVues()["authentification"]);
            }
        }


     }
?>
