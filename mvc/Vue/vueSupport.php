<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <title> Support </title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="../../css/Support.css" rel="stylesheet" type="text/css" />
    <script src="../../js/animation.js"></script>

</head>

<?php include ('layouts/header.php'); ?>
<?php include ('layouts/iconBar.php'); ?>

<div id="Support" class="centre">
    <body>
    <?php include ('layouts/sidebar.php'); ?>

    <label>Motif</label> : <input type="Text" name="Motif" id="Motif" placeholder=" Mon capteur ne fonctionne pas" size="30" />
    <br />
    <br />
    <label>Description detaillée de votre problème</label>
    <br />
    <textarea name="Description" id="Description" rows="10" cols="65    " placeholder="Merci de décrire votre problème dans les moindres détails !"></textarea>
    <br />
    <br />
    <button>
        <img src="../../img/Envoyer_Support.png">
        Envoyer
    </button>

    </body>
</html>