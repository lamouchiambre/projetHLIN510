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
    html, body {
	    height: 100%;
	    margin: 0; padding: 0;
    }
    body { 
      background: url(img/crowd.jpg) no-repeat center fixed; 
      -webkit-background-size: cover; 
      background-size: cover;
	    display : table;
	    width: 100%;

      /* background: #ffd89b;
      background: -webkit-linear-gradient(to right, #ffd89b, #19547b);
      background: linear-gradient(to right, #ffd89b, #19547b); */
    }
    .navbar {
      margin-bottom: 0;
      background-color: rgba(0, 0, 0, 1); 
    }
    .nav {
      background-color: rgba(150, 0, 75, 0.5);  
    }
    .nav a {
      color: white;
    }
    ul.nav a:hover {
      /* background-color: rgba(150, 0, 75, 1);   */
      background-color: DimGrey !important;  
      /* color: Plum !important; */
      color: Gold !important;
    }
    .logo {
      width: 60%;
    }
    .bloc {
      background-color: rgba(0, 0, 0, 0.5);
      color: rgb(255, 255, 255);
      text-align: center;
      width: 800px;
      margin: 0 auto;
      border-radius: 5px;
      margin-top: 5px;
    }
    .box {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    footer {
      background-color: rgba(0, 0, 0, 0.8);
      padding: 25px;
      color: white;
	    display : table-row;
	    height: 1px;
    }

    @import "compass/css3";

    .flex-container {
      padding: 0;
      margin: 0;
      list-style: none;
  
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
  
      -webkit-flex-flow: row wrap;
      justify-content: space-around;
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

<!-- Début de la barre de recherche -->
<div class="bloc" id="search-bar">
  [Barre de recherche]
  <ul class="flex-container">
    <form action="#" method="post" novalidate="novalidate">
      <li class="flex-item">
        <select class="form-control search-slt">
          <option>(Sélectionne une catégorie)</option>
          <option>Spectacle</option>
          <option>Concert</option>
          <option>Exposition</option>
          <option>Festival</option>
          <option>Evènement sportif</option>
        </select>
      </li>
      <li class="flex-container">
        <div class="form-group row">
          <div class="col-10">
            <input class="form-control" type="date">
          </div>
        </div>
      </li>
    </form>    
  </ul>    
  
  <!-- <section class="search-sec">
    <div class="container">
      <form action="#" method="post" novalidate="novalidate">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-8 p-0">
                <input type="text" class="form-control search-slt" placeholder="Enter Pickup City">
              </div>
              <div class="col-lg-3 col-md-3 col-sm-8 p-0">
                <input type="text" class="form-control search-slt" placeholder="Enter Drop City">
              </div>
              <div class="col-lg-3 col-md-3 col-sm-8 p-0">
                <select class="form-control search-slt" id="exampleFormControlSelect1">
                  <option>Select Vehicle</option>
                  <option>Example one</option>
                  <option>Example one</option>
                  <option>Example one</option>
                  <option>Example one</option>
                  <option>Example one</option>
                  <option>Example one</option>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-8 p-0">
                <button type="button" class="btn btn-danger wrn-btn">Search</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section> -->
</div>
<!-- Fin de la barre de recherche -->

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