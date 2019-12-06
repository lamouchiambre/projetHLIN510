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

<!-- Début de la barre de recherche -->
<div class="bloc" id="bloc-search-bar">
  <div class="wrapper">

    <div class="search-bar-category">
      <select class="form-control search-slt">
        <option>(Sélectionne une catégorie)</option>
        <option>Spectacle</option>
        <option>Concert</option>
        <option>Exposition</option>
        <option>Festival</option>
        <option>Evènement sportif</option>
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
</div>
<!-- Fin de la liste des événements -->

<!-- Début du footer -->
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: A. Canton Condes, A. Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>