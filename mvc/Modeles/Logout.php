<?php
session_start();
session_destroy();
header("Location:/elliot/mvc/Vue/vueConnexion.php");
exit;
?>
