<?php
// Ensure the well-being of a login session.
session_start();
session_destroy();
header("Location:/elliot/mvc/Vue/vueConnexion.php");
exit;

?>
