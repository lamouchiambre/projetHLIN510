<?php 
session_start();
echo $_SESSION['us_id'];
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
<h1> Gerer les themes </h1>
    <div>
    <form action = "" method="get">
        <?php 
            $th = $bdd->prepare("SELECT * FROM THEME");
            $th->execute();
            $nb = $th->rowCount();
            
            while($r = $th->fetch()){
                echo "<div><input type='checkbox' name = ".$r['th_id'].">";
                echo "<label for=".$r['th_id'].">".$r['th_name']."</label></div>";
            }
        ?>
    <input type='submit' class='btn btn-primary' name='supprimer' value='supprimer'>
  </div>
  </form>
    <?php 
        if(!empty($_GET['supprimer'])){
            echo "blabla";
            for ($i=1; $i < $nb+1; $i++) { 
                if (!empty($_GET[$i])) {
                    $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $bdd->beginTransaction();
                    $sup= $bdd->prepare("DELETE FROM `theme` WHERE th_id = :th_id ");
                    $sup->bindParam(":th_id", $i);
                    $sup->execute();
                    $sup->execute();
                    echo "sup";
                }
            }
        }
    ?>
<h1>Ajouter des thèmes</h1>
    <form action = "" method="post">
        <input type="text" name="new_theme">
        <input type='submit' class='btn btn-primary' name='ajouter' value='ajouter'>
    </form>
    <?php 
        if(!empty($_POST['ajouter'])){
            echo "lala";
            $test = $bdd->prepare("SELECT * FROM THEME WHERE th_name = ?");
            $test->execute(array($_POST['new_theme']));
            echo $test->rowCount();
            if($test->rowCount()!=0){
                echo "Theme deja prit";
            }else{
                echo 'jajoute';
                $aj = $bdd->prepare("INSERT INTO `theme` (`th_id`, `th_name`) VALUES (NULL, :nom)");
                $aj->bindParam(':nom', $_POST['new_theme']);
                $aj->execute();
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