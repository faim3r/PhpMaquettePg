<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylsheet" href="app/css/style.css">
</head>
<body>

<?php require_once('inc/bdd.php'); ?>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Ma Boutique de OUF !!</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Produits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="formulaire_contact.php">Contact</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="POST">
        <input class="form-control mr-sm-2" type="email" placeholder="E-Mail">
        <input class="form-control mr-sm-2" type="password" placeholder="Mot de passe">
        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Connexion</button>
      </form>
    </div>
  </nav>
</header>