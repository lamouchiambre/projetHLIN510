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
        <li class="active"><a href="main.php">Acceuil</a></li>
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
<div class = 'bloc'>
<?php 
if($_GET['voir']){
  $name = $_GET['voir'];
  //echo $name;
}
    $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
    $event = $bdd->prepare("SELECT * FROM EVENTS WHERE ev_id = ?");
    $event->execute(array($name));
    
    
    while($resulat = $event->fetch()){
        echo  "<h1>".$resulat['ev_name']."</h1>";
        echo "<img src=".$resulat['ev_picture']." class='img-fluid' width = 790px>";
        echo $resulat['ev_descriptive'];
    }



?>
</div>
<!-- Début de la barre de recherche -->
<!-- <div class="bloc" id="bloc-search-bar">
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

</div> -->
<!-- Fin de la barre de recherche -->

<!-- Début du footer -->
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: A. Canton Condes, A. Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>