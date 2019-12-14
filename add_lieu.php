<?php
session_start();
// echo $_SESSION['us_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Site événementiel d'Alex et Ambre</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
		integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
		crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
		integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
		crossorigin=""></script>

	<meta name="viewport" content="width=device-width">
	<!-- OpenLayers CSS -->
	<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.0.1/css/ol.css" type="text/css">
</head>
<body>

<!-- Début du menu -->
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<img class="logo" src="img/logoMtp.png">
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="active"><a href="main.php">Acceuil</a></li>
				<li><a href="#">A propos</a></li>
				<li><a href="#">Nous contacter</a></li>
				<?php
					// if (!empty($_SESSION['us_id'])) {
					// 	echo '<li><a href="espace_menbre.php">Mon espace</a></li>';
					// }
				?>
			</ul>
			<?php
				// if (empty($_SESSION['us_id'])) {
				// 	echo '<ul class="nav navbar-nav navbar-right"> <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> </ul>';
				// } else {
				// 	echo '<ul class="nav navbar-nav navbar-right"> <li><a href="deconnection.php"><span class="glyphicon glyphicon-log-in"></span> Deconnection</a></li> </ul>';
				// }
			?>
		</div>
	</div>
</nav>
<!-- Fin du menu -->

<!-- Début de la map -->
<div class="bloc" id="lieu_bloc-map">
	<div id="lieu_mapid"></div>
		<script>
			window.onload = function() {
				var lieu_map = L.map('lieu_mapid').setView([43.6, 3.8833], 13);

				L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
				}).addTo(lieu_map);

				var lieu_marker = L.marker([43.6, 3.8833], {
    			draggable: true
					, autoPan: true
					, autoPanSpeed: 2
					}).addTo(lieu_map);
					
				lieu_marker.on("mouseover", function(e) {
					var gps = lieu_marker.getLatLng();
					lieu_marker.bindPopup("<b>"+gps+"</b>");
				});
			}
		</script>
	</div>
</div>
<!-- Fin de la map -->

<!-- Début du footer -->
<footer class="container-fluid text-center" id="footer">
	<p>&copy; 2019 Copyright: A. Canton Condes, A. Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>