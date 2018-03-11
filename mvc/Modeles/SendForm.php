<?php
// Authorize errors to be displayed.
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

// Navigate through MVC root directory
$rootDirectory = dirname(__FILE__)."/../../mvc/";

// Implement the "Autoload" class to load automatically all classes.
require_once($rootDirectory.'Config/Autoload.php');
try {
  Autoload::load();
} catch(Exception $e){
  require (Config::getVues()["default"]) ;
}

$ctrl = new ControleurVisitor('inscription');

?>
