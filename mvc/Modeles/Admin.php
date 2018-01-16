<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$variable = $_POST['data'];

$query = $bdd->prepare('SELECT nom FROM users ');
$query->execute();

while ($data = $query->fetch()) {
    echo '<p>' . $data['nom'] . '</p>' . '<br />';
}
$query->closeCursor();
?>