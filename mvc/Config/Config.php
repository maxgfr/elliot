<?php
	/** @brief Classe de configuration : Elle donne accès aux paramères spécifiques contenat l'application tellles que les chemins vers les vues, les vues d'erreur, les hash pour les ID de sessions, etc... */
	class Config {


		/** @brief Données nécessaires à la connexion à la base de données. Les valeurs pourraient être initialisées à partir d'un fichier de configuration  séparé (require('configuration.php')) pour faciliter la maintenance */
		public static function getAuthData(&$db_host , &$db_name , &$db_user , &$db_password )
		{
			/* CONFIG 1 */
			$db_host="mysql:host=localhost;port=8889;";
			$db_name="dbname=elliot_db";
			$db_user ="root";
			$db_password="root";

			/*CONFIG 2	*/
			/*$db_host="mysql:host=localhost;port=3306;";
			$db_name="dbname=elliot_db";
			$db_user ="root";
			$db_password="";*/

			/* CONFIG MARIN */
			/*$db_host="mysql:host=localhost;port=;";
			$db_name="dbname=elliot_db";
			$db_user ="root";
			$db_password="";*/

			/* CONFIG 3 */
			/*$db_host="mysql:host=localhost;port=;";
			$db_name="dbname=elliot_db";
			$db_user ="root";
			$db_password="GDBx:P3k"; */

			/* CONFIG SERVEUR*/
			/*$db_host="mysql:host=localhost;port=3306;";
			$db_name="dbname=elliot_db";
			$db_user ="root";
			$db_password="M7<dk8A,~zdD92%C";*/

		}

		/** @brief retourne le tableau des chemins vers les vues */
		public static function getVues()
		{
			global $rootDirectory; //racine du site
			$vueDirectory = $rootDirectory."Vue/"; //répertoire contenant les vues
			return array("default" => $vueDirectory."vueAccueil.php",
						 "connexion" => $vueDirectory."vueConnexion.php",
					 	"inscription" => $vueDirectory."vueInscription.php",
						"index" => $vueDirectory."vueIndex.php",
						"ajoutCapteur" => $vueDirectory."vueAjoutCapteur.php",
					   	"afficheCapteur" => $vueDirectory."vueAfficheCapteur.php",
					   	"deleteCapteur" => $vueDirectory."vueDeleteCapteur.php");
		}


		/** @brief retourne le tableau des chemins vers les vues d'erreur */
		public static function getVuesErreur()
		{
			global $rootDirectory;  //racine du site
			$vueDirectory = $rootDirectory."Vue/"; //répertoire contenant les vues d'erreur
 			return array("default" => $vueDirectory."vueError.php");
		}


		/** @brief retourne l'URI sans le nom d'hôte du site et sans la query string du répertoire racine de notre architecture MVC */
		public static function getRootURI()
		{
			global $rootURI ;
			return $rootURI ;
		}

 		/** @brief Génère 10 chiffres hexa aléatoires (soit 5 octets) : */
 		public static function generateRandomId ()
		{
			// Génération de 5 octets (pseudo) aléatoires codés en hexa
			$cryptoStrong = false ; // Variable pour passage par référence
			$octets= openssl_random_pseudo_bytes (5,$cryptoStrong);
			return bin2hex ($octets);
		}

		public static function movePage ($url) {
			echo '<script language="Javascript">document.location.replace("'.$url.'");</script>';
			/*    static $http = array (
			       100 => "HTTP/1.1 100 Continue",
			       101 => "HTTP/1.1 101 Switching Protocols",
			       200 => "HTTP/1.1 200 OK",
			       201 => "HTTP/1.1 201 Created",
			       202 => "HTTP/1.1 202 Accepted",
			       203 => "HTTP/1.1 203 Non-Authoritative Information",
			       204 => "HTTP/1.1 204 No Content",
			       205 => "HTTP/1.1 205 Reset Content",
			       206 => "HTTP/1.1 206 Partial Content",
			       300 => "HTTP/1.1 300 Multiple Choices",
			       301 => "HTTP/1.1 301 Moved Permanently",
			       302 => "HTTP/1.1 302 Found",
			       303 => "HTTP/1.1 303 See Other",
			       304 => "HTTP/1.1 304 Not Modified",
			       305 => "HTTP/1.1 305 Use Proxy",
			       307 => "HTTP/1.1 307 Temporary Redirect",
			       400 => "HTTP/1.1 400 Bad Request",
			       401 => "HTTP/1.1 401 Unauthorized",
			       402 => "HTTP/1.1 402 Payment Required",
			       403 => "HTTP/1.1 403 Forbidden",
			       404 => "HTTP/1.1 404 Not Found",
			       405 => "HTTP/1.1 405 Method Not Allowed",
			       406 => "HTTP/1.1 406 Not Acceptable",
			       407 => "HTTP/1.1 407 Proxy Authentication Required",
			       408 => "HTTP/1.1 408 Request Time-out",
			       409 => "HTTP/1.1 409 Conflict",
			       410 => "HTTP/1.1 410 Gone",
			       411 => "HTTP/1.1 411 Length Required",
			       412 => "HTTP/1.1 412 Precondition Failed",
			       413 => "HTTP/1.1 413 Request Entity Too Large",
			       414 => "HTTP/1.1 414 Request-URI Too Large",
			       415 => "HTTP/1.1 415 Unsupported Media Type",
			       416 => "HTTP/1.1 416 Requested range not satisfiable",
			       417 => "HTTP/1.1 417 Expectation Failed",
			       500 => "HTTP/1.1 500 Internal Server Error",
			       501 => "HTTP/1.1 501 Not Implemented",
			       502 => "HTTP/1.1 502 Bad Gateway",
			       503 => "HTTP/1.1 503 Service Unavailable",
			       504 => "HTTP/1.1 504 Gateway Time-out"
				   );
				   header($http[$num]);
				   header ("Location: $url");*/
		}

	}


?>
