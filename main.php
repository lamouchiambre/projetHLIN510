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
  $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
  $event = $bdd->prepare("SELECT ev_id, ev_th_id, ev_name, ev_price, DAY(ev_date_start) as jour, MONTH(ev_date_start) as mois, YEAR(ev_date_start) annee, ev_picture, DATE_FORMAT(ev_date_start, '%w' ) as numJour FROM EVENTS ");
  $event->execute();
?>
<!-- Début de la barre de recherche -->
<div class="bloc" id="bloc-search-bar">
  <div class="wrapper">

    <div class="search-bar-category">
      <select class="form-control search-slt">
        <?php 
        $theme = $bdd->prepare("SELECT * FROM THEME");
        $theme->execute();
        while($resulat = $theme->fetch()){
          echo "<option>".$resulat['th_name']."</option>";
        }
        ?>
      </select>
    </div>

    <div class="search-bar-date">
      <input class="form-control" type="date">
    </div>

    <div class="search-bar-submit">
      <input type="submit" value="Rechercher">
    </div>
  </div>
</div>
<?php 

?>
<!-- Fin de la barre de recherche -->

<!-- Début de la map -->
<div class="bloc" id="bloc-map">
  [Open map]
  <div id="map"></div>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.0.1/build/ol.js" type="text/javascript"></script>

    <script>
      var map = new ol.Map({
        target: 'map',
        layers: [new ol.layer.Tile({source: new ol.source.OSM()})],
        view: new ol.View({center: ol.proj.fromLonLat([2.1833, 41.3833]), zoom: 6})
      });
    </script>
</div>
<!-- Fin de la map -->

<!-- Début de la liste des événements -->
<div class="bloc" id="bloc-list-events">
  [Liste des événements]
      <?php 
        //   while($resulat = $event->fetch()){
        //     echo '<div class="card bg-dark text-white">';
        //     echo '<img class="card-img" src="'.$resulat['ev_picture'].'"width=563px height=270px alt="Card image">';
        //     echo '<div class="card-img-overlay">';
        //     echo '<h5 class="card-title">'.$resulat['ev_name'].'</h5>';
        //     echo '<p class="card-text">'.$resulat['ev_date_start'].'</p>';
        //     echo '</div>';
        //     echo '</div>';
        //     echo '<button type="button" class="btn btn-primary">Voir</button>';
        // }
        echo '<table >';
        while($resulat = $event->fetch()){
          //echo '<table>';
          echo '<tr>';
          echo '<th> <img align="middle" src="'.$resulat['ev_picture'].'" width=100px height=100px></th>';
          echo '<td >'.$resulat['ev_name'].'</td>';
          //echo '</tr> <tr>';
          echo '<td > '.$jour[$resulat['numJour']].' '.$resulat['jour'].' '.$mois[$resulat['mois'] - 1].' '.$resulat['annee'].' </td>';
          //echo '</tr> <tr>';
          if ($resulat['ev_price'] == NULL) {
            echo '<td > GRATUIT </td>';
          }else {
            echo '<td > '.$resulat['ev_price'].'€ </td>';
          }
          //echo '<td >'.$resulat['ev_price'].'</td>';
          //echo '</tr> <tr>';
          //echo '<td> <button type="button" class="btn btn-primary name="'.$resulat['ev_id'].'">Voir</button> </td> ';
          echo "<td>  <form action='evenement.php' method='get'>
            <input type='hidden' name='id' value=". $resulat['ev_id']. ">
            <input type='submit' class='btn btn-primary' name='voir' value='". $resulat['ev_id']. "'> </td>";
          echo '</tr>';
          echo '</thead>';
          //echo '</table>';
        }
        echo '</table>';
      ?>      
</div>
<!-- Fin de la liste des événements -->

<!-- Début du footer -->
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: A. Canton Condes, A. Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>