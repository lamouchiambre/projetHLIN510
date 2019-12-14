<?php 
session_start();
$connecter = isset($_SESSION['us_id']);
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
          if($connecter){
            echo '<li><a href="espace_menbre.php">Mon espace</a></li>';
          }
        ?>
      </ul>
      <?php 

        if(!$connecter){
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> </ul>';
        }else{
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="deconnection.php"><span class="glyphicon glyphicon-log-in"></span> Deconnection</a></li> </ul>';
        }
        
      ?>

    </div>
  </div>
</nav>
<!-- Fin du menu -->
<!-- Script php pour la requête -->
<?php 
	$mois = ["janvier","février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
	$jour = ["dimanche","lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
	// $bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
	$bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
	$req = "SELECT ev_id, ev_lo_id, ev_th_id, ev_name, ev_price, 
		lo_id, lo_name, lo_address, lo_city, lo_gps_lat, lo_gps_long,
		DATE_FORMAT(ev_date_start, '%Y-%m-%d') AS date_debut, 
		DATE_FORMAT(ev_date_end, '%Y-%m-%d') AS date_fin, 
		DAY(ev_date_start) as jour_debut, MONTH(ev_date_start) as mois_debut, YEAR(ev_date_start) annee_debut, 
		DAY(ev_date_end) as jour_fin, MONTH(ev_date_end) as mois_fin, YEAR(ev_date_end) annee_fin, 
		ev_picture, DATE_FORMAT(ev_date_start, '%w' ) as numJourDebut, 
		DATE_FORMAT(ev_date_end, '%w' ) as numJourFin 
		FROM Events, Locations WHERE ev_lo_id = lo_id";

	$event = $bdd->prepare($req);
	$event->execute();
?>
<!-- Fin script pour la requête -->
<!-- Début de la barre de recherche -->
<form  method = "post">
<div class="bloc" id="bloc-search-bar">
	<div class="wrapper">

		<div class="search-bar-category">
			<select class="form-control search-slt" name="theme">
				<option value="0">Tous Thèmes</option>";
				<?php 
					$theme = $bdd->prepare("SELECT * FROM Theme");
					$theme->execute();
					while($res = $theme->fetch()){
						echo "<option value='".$res['th_id']."'>".$res['th_name']."</option>";
					}
				?>
			</select>
		</div>

		<div class="search-bar-date">
			<input class="form-control" type="date" name="date">
		</div>
		<div class= "search-bar-locations"> 
			<select class="form-control search-slt" name="localisation">
				<option value="0">Toutes Localisations</option>";
				<?php 
					$lieu = $bdd->prepare("SELECT * FROM Locations");
					$lieu->execute();
					while($res = $lieu->fetch()){
						echo "<option value='".$res['lo_id']."'>".$res['lo_name']."</option>";
					}
				?>
			</select>
		</div>
		<div class="search-bar-submit">
			<input type="submit" name ="Rechercher" value="Rechercher">
		</div>
	</div>
</div>
</form>
<!-- Fin de la barre de recherche -->

<?php
	// Redéfinition de la liste des événements selon ce qu'on a recherché
	if (isset($_POST['Rechercher'])) {
		$th_id = $_POST['theme'];
		$lo_id = $_POST['localisation'];
		$date = $_POST['date']; 

		// Modification de la requête
		if ($th_id != 0 or $lo_id != 0 or $date) {
			$req = $req." AND ";
		} 
		if ($th_id != 0) {
			$req = $req."ev_th_id = :th_id";
		}
		if ($th_id != 0 and $lo_id != 0) {
			$req = $req." AND ";
		} 
		if ($lo_id != 0) {
			$req = $req."ev_lo_id = :lo_id";
		}
		if (($th_id != 0 or $lo_id != 0) and $date) {
			$req = $req." AND ";
		}
		if ($date) {
			$req = $req.":date BETWEEN ev_date_start AND ev_date_end";
		}

		$event = $bdd->prepare($req);

		// Remplacement des paramètres
		if ($th_id != 0) {
			$event->bindParam(':th_id', $th_id);
		}
		if ($lo_id != 0) {
			$event->bindParam(':lo_id', $lo_id);
		}
		if ($date) {
			$event->bindParam(':date', $date);
		}

		$event->execute();
	}
?>

<!-- Début de la map -->
<div class="bloc" id="bloc-map">
	<div id="mapid"></div>
	<script>
		window.onload = function() {
			var mymap = L.map('mapid').setView([43.6, 3.8833], 13);

			L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(mymap);

			<?php      
				$lieu = $bdd->prepare("SELECT * FROM locations");
				$lieu->execute();
				$var_lo_id = 0;
				while ($r = $lieu->fetch()) {
					echo "L.marker([".$r['lo_gps_lat'].",".$r['lo_gps_long']."]).addTo(mymap).
						bindPopup('<b>".$r['lo_name']."</b><br>".$r['lo_address']."<br>---";
					$var_lo_id = $var_lo_id + 1;
					$map_req = "SELECT * FROM Events, Locations WHERE ev_lo_id = lo_id AND lo_id = :var_lo_id";

					// Redéfinition de la liste des événements selon ce qu'on a recherché
					if (isset($_POST['Rechercher'])) {

						// Modification de la requête
						if ($th_id != 0 or $lo_id != 0 or $date) {
							$map_req = $map_req." AND ";
						} 
						if ($th_id != 0) {
							$map_req = $map_req."ev_th_id = :th_id";
						}
						if ($th_id != 0 and $lo_id != 0) {
							$map_req = $map_req." AND ";
						} 
						if ($lo_id != 0) {
							$map_req = $map_req."ev_lo_id = :lo_id";
						}
						if (($th_id != 0 or $lo_id != 0) and $date) {
							$map_req = $map_req." AND ";
						}
						if ($date) {
							$map_req = $map_req.":date BETWEEN ev_date_start AND ev_date_end";
						}

						$map_event = $bdd->prepare($map_req);

						// Remplacement des paramètres
						if ($th_id != 0) {
							$map_event->bindParam(':th_id', $th_id);
						}
						if ($lo_id != 0) {
							$map_event->bindParam(':lo_id', $lo_id);
						}
						if ($date) {
							$map_event->bindParam(':date', $date);
						}
						$map_event->bindParam(':var_lo_id', $var_lo_id);

						$map_event->execute();
					}
					while ($e = $map_event->fetch()) {
						echo "<br>".$e['ev_id'].' '.$e['ev_th_id'].' '.$e['ev_lo_id'].' '.$e['ev_name'].' '.$e['ev_price'].'€';
					}
					echo "');";
				}
			?>
		}
	</script>

</div>
<!-- Fin de la map -->

<!-- Début de la liste des événements -->
<div class="bloc" id="bloc-list-events">
	<?php 
		echo '<table>';
		echo '<tr> <th>Affiche</th> <td>ev_th_id</td> <td>ev_lo_id</td> <td>Titre</td> <td>Début</td> <td>Fin</td> <td>Prix</td> </tr>';
		while($res = $event->fetch()) {
			echo '<tr>';
			echo '<th> <img align="middle" src="'.$res['ev_picture'].'" width=200px height=100px></th>';
			echo '<td>'.$res['ev_th_id'].'</td>';
			echo '<td>'.$res['ev_lo_id'].'</td>';
			echo '<td>'.$res['ev_name'].'</td>';
			echo '<td>'.$res['date_debut']."<br>".$jour[$res['numJourDebut']].' '.$res['jour_debut'].' '.$mois[$res['mois_debut'] - 1].' '.$res['annee_debut'].' </td>';
			echo '<td>'.$res['date_fin']."<br>".$jour[$res['numJourFin']].' '.$res['jour_fin'].' '.$mois[$res['mois_fin'] - 1].' '.$res['annee_fin'].' </td>';

			if ($res['ev_price'] == 0) {
				echo '<td > GRATUIT </td>';
			} else {
				echo '<td > '.$res['ev_price'].'€ </td>';
			}
			echo "<td>  <form action='evenement.php' method='get'>
				<input type='hidden' name='id' value=".$res['ev_id']. ">
				<input type='submit' class='btn btn-primary' name='voir' value='". $res['ev_id']. "'> </td>";
			echo '</tr>';
			echo '</thead>';
		}
		echo '</table>';
	?>      
</div>
<!-- Fin de la liste des événements -->
<br>
<!-- Début du footer -->
<footer class="container-fluid text-center" id="footer">
	<p>&copy; 2019 Copyright: A. Canton Condes, A. Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>
