<!-- Début configation de la session -->
<?php 
  session_start();

  if (isset($_POST['login-submit'])) {
    $bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
    // $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
    $user = $_POST['username'];
    $mdp = $_POST['password'];

    $connexion = $bdd->prepare("SELECT * FROM USER WHERE us_email = :user");
    $connexion->bindParam(':user',$user);
      
    $connexion->execute();
    $resultat = $connexion->fetch();
    $isPasswordCorrect = password_verify($mdp, $resultat['us_password']);

    if ($isPasswordCorrect) {
      $_SESSION['us_email'] = $user;
      $_SESSION['us_id'] = $resultat['us_id']; 
      $_SESSION['us_role'] = $resultat['us_role'];
      $_SESSION['us_last_name'] = $resultat['us_last_name'];
      $_SESSION['us_first_name'] = $resultat['us_first_name'];
    } else {
      header('Location: connexion.php');
      exit();
    }
  }
?>
<!-- Fin configation de la session -->

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
          if (!empty($_SESSION['us_id'])) {
            echo '<li><a href="espace_menbre.php">Mon espace</a></li>';
          }
        ?>
      </ul>
      <?php 
        if (empty($_SESSION['us_id'])) {
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li> </ul>';
        } else {
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="deconnection.php"><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li> </ul>';
        }
      ?>
    </div>
  </div>
</nav>
<!-- Fin du menu -->

<!-- Début de l'espace perso -->
<div class = 'bloc'>
<?php 
  echo "<h1>Bienvenue ";
  if ($_SESSION['us_role'] == 'administrator') {
    echo "administrateur ";
  } else if ($_SESSION['us_role'] == 'contributor') {
    echo "contributeur ";
  }
  echo $_SESSION['us_first_name'].' '.$_SESSION['us_last_name']." </h1>"
?>
<br>
<h4 id='a1'>Que voulez vous faire aujourd'hui ?</h4>
<br>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Gêrer mon compte</h4>
        <p class="card-text"><a href = 'mes_inscription.php'>Gêrer mes inscriptions</a></p>
      </div>
    </div>
  </div>
    <?php 
      if ($_SESSION['us_role'] != 'visitor') {
        if ($_SESSION['us_role'] =='administrator') {
          echo '<div class="col-sm-6"> <div class="card text-white bg-dark mb-3">
            <div class="card-body"> <h4 class="card-title">Gêrer les comptes</h4>            <p class="card-text"><a href="add_contributeur.php">Ajouter/Supprimer un contributeur</a></p>            <p class="card-text"><a href = "sup_compte.php"> Supprimer les comptes</a></p>                      </div>        </div>      </div>';
        }
      
        echo '<div class="col-sm-6">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h4 class="card-title">Gêrer les événements</h4>';
        echo '<p class="card-text"><a href="add_events.php">Ajouter/Supprimer un nouveau événement</a></p>';
        if ($_SESSION['us_role']=='administrator') {
          echo '<p class="card-text"><a href = "add_lieu.php">Ajouter/Supprimer un nouveau lieu</p> <p class="card-text"><a href="add_theme.php">Ajouter un nouveau thème</a></p>';
        }
        echo '</div></div></div>';
      }
    ?>
  </div>
  <?php 
    try {
      $bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
      //$bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
    } catch(Exception $e){
      die("Impossible de se connectée".$e->getMessage());
    }
  ?>
</div>
<!-- Fin de l'espace perso -->

<!-- Début du footer -->
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: Alexandre Canton Condes, Ambre Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>