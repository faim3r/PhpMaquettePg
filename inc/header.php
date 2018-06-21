    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylsheet" href="app/css/style.css">
</head>
<body>

<?php
require_once('inc/bdd.php');
//traitement de la déconnexion
if(isset($_GET['deco'])){
  //on supprime la session
  session_destroy();
  //on redirige vers la page d'accueil
  header('location:index.php');
}
?>

<header class="mb-3">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><img src="app/img/logosmall.jpg" alt="Logo" title="Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Produits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="formulaire_contact.php">Contact</a>
        </li>
        <?php
        if(!empty($_POST['connexion'])){
          //si post n'est pas vide, c'est que l'utilisateur a bien envoyé quelquechose
          $errors = [];
          
          if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo 'Veuillez entrer un e-mail<br>';
          }
          
          if(strlen($_POST['password']) < 4 || strlen($_POST['password']) > 10){
            $errors[] = 'Mot de passe incorect<br>';
          }
          
          if(empty($errors)){
            $verif = $bdd->prepare('SELECT * FROM users WHERE email = :email');
            $verif->bindValue(':email', strip_tags(trim($_POST['email'])));
            $verif->execute();
            $resultat = $verif->fetchAll();
  
            if(count($resultat) === 1) {
              $mdpCryp = $resultat[0]['password'];
            }
  
            if(isset($mdpCryp) && password_verify(trim($_POST['password']), $mdpCryp)){
              $_SESSION['id'] = $resultat[0]['id'];
              $_SESSION['email'] = strip_tags($_POST['email']);
              $_SESSION['user_name'] = $resultat[0]['user_name'];
              $_SESSION['role'] = $resultat[0]['role'];
            }else{
              //on affiche les erreurs
              echo implode('<br>', $errors);
            }
          }
        }
        if(isset($_SESSION['id']) && ($_SESSION['role'] == 'ROLE_ADMIN' || $_SESSION['role'] == 'ROLE_USER')){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="user.php">Mon Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mdp.php">Securité</a>
        </li>
        <?php
        }
        ?>
      </ul>
      
      <form class="form-inline my-2 my-lg-0" method="POST">
        <?php
        if(!isset($_SESSION['id'])){
        ?>
          <input class="form-control mr-sm-2" type="email" name="email" placeholder="E-Mail">
          <input class="form-control mr-sm-2" type="password" name="password" placeholder="Mot de passe">
          <input type="hidden" name="id">
          <button class="btn btn-outline-warning my-2 my-sm-0" type="submit" value='2' name='connexion'>Connexion</button>
        <?php
        }
        ?>
        <?php
        
        if(isset($_SESSION['id']) && ($_SESSION['role'] == 'ROLE_ADMIN' || $_SESSION['role'] == 'ROLE_USER')){
          echo '<h6 class="text-light">Bonjour ' . ' ' . $_SESSION['user_name'] .'</h6>';
        ?>
          <a href="index.php?deco" class="btn btn-warning active my-2 my-sm-0 ml-3" role="button">Déconnexion</a>
        <?php
        }
        ?>

      </form>
        <?php

        ?>
    </div>
  </nav>
</header>

