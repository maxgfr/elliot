<?php

	/** @brief Automatically load a default page when accessing to the
	* Elliot website. */

	class Autoload{

		/** Reference to instance to identify the context when 
		autoload.php functions are called. */
		private static $m_instance;


		/** @brief Check the health state of a loading page by throwing exceptions. */
		public static function load(){
			// The autoload should only be used to create a non-existing instance.
			if(self::$m_instance !== null){
				throw new Exception("L'autoload ne peut etre chargé qu'une fois :".__CLASS__);
			}

			// Reference to ensure a defined instance (Here, the current one).
			self::$m_instance = new self();

			// Check if the autoloadCallback function is registered in the instance "function loading" cache.
			if(!spl_autoload_register(array(self::$m_instance, "autoloadCallback"))){
				throw new Exception("Impossible de lancer l'autoload");
			}
		}


		/** @brief Close manually an instance. */
		public static function shutDown(){
			// Check if an instance has been created to close it.
			if(self::$m_instance !== null){
				// Check if the autoload function is registered in the instance "function loading" cache.
				if(!spl_autoload_unregister(array(self::$m_instance, "autoload"))){
					throw new Exception("Impossible d'arreter l'autoload");
				}

				// Reference to ensure a returned "closed" instance.
				self::$m_instance = null;
			}
		}


		/** @brief Sketch the Elliot website hierarchy to produce paths towards every PHP file.*/
		private static function autoloadCallback($class){
			// Trace down the path to the default loading page.
			global $rootDirectory;
			$sourceFileName = $class.".php";
			$directoryList= array("","Config/", "Modeles/", "Controleur/", "Vue/");
			foreach($directoryList as $subDir){
				$filePath = $rootDirectory.$subDir.$sourceFileName;
				if(file_exists($filePath)){
					include($filePath);
				}
			}
		}

	}

	?>
