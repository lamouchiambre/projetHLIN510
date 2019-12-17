<?php 
  session_start();
  $connecter = isset($_SESSION['us_id']);
?>
<!DOCTYPE html>
<html lang="fr">
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

<div class = 'bloc'>
<?php 
  if($_GET['voir']){
    $name = $_GET['voir'];
  }
    $bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
    //$bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');

    $register = $bdd->prepare("SELECT * FROM REGISTER WHERE re_us_id = :us_id AND re_ev_id = :ev_id");
    $register->bindParam(':us_id', $_SESSION['us_id']);
    $register->bindParam(':ev_id', $name);
    $register->execute();

    $rate = $bdd->prepare("SELECT * FROM `rate` WHERE `ra_us_id` = ? AND `ra_ev_id` = ?");
    $rate->execute(array($_SESSION['us_id'], $name));
    $deja_rate = $rate->rowCount();
    $event = $bdd->prepare("SELECT * FROM EVENTS WHERE ev_id = ?");
    $event->execute(array($name));
    
    $passer = false;
    while($resulat = $event->fetch()){
      if($resulat['ev_date_end']<=date("Y-m-d")){
        $passer = true;
      }
        echo  "<h1>".$resulat['ev_name']."</h1>";
        echo "<img src=".$resulat['ev_picture']." class='img-fluid' width = 790px>";
        echo $resulat['ev_descriptive'];
    }
    $avg_rate = $bdd->prepare('SELECT AVG(ra_rating) AS moyenne FROM `rate` WHERE `ra_ev_id`= ?');
    $avg_rate->execute(array($name));
    echo "</br>";
    if (!$rate) {
      while($resulat = $avg_rate->fetch()){
        echo "<h4>La note moyenne de l'évènement est : ".$resulat['moyenne']."/10 </h4></br>";
      }
    }


    if($connecter){
        if(!$passer){
          if ( $register->rowCount()!=0) {
            echo "<form action='' method='post'>
            <input type='hidden' name='id' value=".$name. ">
            <input type='submit' class='btn btn-primary' name='deinscritption' value='deinscription'>";
          }else {
            echo "<form action='' method='post'>
            <input type='hidden' name='id' value=".$name. ">
            <input type='submit' class='btn btn-primary' name='inscritption' value='inscription' onclick=alert('Vous êtes inscrit');>";
          }
        }else{
          if ($deja_rate==1) {
            echo "<form action='' method='post'>";
            echo"<h3>L'evenement est passer vous pouvait noter l'evenemnt</h3>";
            echo '<div class="form"><label>Noter levenement</label><input type="number" name="note" min="0" max="10"></div>';
            //echo'<div class="form"><label for="commentaire">Saisir commentaire</label> <textarea class="form-control" name ="commentaire" rows="3"></textarea></div>';
            //echo "<input type='submit' class='btn btn-primary' name='noter' value='noter'>"; 
            echo "</form>";
          }
        }
      }
    if(isset($_POST['inscritption'])){
      echo "<h5>Vous êtes inscrit</h5>";
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
  
    if(isset($_POST['noter'])) {
      try{
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $bdd->beginTransaction();
        $now = date("Y-m-d");
        $note = $bdd->prepare("INSERT INTO `rate`(`ra_date`, `ra_rating`, `ra_us_id`, `ra_ev_id`) VALUES (?,?,?,?)");
        $note->execute(array($now,$_POST['note'], $_SESSION['us_id'], $name));
        $bdd->commit();
      }catch(PDOException $e){
        echo "<br>" . $e->getMessage();
      }
    }
    if(isset($_POST['deinscritption'])){
      echo "<h5>Vous êtes déinscrit</h5>";
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