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

<?php
	// $bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
	$bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
?>

<!-- Début de la map -->
<div class='bloc' id='lieu_bloc-map'>
	<h2>Lieux enregistrés</h2>
	<div id="lieu_mapid"></div>
		<script>

			window.onload = function() {
				var lieu_map = L.map('lieu_mapid').setView([43.6, 3.8833], 13);

				L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
				}).addTo(lieu_map);

				var lieu_marker = L.marker([43.6, 3.8833], {
					draggable: true
					, opacity: 0.75
				}).addTo(lieu_map);
				// lieu_marker.valueOf()._icon.style.backgroundColor = 'purple';
					
				lieu_marker.on("mouseover", function(e) {
					var gps = lieu_marker.getLatLng();
					lieu_marker.bindPopup("<b>"+gps+"</b>").openPopup();
				});

				<?php
					$lieu = $bdd->prepare("SELECT * FROM locations");
					$lieu->execute();
					while ($r = $lieu->fetch()) {
						echo "var m = L.marker([".$r['lo_gps_lat'].",".$r['lo_gps_long']."],{opacity:1}).addTo(lieu_map);";
						echo "m.bindPopup('<b>".$r['lo_name']."</b><br>".$r['lo_address']."');";
					}
				?>
			}
		</script>
	</div>
</div>
<!-- Fin de la map -->

<!-- Début formulaire -->
<div class='bloc'>
	<h2>Ajouter un lieu</h2>
	<form action='' method='post' enctype='multipart/form-data'> 
		<div class='form'>
			<input type='textbox' name='name' id='name' placeholder='Nom'><br>
			<input type='textbox' name='address' id='address' placeholder='Adresse'><br>
			<input type='textbox' name='city' id='city' placeholder='Ville'><br><br>
			<input type='number' step='any' name='lat' id='lat' placeholder='Latitude'><br>
			<input type='number' step='any' name='long' id='long' placeholder='Longitude'>
			<p>(Aidez-vous du marqueur déplaçable)</p>
		</div>
		<input type='submit' class='btn btn-primary' name='ajouter' value='Ajouter'>
	</form>
</div>
<!-- Fin formulaire -->

<!-- Début du submit -->
<?php 
  try {
		// $bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
    $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
  } catch(Exception $e) {
  	die("Impossible de se connectée".$e->getMessage());
	}
	
  if (!empty($_POST)) {
		try {
			$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$bdd->beginTransaction();
			$p = $bdd->prepare("INSERT INTO `Locations` (`lo_id`, `lo_name`, `lo_address`, `lo_city`, `lo_gps_lat`, `lo_gps_long`) VALUES (NULL, :lo_name, :lo_address, :lo_city, :lo_gps_lat, :lo_gps_long)");
			$p->bindParam(':lo_name', $_POST['name']);
			$p->bindParam(':lo_address', $_POST['address']);
			$p->bindParam(':lo_city', $_POST['city']);
			$p->bindParam(':lo_gps_lat', $_POST['lat']);
			$p->bindParam(':lo_gps_long', $_POST['long']);
			$p->execute();
			$bdd->commit();
  	} catch(Exception $e) {
    	$bdd->rollBack();
			echo "impossible ajouter".$e->getMessage();    
		}
	}
?>
<!-- Fin du submit -->

<!-- Début du footer -->
<br>
<footer class="container-fluid text-center" id="footer">
	<p>&copy; 2019 Copyright: A. Canton Condes, A. Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>