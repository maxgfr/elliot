<?php

/** @brief Classe Modèle pour les données de l'utilisateur
 * Les données peuvent venir d'une session ou d'un accès à la BD. */
class ModelUser extends Model
{
    private $id;
    private $last_name;
    private $first_name;
    private $mail;
    private $password;
    private $birthday;
    private $phone_number;
   
    /** Constructeur par défaut (Init. du tableau d'erreurs à vide) */
    public function __construct ($dataError) {
        parent::__construct ($dataError);
    }

    public function getId() {
        return $this->id;
    }
    public function getLast_name() {
        return $this->last_name;
    }
    public function getFirst_name() {
        return $this->first_name;
    }
    public function getMail() {
        return $this->mail;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getBirthday() {
        return $this->birthday;
    }
    public function getPhone_number() {
        return $this->phone_number;
    }

    /** @brief Retourne un modèle avec une instance de titre par défaut dans une instance de Personne donnée. */
    public static function getModelDefaultUser(){
        $model = new self(array());
        $model->user = User::getDefaultUser();
        $model->last_name = "Saisie d'un nouvel utilisateur";
        return $model;
    }

    /** @brief Insère une titre en créant un nouvel ID dans la BD. */
    public static function getModelUserCreate($inputArray){
        $model = new self(array());
        $model->user = UserGateway::createUser($model->dataError, $inputArray);
        $model->last_name = "L'utilisateur a été ajouté à la BDD !";
        return $model;
    }

    /** @brief Remplie les données de l'utilisateur à partir du email/password par accès à la BD (UserGateway)
     * @param $email email de l'utilisateur servant d'ID unique
     * @param $hashedPassword mot de passe après hashage */
    public static function getModelUser ($email,$hashedPassword) {
        $model = new self(array());
        // Appel de la couche d'accès aux données :
        $model=UserGateway::getRoleByPassword ($model->dataError,$email,$hashedPassword);
        if ( $model!= false ) {
        } else {
            $model=false;
        }
        return $model ;
    }

}
?>