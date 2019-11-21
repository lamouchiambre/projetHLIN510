<!DOCTYPE html>
<html lang="en">
<head>
<title>Connexion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2aa;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
</head>
<body>
    <!-- <form class = "col-lg-6">
    <legend>Connexion</legend>
    <label for="mail" > Mail : </label>
     <input type="email">
    <label for="mdp" >Mot de passe : </label>
    <input type="text" classe = "from-control">
    <button>Envoyer</button>
    </form> -->
    <div class="col-lg-3 col-lg-offset-1">
    <form >
  <legend>Légende</legend>
    <div class="form-group">
      <label for="texte">Mail : </label>
      <input id="email" type="email" class="form-control">
    </div>
    <div class="form-group">
      <label for="text">Mots de passe : </label>
      <input type="text" classe = "from-control">
    </div>
    <button type="button" class="btn btn-success btn-block" >Envoyer</button>
</form>
</div>
    <!-- <form class="col-lg-6">
  <legend>Légende</legend>
    Text : <input type="text" class="form-control">
    Textarea : <textarea id="textarea" class="form-control"></textarea>
    Select :
      <select class="form-control">
        <option>Option 1</option>
        <option>Option 2</option>
        <option>Option 3</option>
      </select>
    <button>Envoyer</button>
</form> -->
</body>
</html>