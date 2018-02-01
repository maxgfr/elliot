<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  -->
<!--
  This view retrieve the list of subscribed buildings.
  It does the computing for vueAffBatiment.php, hence not being
  displayed among other views.
-->
<!-- //////////////////////////////////////////////////////////// -->



<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../css/notification.css">
	<title>Batiments</title>
</head>


<?php include("layouts/header.php"); ?>


<body>
	<style>
	#container_building {
		background-image: linear-gradient(rgb(46,50,62), rgb(66,70,82));
		width: 80%;
		height:auto;
		padding: 2%;
		font-family: sans-serif;
		border-radius: 2px;
		margin-left: 5%;
		margin-top: 1%;
		color: white;
		display: flex;
	}
</style>



<div id="main">
	<!-- Set the list template for display. -->
	<div id="container_building">
		<table>
			<tr>
				<th>ID Batiment</th>
				<th>Nom</th>
				<th>Adresse</th>
			</tr>
			<?php
			for ($i = 0; $i < count($model->getAll()); $i++) {
				echo "<tr><td>".$model->getAll()[$i]["id_building"]."</td><td>".$model->getAll()[$i]["name"]."</td><td>".$model->getAll()[$i]["address"]."</td></tr>";
			}
			?>
		</table>
	</div>
</div>



<!-- Plays the notification dynamic. -->
<script type="text/javascript" src="../../js/Notif.js"></script>


</body>
</html>
