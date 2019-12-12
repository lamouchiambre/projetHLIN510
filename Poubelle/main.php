<!DOCTYPE html>
<html lang="en">
<head>
  <title>Site événementiel d'Alexambre</title>
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
        <li class="active"><a href="#">Acceuil</a></li>
        <li><a href="#">A propos</a></li>
        <li><a href="#">Nous contacter</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- Fin du menu -->
<!-- Script php -->
<?php 
  $mois = ["janvier","février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
  $jour = ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche"];
  $bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
  $event = $bdd->prepare("SELECT ev_id, ev_th_id, ev_name, ev_price, DAY(ev_date_start) as jour, MONTH(ev_date_start) as mois, YEAR(ev_date_start) annee, ev_picture, DATE_FORMAT(ev_date_start, '%w' ) as numJour FROM EVENTS ");
  $event->execute();
?>
<!-- Fin script -->
<!-- Début de la barre de recherche -->
<form  method = "get" action = "">
<div class="bloc" id="bloc-search-bar">
  <div class="wrapper">

    <div class="search-bar-category">
      <select class="form-control search-slt">
        <?php 
        $theme = $bdd->prepare("SELECT * FROM THEME");
        $theme->execute();
        while($resulat = $theme->fetch()){
          echo "<option value='".$resulat['th_id']."'>".$resulat['th_name']."</option>";
        }
        ?>
      </select>
    </div>

    <div class="search-bar-date">
      <input class="form-control" type="date">
    </div>
    <div class= "search-bar-category"> 
      <select class="form-control search-slt">
          <?php 
            $lieu = $bdd->prepare("SELECT * FROM locations");
            $lieu->execute();
            while($resulat = $lieu->fetch()){
              echo "<option value='".$resulat['lo_id']."'>".$resulat['lo_name']."</option>";
            }
          ?>
        </select>
    </div>
    <div class="search-bar-submit">
      <input type="submit" value="Rechercher">
    </div>
  </div>
</div>
</form>
<?php 
  
?>
<!-- Fin de la barre de recherche -->

<!-- Début de la map -->
<div class="bloc" id="bloc-map">
  <div id="mapid"></div>
    <script>
      window.onload = function() {
        var mymap = L.map('mapid').setView([43.6, 3.8833], 13);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);

        var marker = L.marker([43.6, 3.8833]).addTo(mymap);
        L.marker([43.6, 3.7833]).addTo(mymap);
        <?php 
        $lieu = $bdd->prepare("SELECT * FROM locations");
        $lieu->execute();
        while($r = $lieu->fetch()){
          echo "L.marker([".$r['lo_gps_lat'].",".$r['lo_gps_long']."]).addTo(mymap);";
        }
      ?>
      }
    </script>

</div>
<!-- Fin de la map -->

<!-- Début de la liste des événements -->
<div class="bloc" id="bloc-list-events">
  [Liste des événements]
      <?php 
        echo '<table >';
        while($resulat = $event->fetch()){
          echo '<tr>';
          echo '<th> <img align="middle" src="'.$resulat['ev_picture'].'" width=100px height=100px></th>';
          echo '<td >'.$resulat['ev_name'].'</td>';
          echo '<td > '.$jour[$resulat['numJour']].' '.$resulat['jour'].' '.$mois[$resulat['mois'] - 1].' '.$resulat['annee'].' </td>';

          if ($resulat['ev_price'] == NULL) {
            echo '<td > GRATUIT </td>';
          }else {
            echo '<td > '.$resulat['ev_price'].'€ </td>';
          }
          echo "<td>  <form action='evenement.php' method='get'>
            <input type='hidden' name='id' value=".$resulat['ev_id']. ">
            <input type='submit' class='btn btn-primary' name='voir' value='". $resulat['ev_id']. "'> </td>";
          echo '</tr>';
          echo '</thead>';
        }
        echo '</table>';
      ?>      
</div>
<!-- Fin de la liste des événements -->
<script> 

</script>
<!-- Début du footer -->
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: A. Canton Condes, A. Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>