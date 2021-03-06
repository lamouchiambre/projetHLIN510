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
        <?php 
          if ($connecter) {
            echo '<li><a href="espace_menbre.php">Mon espace</a></li>';
          }
        ?>
      </ul>
      <?php 
        if (!$connecter) {
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li> </ul>';
        } else {
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="deconnection.php"><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li> </ul>';
        }
      ?>
    </div>
  </div>
</nav>
<!-- Fin du menu -->

<!-- Début définition de la requête -->
<?php 
	$mois = ["janvier","février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
	$jour = ["dimanche","lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
	$bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
	// $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
	$req = "SELECT ev_id, ev_lo_id, ev_th_id, ev_name, ev_price, 
		lo_id, lo_name, lo_address, lo_city, lo_gps_lat, lo_gps_long,
		th_id, th_name,
		DATE_FORMAT(ev_date_start, '%Y-%m-%d') AS date_debut, 
		DATE_FORMAT(ev_date_end, '%Y-%m-%d') AS date_fin, 
		DAY(ev_date_start) as jour_debut, MONTH(ev_date_start) as mois_debut, YEAR(ev_date_start) annee_debut, 
		DAY(ev_date_end) as jour_fin, MONTH(ev_date_end) as mois_fin, YEAR(ev_date_end) annee_fin, 
		ev_picture, DATE_FORMAT(ev_date_start, '%w' ) as numJourDebut, 
		DATE_FORMAT(ev_date_end, '%w' ) as numJourFin 
		FROM Events, Locations, Theme WHERE ev_lo_id = lo_id AND ev_th_id = th_id" ;

	$event = $bdd->prepare($req);
	$event->execute();
?>
<!-- Fin définition de la requête -->

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
					while ($res = $lieu->fetch()) {
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

<!-- Début prise en compte de la recherche -->
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
<!-- Fin prise en compte de la recherche -->

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
					$var_lo_id = $var_lo_id + 1;
					$map_req = "SELECT *
					, DATE_FORMAT(ev_date_end, '%d-%m-%Y') AS date_fin 
					, DATE_FORMAT(ev_date_start, '%d-%m-%Y') AS date_debut 
					FROM Events, Locations, Theme WHERE ev_lo_id = lo_id AND ev_th_id = th_id AND lo_id = :var_lo_id";
					echo "L.marker([".$r['lo_gps_lat'].",".$r['lo_gps_long']."]";

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
						$map_event_vide = $bdd->prepare($map_req);

						// Remplacement des paramètres
						if ($th_id != 0) {
							$map_event->bindParam(':th_id', $th_id);
							$map_event_vide->bindParam(':th_id', $th_id);
						}
						if ($lo_id != 0) {
							$map_event->bindParam(':lo_id', $lo_id);
							$map_event_vide->bindParam(':th_id', $th_id);
						}
						if ($date) {
							$map_event->bindParam(':date', $date);
							$map_event_vide->bindParam(':th_id', $th_id);
						}
						$map_event->bindParam(':var_lo_id', $var_lo_id);
						$map_event_vide->bindParam(':var_lo_id', $var_lo_id);

						$map_event->execute();
						$map_event_vide->execute();
					}

					if (($vide = $map_event_vide->fetch()) == NULL) {
						echo ", {opacity: 0.5}";
						echo ").addTo(mymap).bindPopup('<b>".$r['lo_name']."</b><br>".$r['lo_address'];
					} else {
						echo ").addTo(mymap).bindPopup('<b>".$r['lo_name']."</b><br>".$r['lo_address']."<p>";
					}

					while ($e = $map_event->fetch()) {
						echo "<br><b>".$e['ev_name'].'</b>  '.'  de '.$e['date_fin'].' à '.$e['date_debut'].'  <b>'.$e['ev_price'].'€</b>';
					}
					echo "</p>');";
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
		echo '<tr> <th>Affiche</th> <th>Thème</th> <th>Lieu</th> <th>Titre</th> <th>Début</th> <th>Fin</th> <th>Prix</th> <th>Voir</th> </tr>';
		while($res = $event->fetch()) {
			echo '<tr>';
			echo '<th> <img align="middle" src="'.$res['ev_picture'].'" width=200px height=100px></th>';
			echo '<td>'.$res['th_name'].'</td>';
			echo '<td>'.$res['lo_name'].'</td>';
			echo '<td>'.$res['ev_name'].'</td>';
			echo '<td>'.$jour[$res['numJourDebut']].' '.$res['jour_debut'].' '.$mois[$res['mois_debut'] - 1].' '.$res['annee_debut'].' </td>';
			echo '<td>'.$jour[$res['numJourFin']].' '.$res['jour_fin'].' '.$mois[$res['mois_fin'] - 1].' '.$res['annee_fin'].' </td>';

			if ($res['ev_price'] == 0) {
				echo '<td > GRATUIT </td>';
			} else {
				echo '<td > '.$res['ev_price'].'€ </td>';
			}
			echo "<td>  <form action='evenement.php' method='get'>
				<input type='hidden' name='id' value=".$res['ev_id']. ">
				<input type='submit' class='btn btn-primary' name='voir' value='".$res['ev_id']."'> </td>";
			echo '</tr>';
			echo '</thead>';
		}
		echo '</table>';
	?>      
</div>
<!-- Fin de la liste des événements -->

<!-- Début du footer -->
<br>
<footer class="container-fluid text-center" id="footer">
	<p>&copy; 2019 Copyright: Alexandre Canton Condes, Ambre Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>