<?php 
session_start();
//echo $_SESSION['us_id'];
if (isset($_POST['login-submit'])) {
    //echo "popo";
    $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
    $user = $_POST['username'];
    $mdp = $_POST['password'];

    $connexion = $bdd->prepare("SELECT * FROM USER WHERE us_email = :user");
    $connexion->bindParam(':user',$user);
    
    $connexion->execute();
    $resultat = $connexion->fetch();
    $isPasswordCorrect = password_verify($mdp, $resultat['us_password']);
    if($isPasswordCorrect){
        
        $_SESSION['us_email'] = $user;
        $_SESSION['us_id'] = $resultat['us_id']; 
        $_SESSION['us_role'] = $resultat['us_role'];
        $_SESSION['us_last_name'] = $resultat['us_last_name'];
        $_SESSION['us_first_name'] = $resultat['us_first_name'];
        //echo $_SESSION['us_id'];
        //echo $_SESSION['us_email'];
        //echo $_SESSION['us_role'];
        
    }else {
        header ('Location: connexion.php');
        exit();
    }

}
?>
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
        <?php 
          if(!empty($_SESSION['us_id'])){
            echo '<li><a href="espace_menbre.php">Mon espace</a></li>';
          }
        ?>
      </ul>
      <?php 

        if(empty($_SESSION['us_id'])){
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> </ul>';
        }else{
          echo '<ul class="nav navbar-nav navbar-right"> <li><a href="deconnection.php"><span class="glyphicon glyphicon-log-in"></span> Deconnection</a></li> </ul>';
        }
        
      ?>

    </div>
  </div>
</nav>

<!-- Fin du menu -->
<div class = 'bloc'>
<?php 
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
    } catch(Exception $e){
        die("Impossible de se connectée".$e->getMessage());
    }

?>
<h3>Mes inscription</h3>
<form action = 'mes_inscription.php' method='post'>
    <table >
        <thead>
        <tr>
            <th></th>
            <th>Nom</th>
            <th>Date</th>
            <th>Heure</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $ins_all = $bdd->prepare("SELECT * FROM EVENTS, REGISTER  WHERE re_ev_id = ev_id AND re_us_id = ?");
            $ins_all->execute(array($_SESSION['us_id']));
            while($r = $ins_all->fetch()){
                echo "<tr>";
                echo "<td><input type='checkbox' name = events_id[] value =".$r['ev_id']."></td>";
                echo "<td>".$r['ev_name']."</td>";
                echo "<td>".$r['ev_date_start']."</td>";
                echo "<td>".$r['ev_start_time']."</td>";
                echo "</tr>";
            }
            if (!empty($_POST['Desincrire'])){
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
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: A. Canton Condes, A. Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>