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
  <link rel="stylesheet" href="styleC.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <meta name="viewport" content="width=device-width">
  <!-- OpenLayers CSS -->
  <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.0.1/css/ol.css" type="text/css">
</head>

<body>
<script> 
  $(function() {
    $('#login-form-link').click(function(e) {
      $("#login-form").delay(100).fadeIn(100);
      $("#register-form").fadeOut(100);
      $('#register-form-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
    });

    $('#register-form-link').click(function(e) {
      $("#register-form").delay(100).fadeIn(100);
      $("#login-form").fadeOut(100);
      $('#login-form-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
    });
  })
</script>

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
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span>Se connecter</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- Fin du menu -->

<!-- Début de l'interface -->
<div class="container">
	<?php 
		try {
			$bdd = new PDO('mysql:host=mysql.etu.umontpellier.fr;dbname=e20160018322;charset=utf8', 'e20160018322','260293');
			// $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
		} catch(PDOException $e) {
			echo $e->getMessage();
			die("Connexion impossible");
		}
	?>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<a href="#" class="active" id="login-form-link">Se connecter</a>
						</div>
						<div class="col-xs-6">
							<a href="#" id="register-form-link">S'enregistrer</a>
						</div>
					</div>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<form id="login-form" action="espace_menbre.php" method="post" role="form" style="display: block;">
								<div class="form-group">
									<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Email" value="">
								</div>
								<div class="form-group">
									<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Mot de passe">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log_In">
										</div>
									</div>
								</div>
							</form>
							<form id="register-form" action="" method="post" role="form" style="display: none;">
								<div class="form-group">
									<input type="text" name="prenom" id="prenom" tabindex="1" class="form-control" placeholder="Prénom" value="">
								</div>
								<div class="form-group">
									<input type="text" name="nom" id="nom" tabindex="1" class="form-control" placeholder="Nom" value="">
								</div>
								<div class="form-group">
									<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
								</div>
								<div class="form-group">
									<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Mot de passe">
								</div>
								<div class="form-group">
									<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirmer mot de passe">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
										</div>
									</div>
								</div>
							</form>
							<?php 
								if (isset($_POST['register-submit'])) {
									if ($_POST['password'] == $_POST['confirm-password']) {
										$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
										$_POST['email'];
										$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
										$bdd->beginTransaction();
										$req = $bdd->prepare('INSERT INTO user(us_id, us_password, us_role, us_last_name,us_first_name, us_email) VALUES (NULL,:pw, :r, :n, :p, :e )');
										$v = 'visitor';
										
										$req->execute(array(
											'pw' => $pass_hache,
											'r' => $v,
											'n' => $_POST['nom'],
											'p' => $_POST['prenom'],
											'e' => $_POST['email']
										));

										$bdd->commit();
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Fin de l'interface -->

<!-- Début du footer -->
<br>
<footer class="container-fluid text-center" id="footer">
  <p>&copy; 2019 Copyright: Alexandre Canton Condes, Ambre Lamouchi<p>
</footer>
<!-- Fin du Footer -->

</body>
</html>