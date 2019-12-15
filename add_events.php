<?php 
session_start();
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
<h1> Creer un evenement </h1>
<form action="" method="post" enctype="multipart/form-data"> 
    <div class="form-groupe">
        <label for="nom">Le nom </label>
        <input type="text" id="nom" name="nom">
    </div>
    <div class = "form-groupe">
        <label for = "theme"> Saissir le theme </label>
        <select class="form-control" name = "theme" id="theme">
        <?php 
            //$bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
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
        <label for ="prix"> Le prix :</label> 
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
  <!-- <div class = "form">
    <label for="avatar">Mettre une image:</label>
      <input type="file"
        id="img" name="img"
        accept="image/png, image/jpeg">
  </div> -->
  <label for="url">Lien de l'image:</label>
    <div class = "form">
    <input type="url" name="url" id="url"
          placeholder="https://example.com"
          pattern="https://.*" 
          required>
          </div>
  <input type='submit' class='btn btn-primary' name='ajouter' value='ajouter'>
  
</form>
<h3>Liste des evenement</h3>
<form action = 'add_events.php' method='post'>
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
            $ev_all = $bdd->prepare("SELECT * FROM EVENTS");
            $ev_all->execute(array($_SESSION['us_id']));
            while($r = $ev_all->fetch()){
                echo "<tr>";
                echo "<td><input type='checkbox' name = events_id[] value =".$r['ev_id']."></td>";
                echo "<td>".$r['ev_name']."</td>";
                echo "<td>".$r['ev_date_start']."</td>";
                echo "<td>".$r['ev_start_time']."</td>";
                echo "</tr>";
            }
            if (!empty($_POST['supprimer'])){
                $events = $_POST['events_id'];
                for ($i=0; $i < count($events); $i++) { 
                    $t = $bdd->prepare("DELETE FROM `events` WHERE ev_id = ?");
                    $t->execute(array($events[$i]));
                }
                
            }
        ?>
        </tbody>
    </table>
    <input type='submit' class='btn btn-primary' name='supprimer' value='supprimer'>
</form>
<?php 
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
    } catch(Exception $e){
        die("Impossible de se connectée".$e->getMessage());
    }
    if (!empty($_POST['ajouter'])){
        try{
            //$name = $_FILES['img']['name'];
            $name = $_POST['url'];
            if(!empty($name)){
              
              //echo $_POST['img'];
              //$data = file_get_contents($_FILES['img']['tmp_name']);
              //$target = "img/events/".basename($name);
              // if (move_uploaded_file($_FILES['img']['tmp_name'], $target)){
              //   echo "true";
              // }
            }
            
            $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $bdd->beginTransaction();
            $p = $bdd->prepare("INSERT INTO `events` (`ev_id`, `ev_lo_id`, `ev_th_id`, `ev_name`, `ev_price`, `ev_date_start`, `ev_date_end`, `ev_start_time`, `ev_end_time`, `ev_nb_people_min`, `ev_nb_people_max`, `ev_descriptive`, `ev_average`, `ev_picture`) VALUES (NULL, :theme, :lieu, :nom, :prix, :date_deb, :date_fin, :heur_deb, :heur_fin, NULL, NULL,:descr,NULL, :img)");
            $p->bindParam(':theme', $_POST['theme']);
            $p->bindParam(':lieu', $_POST['lieu']);
            $p->bindParam(':nom', $_POST['nom']);
            $p->bindParam(':prix', $_POST['prix']);
            $p->bindParam(':date_deb', $_POST['date_deb']);
            $p->bindParam(':date_fin', $_POST['date_fin']);
            $p->bindParam(':heur_deb', $_POST['heure_deb']);
            $p->bindParam(':heur_fin', $_POST['heure_fin']);
            $p->bindParam(':descr', $_POST['description']);
            //$image;
            $p->bindParam(':img',$image);
            if (empty($name)) {
                $image = "img/events/default.jpg";
                //echo "non";
            }else{
                $image = $_POST['url'];
                //echo "oui";
            }
            $p->execute();
            $bdd->commit();
    
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