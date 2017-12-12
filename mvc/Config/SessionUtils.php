<?php
	/** @brief Gère le cycle de vie de la session (Identification utilisateur)
	 * génère des SID aléatoires, crée et met à jour le cookie pour le SID */
	class SessionUtils {

		/** Durée du cookie en secondes */
		const DUREE_COOKIE = 120;

		/** @brief fonction de génération de l'ID de session aléatoire */
		public static function generateSessionId(){
			// Génération de 10 octets (pseudo-)aléatoires codés en hexa
			$cryptoStrong = false; // Variable pour passage par référence
			$octets = openssl_random_pseudo_bytes(10, $cryptoStrong);
			$mySid = bin2hex($octets);
			return $mySid;
		}

		/** Création d'une session de SID aléatoire avec l'e-mail (login unique)
		 *	@param $email e-mail servant de login (identifiant unique de l'utilisateur) **/
		public static function createSession($email){
			// Dans le cas improbable d'une collision sur le SID,
			// Mais surtout d'une usurpation d'identité, on détruit la session
			// avant de redémarer une session vide
			session_start();
			session_destroy();
			// Le numéro de session aléatoire
			$mySid =  self::generateSessionId();
			session_id($mySid);
			// Destruction du coockie avant de le recréer
			setcookie("session-id", "", time()-60, '/');
			// Création du cookie avec SID aléatoire. Validité du cookie : 2mn
			// Un pirate aura besoin de temps pour voler le cookie...
			setcookie("session-id", $mySid, time()+self::DUREE_COOKIE, '/');
			// Démarrage de la session
			session_start();
			// On échappe, même si on sait qu'on a validé le username....
			$_SESSION['mail'] = htmlentities($email, ENT_QUOTES, "UTF-8");
			$_SESSION['ipAddress'] = $_SERVER['REMOTE_ADDR'];
			session_write_close();
		}

		/** @brief Restore la session si l'identificateur a déjà été identifié*/
		/** @return Le modèle contient un tableau d'erreur si la restauration de session échoue */
		public static function restoreSession() {
			$dataError = array();
			// Test pourvoir si l'identifiant de session existe et à la bonne forme (10 chiffres hexa entre 0 et f)
			if(!isset($_COOKIE['session-id']) || !preg_match( "/^[0-9a-fA-F]{20} $/" , $_COOKIE['session-id'])){
				$dataError['no-cookie'] = " Votre cookie a expirée , Merci de vous connecter à nouveau ...";
				$userModel = new Model($dataError);
			}
			else
			{
				// On a bien vérifié la forme par expression régulière
				$mySid = $_COOKIE['session-id'];
				// On récupère les données de session :
				session_id($mySid);
				// Le démarage de session
				session_start();
				// Test sur les données de session et contrôle par IP
				if ( !isset ($_SESSION['mail']) || !isset ($_SESSION['ipAddress']) || ($_SESSION ['ipAddress'] != $_SERVER['REMOTE_ADDR'])) {
					$dataError ['session'] = "Impossible de retrouver la session.";
					$userModel = new Model($dataError);
				} else {
					$userModel =new self(array());
					$userModel->mail = $_SESSION['mail'];
				}
				// Raffinement : on change leS ID aléatoires, en copiant la session dans une nouvelle. On regénère ensuite le cookie. Comme ça, le cookie n'est valable qu'unefois, et l’ID de session aussi ce qui limite beaucoup la possibilité d'un éventuel hacker
				$backupSessionEmail = $_SESSION ['mail'];
				//On recrée une session :
				SessionUtils::createSession($backupSessionEmail);
				//Flush des Données de Session, (sauvegardes immédiateur le disque)
				session_write_close();
			}
			return $userModel ;
		}
	}
?>
