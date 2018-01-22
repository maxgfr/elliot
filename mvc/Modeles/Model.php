<?php

	/** @ brief Basic class for all the classes involving models. This class' goal is solely to display neatly the code about error data (associative array in which values are error messages). */
	class Model{

		/** Ensure the existence of the error. */
		protected $dataError;


		/** @brief Return false if lack of errors. Otherwise, the collect of errors @return an associative table in which values are error messages. */
		public function getError(){
			if(empty($this->dataError)){
				return false;
			}
			return $this->dataError;
		}


		/* @brief Constructor
		@return an associative table in which values are error messages (E.g. an empty table at the beginning of a proccess). */
		public function __construct($dataError){
			$this->dataError = $dataError;
		}

	}

?>
