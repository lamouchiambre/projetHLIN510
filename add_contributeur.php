<?php 
  session_start();
  $connecter = isset($_SESSION['us_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Site événementiel d'Alex et Ambre</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
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
          if ($connecter) {
            echo '<li><a href="espace_menbre.php">Mon espace</a></li>';
          }
        ?>
      </ul>
      <?php 
        if (!$connecter) {
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li> </ul>';
        } else {
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="deconnection.php"><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li> </ul>';
        }
      ?>
    </div>
  </div>
</nav>
<!-- Fin du menu -->

<!-- Début ajout de contributeur -->
<div class='bloc' id='bloc_contrib1'>
  <h3>Donner le rôle contributeur à un membre</h3><br>
  <form action='add_contributeur.php' method='get'>
    <table>
      <thead>
        <tr>
          <th>Ajouter</th>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Rôle</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
          //$bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
          $user_all = $bdd->prepare("SELECT * FROM USER WHERE us_role = 'visitor'");
          $user_all->execute();
          while ($r = $user_all->fetch()) {
            echo "<tr>";
            echo "<td><input type='checkbox' name = user_id[] value =".$r['us_id']."></td>";
            echo "<td>".$r['us_first_name']."</td>";
            echo "<td>".$r['us_last_name']."</td>";
            echo "<td>".$r['us_email']."</td>";
            echo "<td>".$r['us_role']."</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
    <input type='submit' class='btn btn-primary' name='valider' value='valider'>
  </form>
</div>
<!-- Fin ajout de contributeur -->

<!-- Début suppression de contributeur -->
<div class='bloc' id='bloc_contrib2'>
  <h3>Enlever le rôle contributeur à un membre</h3><br>
  <form action = 'add_contributeur.php' method='get'>
    <table>
      <thead>
        <tr>
          <th>Ajouter</th>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Rôle</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $userC_all = $bdd->prepare("SELECT * FROM USER WHERE us_role = 'contributor'");
          $userC_all->execute();
          while ($r = $userC_all->fetch()) {
            echo "<tr>";
            echo "<td><input type='checkbox' name = userC_id[] value =".$r['us_id']."></td>";
            echo "<td>".$r['us_first_name']."</td>";
            echo "<td>".$r['us_last_name']."</td>";
            echo "<td>".$r['us_email']."</td>";
            echo "<td>".$r['us_role']."</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
    <input type='submit' class='btn btn-primary' name='Retirer' value='Retirer'>
  </form>
</div>
<?php 
  try {
    $bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
    //$bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
  } catch(Exception $e) {
    die("Impossible de se connectée".$e->getMessage());
  }
  if (!empty($_GET['valider'])) {
    $user = $_GET['user_id'];
    for ($i=0; $i < count($user); $i++) { 
      $t = $bdd->prepare("UPDATE `user` SET `us_role`='contributor' WHERE us_id = ?");
      $t->execute(array($user[$i]));
    } 
  }
  if (!empty($_GET['Retirer'])) {
    $user = $_GET['userC_id'];
    for ($i=0; $i < count($user); $i++) { 
      $t = $bdd->prepare("UPDATE `user` SET `us_role`='visitor' WHERE us_id = ?");
      $t->execute(array($user[$i]));
    }   
  }
?>
</div>
<!-- Fin suppression de contributeur -->

<!-- Début du footer -->
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: Alexandre Canton Condes, Ambre Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>