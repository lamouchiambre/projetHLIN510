<?php 
  session_start();

  // Suppression des variables de session et de la session
  $_SESSION = array();
  // session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Site événementiel d'Alex et Ambre</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="styleC.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <meta name="viewport" content="width=device-width">
  <!-- OpenLayers CSS -->
  <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.0.1/css/ol.css" type="text/css">
</head>

<!-- Début du menu -->
<body>
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
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- Fin du menu -->

<br>
<div class = 'bloc'>
  <h1>Vous êtes déconnecté</h1><br>
</div>

<!-- Début du footer -->
<br>
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: Alexandre Canton Condes, Ambre Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>