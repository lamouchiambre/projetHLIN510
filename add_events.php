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
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
<script>

</script>
<!-- Fin du menu -->
<div class = 'bloc'>
<h1> Creer un evenement </h1>
<form action="" method="get"> 
    <div class="form-groupe">
        <label for="nom">Le nom </label>
        <input type="text" id="nom" name="nom">
    </div>
    <div class = "form-groupe">
        <label for = "theme"> Saissir le theme </label>
        <select class="form-control" name = "theme" id="theme">
        <?php 
            $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
            $theme = $bdd->prepare("SELECT * FROM THEME");
            $theme->execute();
            while($resulat = $theme->fetch()){
                echo "<option value='".$resulat['th_id']."'>".$resulat['th_name']."</option>";
            }
        ?>
        </select>
    </div>
    <div class = "form-group">
        <label for="lieu"> Lieux :</label>
        <select class="form-control" name = "lieu" id = "lieu">
            <?php 
                $lieu = $bdd->prepare("SELECT * FROM LOCATIONS");
                $lieu->execute();
                while($resulat = $lieu->fetch()){
                    echo "<option value='".$resulat['lo_id']."'>".$resulat['lo_name']."</option>";
                }   
            ?>
        <select>
    </div>
    <div class = "form">
        <input type="number" name="prix" id="prix" step="1" value="0" min="0">
    </div>
    <div class = "form">
        <label for="date_deb"> La date de début :</label>
        <input type="date" name="date_deb" id="date_deb">
    </div>
    <div class = "form">
        <label for="heure_deb"> L'heure de début :</label>
        <input type="time" name="heure_deb" id="heure_deb">
    </div>
    <div class = "form">
        <label for="date_fin"> La date de fin :</label>
        <input type="date" name="date_fin" id="date_fin">
    </div>
    <div class = "form">
        <label for="heure_fin"> L'heure de fin :</label>
        <input type="time" name="heure_fin" id="heure_fin">
    </div>
    <div class="form">
    <label for="description">Saisir description</label>
    <textarea class="form-control" id="description" name ="description" rows="3"></textarea>
  </div>
  <div class = "form">
  <label for="avatar">Mettre une image:</label>
    <input type="file"
       id="img" name="img"
       accept="image/png, image/jpeg">
  </div>
  <input type='submit' class='btn btn-primary' name='ajouter' value='ajouter'>
  
</form>
<?php 
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
    } catch(Exception $e){
        die("Impossible de se connectée".$e->getMessage());
    }
    if (!empty($_GET)){
        try{
            $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $bdd->beginTransaction();
            $p = $bdd->prepare("INSERT INTO `events` (`ev_id`, `ev_lo_id`, `ev_th_id`, `ev_name`, `ev_price`, `ev_date_start`, `ev_date_end`, `ev_start_time`, `ev_end_time`, `ev_nb_people_min`, `ev_nb_people_max`, `ev_descriptive`, `ev_average`, `ev_picture`) VALUES (NULL, :theme, :lieu, :nom, :prix, :date_deb, :date_fin, :heur_deb, :heur_fin, NULL, NULL,:descr,NULL, :img)");
            $p->bindParam(':theme', $_GET['theme']);
            $p->bindParam(':lieu', $_GET['lieu']);
            $p->bindParam(':nom', $_GET['nom']);
            $p->bindParam(':prix', $_GET['prix']);
            $p->bindParam(':date_deb', $_GET['date_deb']);
            $p->bindParam(':date_fin', $_GET['date_fin']);
            $p->bindParam(':heur_deb', $_GET['heure_deb']);
            $p->bindParam(':heur_fin', $_GET['heure_fin']);
            $p->bindParam(':descr', $_GET['description']);
            $image;
            $p->bindParam(':img',$image);
            if (empty($_GET['img'])) {
                $image = "img/default.jpg";
                $dossier = 'img/';
            }else{
                $image = "img/".$_GET['img'];
            }
            $p->execute();
            $bdd->commit();
            echo gettype($_GET['img']);
        } catch(Exception $e){
            $bdd->rollBack();
            echo "impossible ajouter".$e->getMessage();    
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