<?php

class ControleurUser
{
    function __construct ( $action ) {
        // On distingue des cas d'utilisation suivant l'action
        switch ( $action ) {
            case "ajoutUser":
                $this->actionCreate();
                break ;
            case "modifierUser":
                $this->actionModifier();
                break;
            case "supprimerUser":
                $this->actionDelete();
                break;
            default : // L'action indéfinie (page par défaut, ici accueil)
                require ();
                break ;
        }
    }

    private function actionCreate () {
        
    }

    private function actionModifier(){
       
    }

    
    private function actionDelete () {

    }
    
}