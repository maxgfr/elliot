<?php
session_start();
session_destroy();
header("Location:./mvc/Vue/vueConnexion.php");
exit;
?>
