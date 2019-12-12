<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<!-- <div class="container">
	<form method="post" enctype="multipart/form-data">
	<div>
		<label for="profile_pic">Sélectionnez le fichier à utiliser</label>
		<input type="file" id="profile_pic" name="img"
			accept=".jpg, .jpeg, .png">
	</div>
	<div>
		<button>Envoyer</button>
		<input type='submit' class='btn btn-primary' name='voir' value="img" >
	</div>
	</form>
	</div> -->
	<form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
          <p> Choisir une image: <input type="file" name="image" /></p>
          <input type="submit" value="Ajouter"/>
	</form>
	<?php 
		// if (!empty($_POST)) {
		// 	$bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root','');
		// 	echo $_FILES['img']['name'];
		// 	$name = $_FILES['img']['name'];
		// 	$type = $_FILES['img']['type'];
		// 	echo $type;
		// 	$data = file_get_contents($_FILES['img']['tmp_name']);
		// 	//echo $data;
		// 	$stmt = $bdd->prepare("Insert into image values(NULL, ?, ?)");
		// 	$stmt->bindParam(1, $name);
		// 	$stmt->bindParam(2, $data);
		// 	$stmt->execute();
		// }
	?>

	<?php 
		if(isset($_FILES['image']))
		{
		     $dossier = 'img/';
		     $fichier = basename($_FILES['image']['name']);
			echo $_FILES['image']['name'];
		     if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		     {
		          echo 'Upload effectué avec succès !';
		     }
		     else //Sinon (la fonction renvoie FALSE).
		     {
		          echo 'Echec de l\'upload !';
		     }
		}
		// Connexion à la base de données
		try
		{
		  $bdd = new PDO('mysql:host=localhost;dbname=e20160018322;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
		        die('Erreur : '.$e->getMessage());
		}
		 
	?>

</body>
</html>