<?php

    /** @brief Identifie l'action et le rôle de l'utilisateur. Dans le cas où l'utilisateur a des droits insuffisants pour l'action, le ControleurFront affiche une Vue d'autentification ou un Vue d'erreur. Sinon, ControleurFront instancie le contrôleur adapté pour les rôle et action Il gère aussi les exceptions et appelle le cas échéant une Vue d'erreur.*/
    class ControleurFront {

        /** @brief  C'est dans le contructeur que le contrôleur fait son travail. */
        public function __construct()
        {
            try {
                //Récupération de l'action
                $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
                //L’utilisateur est-il identifié ? Si oui, quel est son rôle?
                $dataError = array();
                switch ($action) {

                    // Actions accessibles uniquement aux visiteurs:
                    case "auth" : //vue saisie authentification
                    case "validateAuth" : // Validation du login / password
                        $authCtrl = new ControleurAuth($action);
                        break;

                    // L'action par défaut
                    default :
                        //L'implémentation ( donc le contrôleur ) dépend du rôle
                        if ($role == "admin") {
                            $adminCtrl = new ControleurAdmin ($action);
                        } else {
                            $publicCtrl = new ControleurVisitor ($action);
                        }
                }
            } catch (Exception $e) { // Page d'erreur par défaut
                $model = new Model(array('exception' => $e->getMessage()));
                require(Config::getVuesErreur()["default"]);
            }
        }
     }
?>
