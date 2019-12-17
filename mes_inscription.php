<?php 
  session_start();
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

<div class='bloc'>
<?php 
  try {
    $bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
    //$bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
  } catch(Exception $e) {
    die("Impossible de se connectée".$e->getMessage());
  }
?>
<h3>Mes inscriptions</h3>
<form action='mes_inscription.php' method='post'>
  <table>
    <thead>
      <tr>
        <th></th>
        <th>Nom</th>
        <th>Thème</th>
        <th>Lieu</th>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Heure début</th>
        <th>Début fin</th>
        <th>Prix</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $ins_all = $bdd->prepare("SELECT *
        , DATE_FORMAT(ev_date_end, '%d-%m-%Y') AS date_fin 
        , DATE_FORMAT(ev_date_start, '%d-%m-%Y') AS date_debut 
         FROM EVENTS, REGISTER, Locations, Theme  
         WHERE ev_lo_id = lo_id AND ev_th_id = th_id AND re_ev_id = ev_id AND re_us_id = ?");
        $ins_all->execute(array($_SESSION['us_id']));
        while($r = $ins_all->fetch()){
          echo "<tr>";
          echo "<td><input type='checkbox' name = events_id[] value =".$r['ev_id']."></td>";
          echo "<td>".$r['ev_name']."</td>";
          echo "<td>".$r['th_name']."</td>";
          echo "<td>".$r['lo_name']."</td>";
          echo "<td>".$r['date_debut']."</td>";
          echo "<td>".$r['date_fin']."</td>";
          echo "<td>".$r['ev_start_time']."</td>";
          echo "<td>".$r['ev_end_time']."</td>";
          echo "<td>".$r['ev_price']."€</td>";
          echo "</tr>";
        }
        if (!empty($_POST['Desincrire'])) {
          $events = $_POST['events_id'];
          for ($i=0; $i < count($events); $i++) { 
            $t = $bdd->prepare("DELETE FROM `register` WHERE re_us_id = ? AND re_ev_id = ?");
            $t->execute(array($_SESSION['us_id'], $events[$i]));
          }   
        }
      ?>
    </tbody>
  </table>
  <input type='submit' class='btn btn-primary' name='Desincrire' value='Desincrire'>
</form>
</div>

<!-- Début du footer -->
<br>
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: Alexandre Canton Condes, Ambre Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>