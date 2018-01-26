<?php

/** @brief ControleurVisitor identify the action and call a method to build the model suited for the action with the "visitor" role. The controller also calls the suited view. */

class ControleurVisitor
{
    /** @brief Selection of the appropriate use case. */
    function __construct($action)
    {
        /// Several use cases are distinguished according to the action.
        switch ($action) {
            case "index" :
            require(Config::getVues()["index"]);
            break;
            case "inscription" :
            $this->actionInscription();
            break;
            case "connexion" :
            $this->actionConnexion();
            break;

            // The undefined action (here, vueAccueil.php or vueAdmin.php).
            default :
            require(Config::getVues()["connexion"]);
            break;
        }
    }


    /** @brief Resgister of a user. */
    private function actionInscription()
    {
        $model = ModelUser::getModelUserCreate($_POST);
        if ($model->getError() === false) {
            Config::movePage('vueConnexion.php');
            SessionUtils::createSession($model->email);
        } else {
            if (!empty($model->getError()['persistance'])) {
                // Error when accessing to the database.
                require(Config::getVuesErreur()["default"]);
            } else {
                // Typing error.
                require(Config::getVuesErreur()["default"]);
            }
        }
    }


    /** @brief Login of a user. */
    private function actionConnexion()
    {
        $model = ModelUser::getModelUserConnexion($_POST);
        if ($model->getError() === false) {
            if ($_SESSION['role'] == 0)
                Config::movePage('/elliot/mvc/Vue/vueAccueil.php');
            else
                Config::movePage('/elliot/mvc/Vue/vueAdmin.php');
        } else {
            if (!empty($model->getError()['persistance'])) {
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
