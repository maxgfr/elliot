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
            <th>Action</th>
        </tr>
        <?php
            for ($i = 0; $i < count($model->getAll()); $i++) {
                 echo "<tr><td>".$model->getAll()[$i]["id_building"]."</td><td>".$model->getAll()[$i]["name"]."</td><td>".$model->getAll()[$i]["address"]."</td></tr>";
             }
         ?>
    </table>
</div>

<script type="text/javascript" src="../../js/Notif.js"></script>
</body>
</html>
