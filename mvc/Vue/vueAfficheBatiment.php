<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/notification.css">
    <title>Batiments</title>

    <?php include("layouts/header.php"); ?>
</head>
<body>
<div id="main">

    <table>
        <tr>
            <th>ID Batiment</th>
            <th>Nom</th>
        </tr>
        <?php
            for ($i = 0; $i <= count($model->getId()); $i++) {
                 echo "<tr><td>".$model->getId()[$i]["name"]."</td><td>".$model->getName()[$i]["name"]."</td></tr>";
             }
         ?>
    </table>
</div>

<script type="text/javascript" src="../../js/Notif.js"></script>
</body>
</html>
