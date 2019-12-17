<?php 
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo "<head> <title>Site événementiel d'Alexambre</title>";
echo '<meta charset="utf-8">  <meta name="viewport" content="width=device-width, initial-scale=1">  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">  <link rel="stylesheet" href="style.css">  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"><link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="crossorigin=""/></script><script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="crossorigin=""></script><meta name="viewport" content="width=device-width"><!-- OpenLayers CSS --><link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.0.1/css/ol.css" type="text/css"></head><body>';

echo '<nav class="navbar navbar-inverse"><div class="container-fluid">    <div class="navbar-header"> <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <img class="logo" src="img/logoMtp.png"> </div><div class="collapse navbar-collapse" id="myNavbar">      <ul class="nav navbar-nav"> <li class="active"><a href="main.php">Acceuil</a></li>';
        
          if(!empty($_SESSION['us_id'])){
            echo '<li><a href="espace_menbre.php">Mon espace</a></li>';
          }
      echo '</ul>';

        if(empty($_SESSION['us_id'])){
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> </ul>';
        }else{
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="deconnection.php"><span class="glyphicon glyphicon-log-in"></span> Deconnection</a></li> </ul>';
        }
        
      

    echo '</div></div></nav>';
?>