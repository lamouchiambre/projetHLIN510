<!DOCTYPE html>
<html lang="en">
<head>
  <title>Site événementiel d'Alexambre</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>

    body { 
      margin:0;
      padding:0;
      background: url(img/crowd.jpg) no-repeat center fixed; 
      -webkit-background-size: cover; 
      background-size: cover;
    }
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      background-color: rgba(0, 0, 0, 1);  
      font-size: 70;
    }
    .nav {
      margin-bottom: 0;
      border-radius: 0;
      background-color: rgba(150, 0, 75, 0.5);  
      font-size: 70;
    }
    .nav a {
      color: white;
      font-size: 20;
    }
    footer {
      background-color: rgba(0, 0, 0, 0.8);
      padding: 25px;
      color: white;
    }
    .logo {
      width: 60%;
    }
    #footer {
      width-min: 100%;
    }

  </style>
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

<!-- Début de la map -->
<div class="bloc" id="map">
  [Open map]
</div>
<!-- Fin de la map -->

<!-- Début de la liste des événements -->
<div class="bloc" id="listEvents">
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