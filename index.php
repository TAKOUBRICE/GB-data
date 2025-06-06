<?php session_start(); ?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="GB Analyse">    
    <title>signup-signin-logout</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-top-fixed.css" rel="stylesheet">
    <link href="css/sweetalert2.min.css" rel="stylesheet">
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">GB Analyse</a>
  </div>
</nav>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h1>Page principal</h1>
    <p class="lead"> Click pour se connecté ou s'inscrire</p>

    <?php if(isset($_SESSION['user_GB'])): ?>
    <a class="btn btn-lg btn-danger" href="php/logout.php" role="button">Déconnexion</a>
    <div class="mt-2">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Profil</span>
          <span class="badge bg-primary rounded-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Nom/prenom</h6>
              <small class="text-muted"><?php echo $_SESSION['user_GB']['user_name'] ?></small>
            </div>
            <span class="text-muted">En line</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">E-mail</h6>
              <small class="text-muted"><?php echo $_SESSION['user_GB']['user_email'] ?></small>
            </div>
            
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">date d'inscription</h6>
              <small class="text-muted"><?php echo $_SESSION['user_GB']['user_date'] ?></small>
            </div>
            
          </li>
          
        </ul>
    </div>

    <?php else: ?>
      <a class="btn btn-lg btn-primary" href="./login.html" role="button">Connexion</a>
     <?php endif ?> 
  </div>
</main>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/signup.js"></script>
    <script src="js/login.js"></script>
      
  </body>
</html>
