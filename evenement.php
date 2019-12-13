<?php 
session_start();
$connecter = isset($_SESSION['us_id']);
echo $connecter;
?>
<!DOCTYPE html>
<html lang="fr">
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
          if($_SESSION['us_role'] = 'administrator'){
            echo '<li><a href="add_events.php">Ajouter un evenement</a></li>';
          }
        ?>
      </ul>
      <?php 
        if(!$connecter){
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
  if($_GET['voir']){
    $name = $_GET['voir'];
    //echo $name;
  }
    $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');

    $register = $bdd->prepare("SELECT * FROM REGISTER WHERE re_us_id = :us_id AND re_ev_id = :ev_id");
    $register->bindParam(':us_id', $_SESSION['us_id']);
    $register->bindParam(':ev_id', $name);
    $register->execute();

    $event = $bdd->prepare("SELECT * FROM EVENTS WHERE ev_id = ?");
    $event->execute(array($name));
    
    
    while($resulat = $event->fetch()){
        echo  "<h1>".$resulat['ev_name']."</h1>";
        echo "<img src=".$resulat['ev_picture']." class='img-fluid' width = 790px>";
        echo $resulat['ev_descriptive'];
    }
    if ( $register->rowCount()!=0) {
      echo $register->rowCount();
      echo "<form action='' method='post'>
      <input type='hidden' name='id' value=".$name. ">
      <input type='submit' class='btn btn-primary' name='deinscritption' value='deinscription'>";
      
    }
    else{
      if($connecter){
        echo "<form action='' method='post'>
        <input type='hidden' name='id' value=".$name. ">
        <input type='submit' class='btn btn-primary' name='inscritption' value='inscription'>";
      }
    }
    if(isset($_POST['inscritption'])){
      echo "je me suis inscrit";
      try{
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $bdd->beginTransaction();
        $ins = $bdd->prepare("INSERT INTO `register`(`re_registration_date`, `re_us_id`, `re_ev_id`) VALUES (:dateI, :us_id, :ev_id)");
        $now = date("Y-m-d");
        $un = 1;
        $ins->bindParam(':dateI', $now);
        $ins->bindParam(':us_id', $_SESSION['us_id']);
        $ins->bindParam(':ev_id', $name);
        $ins->execute();
        $bdd->commit();
      }catch(PDOException $e)
      {
      echo "<br>" . $e->getMessage();
      }

    }
    if(isset($_POST['deinscritption'])){
      echo "je me suis deinscrit";
      try{
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $bdd->beginTransaction();
        $dins = $bdd->prepare("DELETE FROM `register` WHERE re_us_id = :us_id AND re_ev_id = :ev_id");
        $now = date("Y-m-d");
        $dins->bindParam(':us_id', $_SESSION['us_id']);
        $dins->bindParam(':ev_id', $name);
        $dins->execute();
      }catch(PDOException $e)
      {
      echo "<br>" . $e->getMessage();
      }

    }

?>
</div>

<!-- Début du footer -->
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: A. Canton Condes, A. Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>